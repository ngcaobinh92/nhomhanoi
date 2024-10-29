<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\SitePostModel;
use DB;

class NewController extends Controller
{
  //
  function __construct()
  {
    $this->middleware(function (Request $request, $next) {
      view()->share(['module' => 'tin-tuc']);
      $this->module = 'tin-tuc';
      return $next($request);
    });
  }

  public function getList(Request $request)
  {
    view()->share(['path' => 'list']);
    $this->path = 'list';
    $SitePostModel = new SitePostModel();
    $params = $request->all();
    $params['type'] = 'new';
    $data = $SitePostModel->getlist($params);
    return view('cms.content.new.list', ['news' => $data]);
  }

  public function getAdd()
  {
    view()->share(['path' => 'add']);
    $this->path = 'add';
    return view('cms.content.new.add');
  }

  public function postAdd(Request $request)
  {

    // $slugId = SitePostModel::where('slug', 'like', '%tin-tuc%')->first();
    // if ($slugId != '') {
    //   return redirect('cms/tin-tuc/list')->with('thongbao', 'Không tìm thấy danh mục tin tức!, vui lòng tạo mới với đường dẫn mặc định là "tin-tuc"');
    // }

    $this->validate($request, [
      'title' => 'required',
      'slug' => 'unique:site_post',
    ]);

    if (isset($request->slug) && $request->slug != '') {
      $slug = $request->slug;
    } else {
      $slug = stripUnicode($request->title);
    }

    $data = new SitePostModel;
    $data->title = $request->title;
    $data->slug = $slug;
    $data->tags = $request->tags;
    $data->content = $request->content;
    $data->order = $request->order;
    $data->parent = 19;
    $data->status = $request->status;
    $data->featured_image = $request->featured_image;
    $data->thump_image = $request->thump_image;
    $data->type = 'new';

    DB::beginTransaction();
    try {
      $data->save();
      $insertedId = $data->id;
      DB::commit();
      return redirect('cms/tin-tuc/list')->with('thongbao', 'Tạo mới thành công');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::alert($e->getMessage());
      return back()->with('thongbao', 'Thêm mới thất bại, vui lòng thử lại sau');
    }
  }

  public function getEdit($id)
  {
    view()->share(['path' => 'edit']);
    $this->path = 'edit';
    $data = SitePostModel::find($id);
    if ($data == null) {
      return redirect('cms/tin-tuc/list')->with('thongbao', 'Không tìm thấy nội dung!');
    }
    return view('cms.content.new.edit', ['new' => $data]);
  }

  public function postEdit(Request $request, $id)
  {
    $slugId = SitePostModel::where('slug', 'like', 'tin-tuc')->first();
    if (count($slugId) == 0) {
      return redirect('cms/tin-tuc/list')->with('thongbao', 'Không tìm thấy danh mục chứa tin tức!');
    }

    $this->validate($request, [
      'title' => 'required',
    ]);

    $data = SitePostModel::find($id);
    if (isset($request->slug) && $request->slug != '') {
      $slug = $request->slug;
    } else {
      $slug = stripUnicode($request->title);
    }

    if ($slug != $data->slug) {
      if (count(SitePostModel::where('slug', 'like', $slug)->first()) > 0) {
        return back()->with('thongbao', 'Đã tồn tại đường dẫn trong dữ liệu, vui lòng thay đổi lại đường dẫn hoặc tiêu đề (trong trường hợp đường dẫn để mặc định)');
      }
    }

    $data->title = $request->title;
    $data->slug = $slug;
    $data->tags = $request->tags;
    $data->content = $request->content;
    $data->order = $request->order;
    $data->parent = $slugId->id;
    $data->status = $request->status;
    $data->featured_image = $request->featured_image;
    $data->thump_image = $request->thump_image;
    $data->type = 'new';
    if ($data->save()) {
      return redirect('cms/tin-tuc/edit/'.$id)->with('thongbao', 'Cập nhật thành công');
    }else{
      return back()->with('thongbao', 'Cập nhật thất bại, vui lòng thử lại sau');
    }
  }

  public function getDelete($id)
  {
    view()->share(['path' => 'delete']);
    $this->path = 'delete';
    $rs = SitePostModel::find($id);
    if ($rs->delete()) {
      return '1';
    }else{
      return '0';
    }
  }

}