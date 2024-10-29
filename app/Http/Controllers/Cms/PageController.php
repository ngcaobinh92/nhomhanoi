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

class PageController extends Controller
{
  //
  function __construct()
  {
    $this->middleware(function (Request $request, $next) {
      view()->share(['module' => 'page']);
      $this->module = 'page';
      return $next($request);
    });
  }

  public function getList(Request $request)
  {
    view()->share(['path' => 'list']);
    $this->path = 'list';
    $SitePostModel = new SitePostModel();
    $params = $request->all();
    $params['type'] = 'page';
    $data = $SitePostModel->getlist($params);
    return view('cms.content.page.list', ['pages' => $data]);
  }

  public function getAdd()
  {
    view()->share(['path' => 'add']);
    $this->path = 'add';
    return view('cms.content.page.add');
  }

  public function postAdd(Request $request)
  {
    $this->validate($request, [
      'title' => 'required',
      'slug' => 'unique:site_post',
    ]);

    if (isset($request->slug) && $request->slug != '') {
      $slug = strtolower(stripUnicode($request->slug));
    } else {
      $slug = strtolower(stripUnicode($request->title));
    }

    $data = new SitePostModel;
    $data->title = $request->title;
    $data->slug = $slug;
    $data->content = $request->content;
    $data->order = $request->order;
    $data->status = $request->status;
    $data->type = 'page';
    DB::beginTransaction();
    try {
      $data->save();
      DB::commit();
      return redirect('cms/page/list')->with('thongbao', 'Tạo mới thành công');
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
      return redirect('cms/page/list')->with('thongbao', 'Không tìm thấy nội dung!');
    }
    return view('cms.content.page.edit', ['page' => $data]);
  }

  public function postEdit(Request $request, $id)
  {
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
    $data->content = $request->content;
    $data->order = $request->order;
    $data->status = $request->status;
    $data->type = 'page';
    if ($data->save()) {
      return redirect('cms/page/edit/'.$id)->with('thongbao', 'Cập nhật thành công');
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