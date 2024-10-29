<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\SitePostModel;
use App\Models\SiteSlideModel;
use DB;
use Log;
use Image;

class ProductController extends Controller
{
  //
  function __construct()
  {
    $this->middleware(function (Request $request, $next) {
      $categories_list = SitePostModel::where('type', 'category')->orderBy('order', 'DESC')->get();
      view()->share(['module' => 'san-pham', 'categories_list' => $categories_list]);
      $this->module = 'san-pham';
      return $next($request);
    });
  }

  public function getList(Request $request)
  {
    view()->share(['path' => 'list']);
    $this->path = 'list';
    $SitePostModel = new SitePostModel();
    $params = $request->all();
    $params['type'] = 'product';
    $data = $SitePostModel->getProduct($params);
    if (count($data) > 0) {
      foreach ($data as $value) {
        $value->category = SitePostModel::where('id', $value->parent)->where('type', 'category')->first();
      }
    }
    return view('cms.content.product.list', ['products' => $data]);
  }

  public function getAdd()
  {
    view()->share(['path' => 'add']);
    $this->path = 'add';
    return view('cms.content.product.add');
  }

  public function postAdd(Request $request)
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
    $data->content = $request->content;
    $data->tags = $request->tags;
    $data->order = $request->order;
    $data->featured_image = $request->featured_image;
    $data->thump_image = $request->thump_image;
    $data->parent = $request->parent;
    $data->status = $request->status;
    $data->featured_image = $request->featured_image;
    $data->thump_image = $request->thump_image;
    $data->type = 'product';

    DB::beginTransaction();
    try {
      $data->save();
      $insertedId = $data->id;
      $data = array(
        'post_id' => $insertedId,
        'quantity' => $request->quantity,
        'sale' => $request->sale,
        'origin_price' => $request->origin_price,
      );
      DB::table('site_product')->insert($data);
      if (isset($request->slider) && count($request->slider) > 0) {
        foreach ($request->slider as $value) {
          if ($value != '') {
            if ($value[0] == "/") {
              $value =  substr($value, 1);
            }
            $thumb = explode('/', urldecode($value));
            $thumb = array_values(array_slice($thumb, -2, 2, true));
            $path = 'public/media/.tmb/'.$thumb[0];
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $thumb = 'public/media/.tmb/'.$thumb[0].'/'.$thumb[1];
            Image::make(urldecode($value))->resize(100, 75)->save($thumb);
            $data = array(
              'post_id' => $insertedId,
              'image' => $value,
              'thumb' => $thumb,
            );
            SiteSlideModel::insert($data);
          }
        }
      }
      DB::commit();
      return redirect('cms/san-pham/list')->with('thongbao', 'Tạo mới thành công');
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
    $params = array(
      'id' => $id,
    );
    $SitePostModel = new SitePostModel;
    $data = $SitePostModel->getProduct($params);

    if ($data == null) {
      return redirect('cms/danh-muc/list')->with('thongbao', 'Không tìm thấy nội dung!');
    }

    $SiteSlideModel = new SiteSlideModel;
    $data->slider = $SiteSlideModel->getList($id);
    return view('cms.content.product.edit', ['product' => $data]);
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
    $data->content = $request->content;
    $data->tags = $request->tags;
    $data->order = $request->order;
    $data->featured_image = $request->featured_image;
    $data->thump_image = $request->thump_image;
    $data->parent = $request->parent;
    $data->status = $request->status;
    $data->featured_image = $request->featured_image;
    $data->thump_image = $request->thump_image;

    DB::beginTransaction();
    try {
      $data->save();
      $data = array(
        'quantity' => ($request->quantity != '') ? $request->quantity : 0,
        'sale' => ($request->sale != '') ? $request->sale : 0,
        'origin_price' => ($request->origin_price != '') ? $request->origin_price : 0,
      );
      if (DB::table('site_product')->where('post_id', $id)->exists() == true) {
        DB::table('site_product')->where('post_id', $id)->update($data);
      } else {
        $data['post_id'] = $id;
        DB::table('site_product')->insert($data);
      }
      
      $slide_old = SiteSlideModel::where('post_id', $id)->get();
      if (isset($slide_old) && count($slide_old) > 0) {
        foreach ($slide_old as $value) {
          @unlink($value->thumb);
        }
      }
      SiteSlideModel::where('post_id', $id)->delete();
      if (isset($request->slider) && count($request->slider) > 0) {
        foreach ($request->slider as $value) {
          if ($value != '') {
            if ($value[0] == "/") {
              $value =  substr($value, 1);
            }
            $thumb = explode('/', urldecode($value));
            $thumb = array_values(array_slice($thumb, -2, 2, true));
            $path = 'public/media/.tmb/'.$thumb[0];
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $thumb = 'public/media/.tmb/'.$thumb[0].'/'.$thumb[1];
            Image::make(urldecode($value))->resize(100, 75)->save($thumb);
            $data = array(
              'post_id' => $id,
              'image' => $value,
              'thumb' => $thumb,
            );
            SiteSlideModel::insert($data);
          }
        }
      }
      DB::commit();
      return redirect('cms/san-pham/edit/'.$id)->with('thongbao', 'Cập nhật thành công');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::alert($e->getMessage());
      return back()->with('thongbao', 'Cập nhật thất bại, vui lòng thử lại sau');
    }
  }

  public function getDelete($id)
  {
    view()->share(['path' => 'delete']);
    $this->path = 'delete';
    DB::beginTransaction();
    try {
      $rs = SitePostModel::find($id);
      $rs->delete();
      DB::table('site_product')->where('post_id', $id)->delete();
      DB::commit();
      return '1';
    } catch (\Exception $e) {
      DB::rollBack();
      Log::alert($e->getMessage());
      return '0';
    }
  }

}