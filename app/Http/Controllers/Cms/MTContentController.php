<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use App\Models\MTContentModel;
use App\Models\MTContentCategoryModel;
use App\Models\CMSMenuModel;
use Carbon\Carbon;
use Session;
use Mail;
use DB;
// use App\Http\Controllers\Cms\UserController;

class MTContentController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            $categories = MTContentCategoryModel::select('id', 'name')->get();
            view()->share(['module' => 'content', 'categories' => $categories]);
            $this->module = 'content';
            return $next($request);
        });
    }

    public function getList()
    {
        ini_set('memory_limit', '-1');
        view()->share(['path' => 'conlist']);
        $this->path = 'conlist';

        $data = DB::table('content')->join('contentcategory', 'content.category_id', '=', 'contentcategory.id')->select('contentcategory.name','content.content','content.createTime','content.date','content.id')->whereYear('content.createTime', '>=', Carbon::now()->subYear(2)->year)->orderBy('content.date','DESC')->get();

        $total = count($data);
        $data2 = array();
        for ($i=0; $i < $total; $i++) { 
            $tmp = array();
            foreach ($data[$i] as $key => $value) {
                if ($key == 'id') {
                    $data2[$i][] = '<a href="cms/content/conlist/edit/'.$value.'" title="Sửa"><i class="fa fa-pencil"></i></a>';
                } else {
                    $data2[$i][] = $value;
                }
            }
        }
        unset($data);
        $data2 = json_encode(array('aaData' => $data2));
        file_put_contents("public/media/data.json", $data2);
        return view('cms.content.mtcontent.list');
    }

    public function getAdd()
    {
        view()->share(['path' => 'add']);
        $this->path = 'add';
        return view('cms.content.mtcontent.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, 
            [
                'content' => 'required',
            ]);

        $data = new MTContentModel;
        $data->category_id = $request->category;
        $data->content = $request->content;
        $data->createTime = Carbon::createFromFormat('d/m/Y', $request->createTime)->format('Y-m-d 12:00:00');
        $data->date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $data->status = $request->status;
        $data->rrIndex = $request->rrIndex;
        $data->count = $request->count;
        $data->associate = $request->associate;
        $data->save();
        $insertedId = $data->id;
        if ($insertedId > 0) {
            if ($data->category_id == 91) {
                //Kiểm tra xem content cho ngày hôm đó có tôn tại chưa
                if (MTContentModel::where('category_id', '101')->whereDate('date', Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d'))->exists() == false) {
                    $data = new MTContentModel;
                    $data->category_id = 101;
                    $data->content = '(mien phi) '.Carbon::createFromFormat('d/m/Y', $request->createTime)->format('d/m').' '.$request->content;
                    $data->createTime = Carbon::createFromFormat('d/m/Y', $request->createTime)->format('Y-m-d 12:00:00');
                    $data->date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
                    $data->status = $request->status;
                    $data->rrIndex = $request->rrIndex;
                    $data->count = $request->count;
                    $data->associate = $request->associate;
                    $data->save();
                };
            }
            return redirect('cms/content/conlist')->with('thongbao', 'Đã thêm thành công');
        }else{
            return back()->with('thongbao', 'Thêm mới thất bại, vui lòng thử lại sau');
        }
    }

    public function getEdit($id)
    {
        view()->share(['path' => 'edit']);
        $this->path = 'edit';        
        $data = MTContentModel::find($id);
        if ($data == null) {
            return redirect('cms/content/conlist')->with('thongbao', 'Không tìm thấy nội dung!');
        }

        $data->createTime = Carbon::parse($data->createTime)->format('d/m/Y');
        $data->date = Carbon::parse($data->date)->format('d/m/Y');
        return view('cms.content.mtcontent.edit', ['data' => $data]);
    }

    public function postEdit(Request $request, $id)
    {
        $data = MTContentModel::find($id);
        $this->validate($request, 
            [
                'content' => 'required',
            ]);

        $data->category_id = $request->category;
        $data->content = $request->content;
        $data->createTime = Carbon::createFromFormat('d/m/Y', $request->createTime)->format('Y-m-d 12:00:00');
        $data->date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
        $data->status = $request->status;
        $data->rrIndex = $request->rrIndex;
        $data->count = $request->count;
        $data->associate = $request->associate;
        if ($data->save()) {
            return redirect('cms/content/conlist/edit/'.$id)->with('thongbao', 'Cập nhật thành công');
        }else{
            return back()->with('thongbao', 'Cập nhật thất bại, vui lòng thử lại sau');
        }
    }

    public function getDelete($id)
    {
        view()->share(['path' => 'delete']);
        $this->path = 'delete';
        $rs = MTContentModel::find($id);
        if ($rs->delete()) {
            return redirect('cms/content/conlist')->with('thongbao', 'Xóa thành công');
        }else{
            return back()->with('thongbao', 'Xóa thất bại, vui lòng thử lại sau');
        }
    }

}