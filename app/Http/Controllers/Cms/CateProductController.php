<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\SitePostModel;
use DB;

class CateProductController extends Controller
{
  //
  function __construct()
  {
    $this->middleware(function (Request $request, $next) {
      $categories_list = SitePostModel::where('type', 'category')->orderBy('order', 'DESC')->get();
      view()->share(['module' => 'danh-muc/list', 'categories_list' => $categories_list]);
      $this->module = 'danh-muc';
      return $next($request);
    });
  }

  public function getList()
  {
    view()->share(['path' => 'list']);
    $this->path = 'list';
    return view('cms.content.cateproduct.list');
  }

  public function postList(Request $request)
  {
    $this->validate($request, [
      'title' => 'required',
    ]);

    if (isset($request->slug) && $request->slug != '') {
      $slug = strtolower(stripUnicode($request->slug));
    } else {
      $slug = strtolower(stripUnicode($request->title));
    }

    $data = new SitePostModel;
    $data->title = $request->title;
    $data->slug = $slug;
    $data->description = $request->description;
    $data->order = $request->order;
    $data->parent = $request->parent;
    $data->status = $request->status;
    $data->featured_image = $request->featured_image;
    $data->thump_image = $request->thump_image;
    $data->type = 'category';
    try {
      $data->save();
      return redirect('cms/danh-muc/list')->with('thongbao', 'Đã thêm thành công');
    } catch (\Exception $e) {
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
      return redirect('cms/danh-muc/list')->with('thongbao', 'Không tìm thấy nội dung!');
    }
    return view('cms.content.cateproduct.edit', ['data' => $data]);
  }

  public function postEdit(Request $request, $id)
  {
    $this->validate($request, [
      'title' => 'required',
    ]); 

    $data = SitePostModel::find($id);
    if (isset($request->slug) && $request->slug != $data->slug) {
      $slug = strtolower(stripUnicode($request->slug));
    } else {
      $slug = $data->slug;
    }

    $data->title = $request->title;
    $data->slug = $slug;
    $data->description = $request->description;
    $data->order = $request->order;
    $data->parent = $request->parent;
    $data->status = $request->status;
    $data->featured_image = $request->featured_image;
    $data->thump_image = $request->thump_image;
    $data->type = 'category';

    try {
      $data->save();
      return redirect('cms/danh-muc/list')->with('thongbao', 'Đã thêm thành công');
    } catch (\Exception $e) {
      if (strpos($e->getMessage(), 'SQLSTATE[23000]') !== false) {
        return back()->with('thongbao', 'Thêm mới thất bại, Đường dẫn danh mục đã tồn tại trên hệ thống');
      } else {
        return back()->with('thongbao', 'Thêm mới thất bại, vui lòng thử lại sau');
      }
    }
  }

  public function getDelete($id)
  {
    view()->share(['path' => 'delete']);
    $this->path = 'delete';
    try {
      $rs = SitePostModel::find($id);
      $rs->delete();
      DB::table('site_post')->where('parent', $id)->update(['parent' => 0]);
      return '1';
    } catch (\Exception $e) {
      Log::alert($e->getMessage());
      return '0';
    }

  }

}