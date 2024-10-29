<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Session;
use \Crypt;
use \Log;
use File;
use DB;
use App\Models\SitePostModel;
use App\Models\SiteConfigModel;
use App\Models\UserModel;
use App\Models\CommentModel;
use App\Models\SiteProductModel;
use App\Models\SiteSlideModel;
use App\Models\SiteCartModel;
use App\Models\CMSNotificationModel;
use Illuminate\Support\Facades\Redirect;
use Cart;
use HTMLDomParser;

class HomeController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
  **/

  function __construct()
  {
    $configs = SiteConfigModel::first();
    $categories = SitePostModel::where('parent', '0')->where('type', 'category')->where('status', 'public')->get();
    if (count($categories) > 0) {
      foreach ($categories as $category) {
        $category->child = SitePostModel::where('parent', $category->id)->where('type', 'category')->where('status', 'public')->get();
        if (count($category->child) > 0) {
          foreach ($category->child as $child) {
            $child->child = SitePostModel::where('parent', $child->id)->where('type', 'category')->where('status', 'public')->get();
          }
        }
      }
    }
    $news_id = SitePostModel::select('id')->where('status', 'public')->where('slug', 'tin-tuc')->first();
    if (@count($news_id) > 0) {
      $rs = SitePostModel::where('status', 'public')->where('parent', $news_id->id)->orderBy('created_at', 'DESC')->get();
      $total = $rs->count();
      $news = $rs->take(5);
    } else {
      $news = array();
      $total = 0;
    }

    $data_news = array(
      'total' => $total,
      'news' => $news,
    );

    $hot = SitePostModel::where('type', 'product')->orderBy('view', 'DESC')->where('status', 'public')->limit(3)->get();
    view()->share(['configs' => $configs, 'categories' => $categories, 'hot' => $hot, 'news' => $data_news]);

    $this->middleware(function ($request, $next) {
      $cart = Cart::content();
      view()->share(['cart' => $cart]);
      return $next($request);
    });
  }

  public function ajaxRequest()
  {
    return view('ajaxRequest');
  }

  public function ajaxRequestPost(Request $request)
  {
    $input = $request->all();
    return response()->json(['success'=>'Got Simple Ajax Request.']);
  }

  public function getTest() {
    // $rs = file_get_html('');
    $url = 'https://www.xingfa.vn/product-category/cua-so-mo-truot/';
    $rs = HTMLDomParser::file_get_html($url)->find('.product-title')[0]->plaintext;
    // $rs = file_get_contents($url);
    // $tieude = $rs->find('.product-title',0)->outertext;
    // $rs ->load($rs ->save());/
    // $tieude = $rs->find('.title_news',0);
    // $noidung = $rs->find('#article_content',0);

    echo $rs;

    // return response()->json([
        // 'now' => $now,
        // 'today' => $today,
        // 'time' => $time,
        // 'dt' => $dt,
        // 'rs' => $rs,
    // ], Response::HTTP_OK);

  }

  public function getHome($slug=null, Request $request)
  {
    $data = array();
    $params = $request->all();
    if (!$slug) {
      $view = 'site.content.home';
      $news = SitePostModel::where('type', 'new')->where('status', 'public')->orderBy('created_at', 'DESC')->orderBy('order', 'DESC')->get()->take(10);
      $hots = SitePostModel::join('site_product', 'site_post.id', '=', 'site_product.post_id')->select('site_post.id','title','slug','featured_image','thump_image','type','view','quantity','sale','origin_price')->where('type', 'product')->where('status', 'public')->orderBy('view', 'DESC')->orderBy('order', 'DESC')->get()->take(16);
      $header_slide = SiteSlideModel::where('post_id', '0')->orderBy('order', 'DESC')->get();
      $pro_id = SitePostModel::where('slug', 'san-pham')->first();

      // Lấy ra 10 sản phẩm theo danh sách category
      if ($pro_id != '') {
        $procategories = SitePostModel::select('id','title','slug','featured_image','thump_image','type','view')->where('parent', $pro_id->id)->where('status', 'public')->orderBy('order', 'DESC')->orderBy('created_at', 'DESC')->get();
        if ($procategories != '') {
          foreach ($procategories as $category) {
            $product_total = array();
            $child = SitePostModel::join('site_product', 'site_post.id', '=', 'site_product.post_id')->select('site_post.id','title','slug','featured_image','thump_image','type','view','quantity','sale','origin_price')->where('parent', $category->id)->where('status', 'public')->orderBy('order', 'DESC')->orderBy('created_at', 'DESC')->get();
            if ($child != '') {
              foreach ($child as $value) {
                if ($value->type == 'category') {
                  $product_total[] = SitePostModel::join('site_product', 'site_post.id', '=', 'site_product.post_id')->select('site_post.id','title','slug','featured_image','thump_image','type','view','quantity','sale','origin_price')->where('parent', $value->id)->where('status', 'public')->where('type', 'product')->orderBy('order', 'DESC')->orderBy('created_at', 'DESC')->get();
                } elseif ($value->type == 'product') {
                  $product_total[] = $value;
                } else {
                  //Nothing to do
                }
              }
            }
            $category->product = collect($product_total)->take(10)->all();
          }
          foreach ($procategories as $key => $value) {
            if (count($value->product) == 0) {
              unset($procategories[$key]);
            }
          }
        }
      }

      $data['news'] = $news;
      $data['hots'] = $hots;
      $data['products'] = @$procategories;
      $data['header_slide'] = $header_slide;
    } else {
      $slug_info = SitePostModel::where('slug', $slug)->where('status', 'public')->first();
      if ($slug_info != '') {
        switch ($slug_info->type) {
          case 'product':
            $view = 'site.content.product.detail';
            $slug_info->relate_product = SitePostModel::join('site_product', 'site_post.id', '=', 'site_product.post_id')->where('parent', $slug_info->parent)->where('status', 'public')->inRandomOrder()->limit(5)->get();
            $slug_info->detail_product = SiteProductModel::where('post_id', $slug_info->id)->first();
            $slug_info->slide_product = SiteSlideModel::where('post_id', $slug_info->id)->get();
            $slug_info->guide_buy = SitePostModel::find(100);
            $data['product'] = $slug_info;
            break;
          case 'new':
            $view = 'site.content.new.detail';
            $slug_info->comments = CommentModel::where('post_id', $slug_info->id)->where('status', 'public')->orderBy('created_at', 'DESC')->get();
            $data['new'] = $slug_info;
            break;
          case 'category':
            if ($slug_info->slug == 'khuyen-mai') {
              $view = 'site.content.product.category';
              $orderBy = (isset($params['orderBy']) && $params['orderBy'] != '') ? $orderBy = $params['orderBy'] : $orderBy = 'title';
              $order = (isset($params['order']) && $params['order'] != '') ? $order = $params['order'] : $order = 'ASC';
              $data['products'] = SitePostModel::leftJoin('site_product', 'site_post.id', '=', 'site_product.post_id')->select('site_post.*','site_product.quantity','site_product.sale','site_product.origin_price')->where('status', 'public')->where('type', 'product')->where('sale', '>', '0')->orderBy($orderBy, $order)->paginate(12);
            } elseif ($slug_info->slug == 'tin-tuc') {
              $view = 'site.content.new.category';
              $data['news'] = SitePostModel::where('status', 'public')->where('parent', $slug_info->id)->orderBy('created_at', 'DESC')->paginate(12);
              if (count($data['news']) > 0) {
                foreach ($data['news'] as $new) {
                  $new->comments = CommentModel::select('id')->where('post_id', $new->id)->where('status', 'public')->get()->count();
                }
              }
            } else {
              $view = 'site.content.product.category';
              $orderBy = (isset($params['orderBy']) && $params['orderBy'] != '') ? $orderBy = $params['orderBy'] : $orderBy = 'title';
              $order = (isset($params['order']) && $params['order'] != '') ? $order = $params['order'] : $order = 'ASC';
              $data['products'] = SitePostModel::leftJoin('site_product', 'site_post.id', '=', 'site_product.post_id')->select('site_post.*','site_product.quantity','site_product.sale','site_product.origin_price')->where('status', 'public')->where('parent', $slug_info->id)->orderBy($orderBy, $order)->paginate(12);
            }
            break;
          case 'page':
            $view = 'site.content.page';
            $data['page'] = $slug_info;
            break;
          default:
            // post
            $view = 'site.content.post';
            $data['post'] = $slug_info;
            break;
        }

        $bread = array();
        $bread['slug'] = $slug_info->slug;
        $bread['title'] = $slug_info->title;
        $breadcrumb = array();
        $breadcrumb[] = $bread;
        $checkID = $slug_info->parent;
        do {
          $parent = 0;
          $rs = SitePostModel::find($checkID);
          if ($rs != '') {
            $bread = array();
            $bread['slug'] = $rs->slug;
            $bread['title'] = $rs->title;
            $breadcrumb[] = $bread;
            $checkID = $rs->parent;
            $parent = $rs->parent;
          }
        } while ($parent > 0);
        $data['breadcrumb'] = array_reverse($breadcrumb);
        $plus_view = SitePostModel::find($slug_info->id);
        $plus_view->view += 1;
        $plus_view->save();
      } else {
        return abort(404);
      }
    }
    return view($view, ['data' => $data, 'params' => $params]);
  }

  public function getSearch(Request $request)
  {
    $params = $request->all();
    $result = SitePostModel::join('site_product', 'site_post.id', '=', 'site_product.post_id')->select('site_post.id','title','slug','featured_image','thump_image','quantity','sold','sale','origin_price')->where('type', 'product')->where('status', 'public')->where('title', 'like', '%'.$params['ten'].'%')->orWhere('description', 'like', '%'.$params['ten'].'%')->paginate(12);
    return view('site.content.search', ['params' => $params, 'products' => $result->appends(Input::except('page'))]);
  }

  public function getContact()
  {
    return view('site.content.contact');
  }

  public function postContact(Request $request)
  {
    $params = $request->all();

    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'content' => 'required',
    ],[
      'email.email' => 'Xin vui lòng điền đúng dịnh dạng email',
    ]);

    $noti = new CMSNotificationModel;
    $noti->title = $request->email.' - '.$request->name;
    $noti->content = $request->content;
    (Auth::user() != '') ? $noti->user_id = Auth::user()->id : $noti->user_id = '2';
    $noti->save();
    $insertedId = $noti->id;
    if ($insertedId > 0) {
      return redirect('lien-he')->with('thongbao', 'Đã gửi liên hệ thành công, chúng tôi sẽ phản hồi lại bạn trong thời gian sớm nhất có thể');
    } else {
      return back()->with('thongbao', 'Gửi yêu cầu thất bại, vui lòng thử lại sau');
    }
  }

  public function getcart(Request $request)
  {
    $request->all();
    $cart = Cart::content();
    $view = 'site.content.cart';
    if ($request->product_id) {
      $rowId = Cart::search( function($cartItem, $rowId) use($request) {
        return $cartItem->id == $request->product_id;
      });

      foreach ($rowId as $key => $value) {
        $item = Cart::get($value->rowId);
      }

      $id = @$item->rowId;

      if ($request->increment == 1 && $id != '') {
        $qty = $item->qty + 1;
        Cart::update($id, $qty);
      }

      if ($request->decrease == 1 && $id != '') {
        $qty = $item->qty - 1;
        Cart::update($id, $qty);
      }

      if ($request->remove == 1 && $id != '') {
        Cart::remove($id);
      }

      return $this->response_cart();
    }

    if ($request->destroy == 1) {
      Cart::destroy();
      return $this->response_cart();
    }

    return view($view);
  }

  public function postcart($slug)
  {
    if ($slug != '') {
      $slug_info = SitePostModel::where('slug', $slug)->where('status', 'public')->first();
      if ($slug_info->type == 'product') {
        $slug_info->detail_product = SiteProductModel::where('post_id', $slug_info->id)->first();
        $price = @$slug_info->detail_product->origin_price - ((@$slug_info->detail_product->origin_price * @$slug_info->detail_product->sale) / 100);
        $options = array(
          'image' => @$slug_info->featured_image,
          'slug' => $slug_info->slug,
        );

        $qty = 1;

        $data = array(
          'id' => $slug_info->id,
          'name' => $slug_info->title,
          'price' => $price,
          'qty' => 1,
          'weight' => 0,
          'options' => $options
        );

        // DB::beginTransaction();
        try {
          Cart::add($data);
          $status = true;
        //   DB::commit();
        } catch (\Exception $e) {
        //   DB::rollBack();
          $status = false;
          Log::alert($e->getMessage());
        }

        $data = Cart::content();
        return $this->transform_cart($data, $status);

      }
    }
  }

  public function transform_cart($cart, $status = true)
  {
    $response = '';
    $submit = '';
    $total_cart = count($cart);
    $total_bill = 0;
    if($total_cart > 0) {
      $response .= '<table class="table table-condensed"><thead style="top: 0;position: sticky;z-index: 1;background: white;"><tr class="cart_menu"><td class="image" colspan="2">Sản phẩm</td><td class="price">Giá</td><td class="quantity">Số lượng</td><td class="total">Tổng cộng</td><td></td></tr></thead><tbody>';
      $submit .= '<table class="table table-condensed"><thead style="top: 0;position: sticky;z-index: 1;background: white;"><tr class="cart_menu"><td class="image" colspan="2">Sản phẩm</td><td class="price">Giá</td><td class="quantity">Số lượng</td><td class="total">Tổng cộng</td><td></td></tr></thead><tbody>';
      foreach($cart as $item) {
        $response .= '<tr><td class="cart_product"><a href="'.$item->options->slug.'"><img src="'.$item->options->image.'" alt=""></a></td><td class="cart_description"><p><a href="'.$item->options->slug.'">'.$item->name.'</a></p></td><td class="cart_price"><p data-product-price="'.$item->id.'">'.number_format($item->price).' đ</p></td><td class="cart_quantity"><div class="cart_quantity_button"><a class="product-jian" data-href='.url("gio-hang?product_id=$item->id&decrease=1").'> - </a><span class="product-num" data-product="'.$item->id.'">'.$item->qty.'</span><a class="product-add" data-href='.url("gio-hang?product_id=$item->id&decrease=1").'> + </a></div></td><td class="cart_total"><p class="cart_total_price" data-product-total="'.$item->id.'">'.number_format($item->subtotal).' đ</p></td><td><a class="cart_change" data-href='.url("gio-hang?product_id=$item->id&remove=1").' data-product-id="'.$item->id.'"><i class="fa fa-times"></i></a></td></tr>';
        $submit .= '<tr><td class="cart_product"><a href="'.$item->options->slug.'"><img src="'.$item->options->image.'" alt=""></a></td><td class="cart_description"><p><a href="'.$item->options->slug.'">'.$item->name.'</a></p></td><td class="cart_price"><p data-product-price="'.$item->id.'">'.number_format($item->price).' đ</p></td><td class="cart_quantity"><div class="cart_quantity_button"><a class="product-jian" data-href='.url("gio-hang?product_id=$item->id&decrease=1").'> - </a><span class="product-num" data-product="'.$item->id.'">'.$item->qty.'</span><a class="product-add" data-href='.url("gio-hang?product_id=$item->id&decrease=1").'> + </a></div></td><td class="cart_total"><p class="cart_total_price" data-product-total="'.$item->id.'">'.number_format($item->subtotal).' đ</p></td><td><a class="cart_change" data-href='.url("gio-hang?product_id=$item->id&remove=1").' data-product-id="'.$item->id.'"><i class="fa fa-times"></i></a></td></tr>';
        $total_bill = $total_bill + $item->subtotal;
      }
      $response .= '</tbody></table>';
      $submit .= '</tbody></table>';
    } else {
      $response .= '<br><center>Giỏ hàng của bạn hiện đang trống.</center><br>';
      $submit .= '<br><center>Giỏ hàng của bạn hiện đang trống.</center><br>';
    }

    return response()->json([
        'status' => $status,
        'response' => $response,
        'submit' => $submit,
        'total' => $total_cart,
        'total_bill' => $total_bill,
    ], Response::HTTP_OK);
  }

  public function response_cart()
  {
    $data = Cart::content();
    return $this->transform_cart($data);
  }

  public function postpayment(Request $request)
  {
    $cart = Cart::content();
    $email = $request->email;
    $response = '';
    $submit = '';
    $total_cart = count($cart);
    $total_bill = 0;
    $now = Carbon::now()->timestamp;
    if($total_cart > 0) {
      foreach($cart as $item) {
        $add = array(
          'email' => $email,
          'name' => $item->name,
          'price' => $item->price,
          'qty' => $item->qty,
          'subtotal' => $item->subtotal,
          'tax' => $item->tax,
          'image' => $item->options->image,
          'slug' => $item->options->slug,
          'product_id' => $item->id,
          'cart_id' => $now,
        );

        DB::beginTransaction();
        try {
          SiteCartModel::insert($add);
        } catch (\Exception $e) {
          DB::rollBack();
          Log::alert($e->getMessage());
        }
      }
    }

    $cart = Cart::content();
    $total_cart = count($cart);
    $response .= '<br><center>Giỏ hàng của bạn hiện đang trống.</center><br>';
    $submit .= '<br><center>Giỏ hàng của bạn hiện đang trống.</center><br>';

    return response()->json([
        'response' => $response,
        'submit' => $submit,
        'total' => $total_cart,
        'total_bill' => $total_bill,
    ], Response::HTTP_OK);
  }

}
