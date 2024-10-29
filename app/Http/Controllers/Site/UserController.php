<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Models\UserModel;
use App\Models\ResetPassword;
use App\Models\SiteConfigModel;
use App\Models\SitePostModel;
use App\Models\UserRoleModel;                 
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use Session;
use Mail;
use Cart;
use DB; 
use Log;

class UserController extends Controller
{
  //
  function __construct()
  {
    ResetPassword::where('created_at', '<=', Carbon::now()->subDay())->delete();
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
    if ($news_id != null) {
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
    
    $hot = SitePostModel::where('parent', '0')->where('type', 'product')->limit(3)->orderBy('view', 'DESC')->where('status', 'public')->get();
    view()->share(['configs' => $configs, 'categories' => $categories, 'hot' => $hot, 'news' => $data_news]);

    $this->middleware(function ($request, $next) {
      $cart = Cart::content();
      view()->share(['cart' => $cart]);
      return $next($request);
    });
  }

  public function getRegister()
  {
    if (Auth::user()) {
      return redirect('tai-khoan/quan-ly');
    }
    return view('site.content.register');
  }

  public function postRegister(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'email' => 'required|unique:users',
    ],[
      'email.unique' => 'Email này đã tồn tại trên hệ thống',
    ]);
      
    if ($validator->fails()) {
      if ($request->has('type')) {
        return response()->json([
          'status' => false,
          'code' => 500,
          'message' => 'Đăng ký thất bại, Email này đã tồn tại trên hệ thống',
        ],Response::HTTP_OK);
      } else {
        Session::flash('thongbao', $validator->messages()->first());
        return redirect()->back()->withInput();
      }
    }

    $user = new UserModel;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt(Str::random(6));
    $user->gender = $request->gender;
    DB::beginTransaction();
    try {
      $user->save();
      $insertedId = $user->id;
      //Xóa toàn bộ token cũ của user này nếu có
      $clearToken = ResetPassword::where('email', $user->email)->delete();
      $resetPassword = ResetPassword::insert([
        'email' => $user->email, 
        'token' => Str::random(60), 
        'created_at' => Carbon::now()
      ]);
      $token = ResetPassword::where('email', $request->email)->orderBy('id', 'DESC')->first();
      $link = url('/tai-khoan/xac-thuc')."/".$token->token;
      $email = $request->email;
      $data = array(
        'active_code' => $link,
        'content' => 'Bạn hay ai đó đã sử dụng email này để gửi một yêu cầu đăng ký tài khoản tại '.url('/').'. Nếu không phải là bạn vui lòng bỏ qua email này, còn không xin vui lòng truy cập theo link dưới đây để xác thực yêu cầu.',
      );
      Mail::send('cms.master.email.authcode', $data, function($message) use ($email) {
        $message->to($email)
        ->subject('[NHN] Xác thực đăng ký tài khoản');
        $message->from(env('MAIL_USERNAME', 'phanphoinhomhn@gmail.com'),'Công ty CP Phân phối nhôm HN');
      });
      DB::commit();
      if ($request->has('type')) {
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Đăng ký thành công, vui lòng kiểm tra lại email của bạn và xác thực yêu cầu trong vòng 24 tiếng để xác thực lại yêu cầu của bạn!',
        ],Response::HTTP_OK);
      }
      return redirect('tai-khoan/dang-ky')->with('thongbao', 'Đăng ký thành công, vui lòng kiểm tra lại email của bạn và xác thực yêu cầu trong vòng 24 tiếng để xác thực lại yêu cầu của bạn!');
    } catch (\Exception $e) {
      DB::rollBack();
      if ($request->has('type')) {
        return response()->json([
            'status' => false,
            'code' => 500,
            'message' => 'Đăng ký thất bại, vui lòng thử lại sau',
        ],Response::HTTP_OK);
      }
      return back()->with('thongbao', 'Đăng ký thất bại, vui lòng thử lại sau');
    }
  }

  public function getActiceAccount($key=null, Request $request)
  {
    if (!$key) {
      return abort(404);
    }

    $check = ResetPassword::where('token', $key)->first();
    if ($check) {
      return view('site.content.changepass', compact("key"));
    } else {
      return abort(404);
    }
  }

  public function postActiceAccount(Request $request)
  {
    $this->validate($request, [
      'password' => 'required|min:6|required_with:password_confirmation|same:password_confirmation',
      'password_confirmation' => 'min:6'
    ]);

    if (!$request->_key) {
      return redirect('tai-khoan/dang-nhap')->with('thongbao', trans('lang.500'));
    }

    $check = ResetPassword::where('token', $request->_key)->first();
    if ($check != '') {
      UserModel::where('email', $check->email)->where('status','>=', '0')->update(['password'=>bcrypt($request->password),'status'=>1]);
      ResetPassword::where('token', $request->_key)->delete();
      return redirect('tai-khoan/dang-nhap')->with('thongbao', trans('cms.phuc_hoi_hoan_toan'));
    } else {
      return redirect('tai-khoan/dang-nhap')->with('thongbao', trans('lang.500'));
    }
  }

  public function getLogin()
  {
    if (Auth::user()) {
      return redirect('tai-khoan/quan-ly');
    }
    return view('site.content.login');
  }

  public function postLogin(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required|min:3|max:32'
    ]);

    $rememberme = ($request->has('rememberme')) ? true : false;
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $rememberme)) {
      $user = Auth::user();
      if ($user->status > 0) {
        if ($request->has('type')) {
          return response()->json([
              'status' => true,
              'code' => 200,
              'message' => 'Đăng nhập thành công',
          ],Response::HTTP_OK);
        }
        return redirect('/');
      } else {
        Auth::logout();
        if ($request->has('type')) {
          return response()->json([
              'status' => false,
              'code' => 500,
              'message' => 'Đăng nhập thất bại, tài khoản của bạn đang bị tạm khóa hoặc chưa được kích hoạt để sử dụng',
          ],Response::HTTP_OK);
        }
        return back()->with('thongbao', 'Đăng nhập thất bại, tài khoản của bạn đang bị tạm khóa hoặc chưa được kích hoạt để sử dụng');
      }
    } else {
      if ($request->has('type')) {
        return response()->json([
            'status' => false,
            'code' => 500,
            'message' => 'Đăng nhập thất bại, tài khoản hoặc mật khẩu không đúng',
        ],Response::HTTP_OK);
      }
      return back()->with('thongbao', 'Đăng nhập thất bại, tài khoản hoặc mật khẩu không đúng');
    }
  }

  public function postRecover(Request $request)
  {
    $this->validate($request, [
        're_email' => 'required|email'
      ],[
        're_email.required' => 'Trường khôi phục email không được để trống.',
        're_email.email' => 'Trường khôi phục email phải là một địa chỉ email hợp lệ.',
    ]);
    $result = UserModel::where('email', $request->re_email)->first();
    if($result != ''){
      // Xóa toàn bộ token cũ của user này nếu có
      ResetPassword::where('email', $request->re_email)->delete();
      DB::beginTransaction();
      try {
        $resetPassword = ResetPassword::insert([
          'email' => $request->re_email, 
          'token' => Str::random(60), 
          'created_at' => Carbon::now()
        ]);
        $token = ResetPassword::where('email', $request->re_email)->orderBy('id', 'DESC')->first();
        $link = url('tai-khoan/xac-thuc')."/".$token->token;
        $email = $request->re_email;
        $data = array(
          'active_code' => $link,
          'content' => 'Bạn hay ai đó đã sử dụng email này để gửi một yêu cầu thay đổi mật khẩu. Nếu không phải là bạn vui lòng bỏ qua email này, còn không xin vui lòng truy cập theo link dưới đây để xác thực yêu cầu.',
        );
        Mail::send('cms.master.email.authcode', $data, function($message) use ($email) {
          $message->to($email)
          ->subject('[NHN] Thiết lập lại mật khẩu');
          $message->from(env('MAIL_USERNAME', 'phanphoinhomhn@gmail.com'),'Công ty CP Phân phối nhôm HN');
        });
        DB::commit();
        if ($request->has('type')) {
          return response()->json([
              'status' => true,
              'code' => 200,
              'message' => 'Gửi yêu cầu thành công, vui lòng kiểm tra lại email của bạn và xác thực yêu cầu trong vòng 24 tiếng để lấy cài đặt lại mật khẩu của bạn!',
          ],Response::HTTP_OK);
        }
        return redirect('tai-khoan/dang-nhap')->with('thongbao', 'Gửi yêu cầu thành công, vui lòng kiểm tra lại email của bạn và xác thực yêu cầu trong vòng 24 tiếng để lấy cài đặt lại mật khẩu của bạn!');  
      } catch (\Exception $e) {
        DB::rollBack();
        if ($request->has('type')) {
          return response()->json([
              'status' => false,
              'code' => 500,
              'message' => 'Gửi yêu cầu thất bại, vui lòng thử lại sau',
              'data' => [
                  'request' => $request->all(),
              ],
          ],Response::HTTP_OK);
        }
        return back()->with('thongbao', 'Gửi yêu cầu thất bại, vui lòng thử lại sau');
      }
    } else {
      if ($request->has('type')) {
        return response()->json([
            'status' => false,
            'code' => 500,
            'message' => 'Không tồn tại tài khoản này trên hệ thống',
            'data' => [
              'request' => $request->all(),
            ],
        ],Response::HTTP_OK);
      }
      return back()->with('thongbao', 'Không tồn tại tài khoản này trên hệ thống');
    }
  }

  public function getUserInfo()
  {
    if (Auth::user()) {
      $user = Auth::user();
      $user->role = @UserRoleModel::find($user->role)->title;
      return view('site.content.user', ['user' => $user]);
    }
    return redirect('tai-khoan/dang-nhap')->with('thongbao', 'Vui lòng đăng nhập để sử dụng chức năng này!');
  }

  public function postUserInfo(Request $request)
  {
    if (Auth::user()) {
      $check = Auth::user();
      $user = UserModel::find($check->id);
      $this->validate($request, [
        'name' => 'required',
        'gender' => 'required',
      ]);

      if($request->hasfile('avatar'))
      {
        $this->validate($request, [
          'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ],[
            'avatar.image' => 'File ảnh lỗi!',
            'avatar.mimes' => 'Định dạng không đúng, chỉ chấp nhận định dạng jpeg,png,jpg,gif,svg',
            'avatar.max' => 'Dung lượng ảnh quá lớn!',
          ]);
        $path = '/media/items/';
        if (!file_exists(public_path().$path)) { mkdir(public_path().$path, 0777, true);}
        $image = $request->file('avatar');
        $name = $image->getClientOriginalName();
        $image->move(public_path().$path, $name);
        $user->avatar = asset('/').'public'.$path.$name;
      }

      if ($request->has('password') && $request->password != '') {
        $this->validate($request, [
          'password' => 'required|min:4|max:32|confirmed',
          ],[
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Password không được nhỏ hơn 4 kí tự',
            'password.max' => 'Password không được lớn hơn 32 kí tự',
            'password.confirmed' => 'Password xác nhận không khớp',
          ]);
        $user->password = bcrypt($request->password);
      }

      $user->name = $request->name;
      $user->gender = $request->gender;

      if ($user->save()) {
        return redirect('tai-khoan/quan-ly')->with('thongbao', 'Cập nhật thành công');
      }else{
        return back()->with('thongbao', 'Cập nhật thất bại, vui lòng thử lại sau');
      }
    }
    return redirect('tai-khoan/dang-nhap')->with('thongbao', 'Vui lòng đăng nhập để sử dụng chức năng này!');
  }

  public function getLogout()
  {
    Auth::logout();
    \Session::flush();
    return redirect('tai-khoan/dang-nhap')->with('thongbao', 'Đăng xuất thành công');
  }

  public function googlepage() {
    Session::flash('url', Session::previousUrl());
    return Socialite::driver('google')->redirect();
  }

  public function googlecallback() {
    try {
      $user = Socialite::driver('google')->user();
      $finduser = UserModel::where('email', $user->email)->first();
      if($finduser) {
        Auth::login($finduser);
        if (Session::has('url')) {
          return redirect()->intended(Session::get('url'));
        } else {
          return redirect()->intended();
        }
      } else {
        $newUser = UserModel::create([
          'name' => $user->name,
          'email' => $user->email,
          'avatar' => $user->avatar,
          'password' => encrypt('123fastlogin')
        ]);
        Auth::login($newUser);
        if (Session::has('url')) {
          return redirect()->intended(Session::get('url'));
        } else {
          return redirect()->intended();
        }
      }
    } catch (Exception $e) {
      Log::alert($e->getMessage());
      return redirect()->intended();
    }
  }

  public function facebookpage() {
    Session::flash('url', Session::previousUrl());
    return Socialite::driver('facebook')->redirect();
  }

  public function facebookcallback() {
    try {
      $user = Socialite::driver('facebook')->user();
      $finduser = UserModel::where('email', $user->email)->first();
      if($finduser) {
        Auth::login($finduser);
        if (Session::has('url')) {
          return redirect()->intended(Session::get('url'));
        } else {
          return redirect()->intended();
        }
      } else {
        $newUser = UserModel::create([
          'name' => $user->name,
          'email' => $user->email,
          'avatar' => $user->avatar,
          'password' => encrypt('123fastlogin')
        ]);
        Auth::login($newUser);
        if (Session::has('url')) {
          return redirect()->intended(Session::get('url'));
        } else {
          return redirect()->intended();
        }
      }
    } catch (Exception $e) {
      Log::alert($e->getMessage());
      return redirect()->intended();
    }
  }

  public function facebookdeleteioncallback(Request $request) {
    header('Content-Type: application/json');
    $signed_request = $request->signed_request;
    $data = parse_signed_request($signed_request);
    $user_id = $request->input('user_id');
    Log::alert('signed_request='.$request->signed_request.',user_id='.$user_id);
    Log::alert($request->all());

    // Start data deletion

    $status_url = url('deletion?id='.$user_id); // URL to track the deletion
    $confirmation_code = $user_id.'abc123'; // unique code for the deletion request

    $data = array(
      'url' => $status_url,
      'confirmation_code' => $confirmation_code
    );
    echo json_encode($data);
  }

  public function zalopage() {
    Session::flash('url', Session::previousUrl());
    return Socialite::driver('zalo')->redirect();
  }

  public function zalocallback(Request $request) {

    // Lấy access tpken OA
    $url = 'https://oauth.zaloapp.com/v4/oa/access_token';
    $data = array(
      'app_id' => env('ZALO_CLIENT_ID'),
      'code' => $request->input('code'),
      'grant_type' => 'authorization_code',
    );
    $param = '';
    foreach ($data as $key => $value) {
      if ($key == 'app_id') {
        $param .= $key.'='.$value;
      } else {
        $param .= '&'.$key.'='.$value;
      }
    }
    $data = $param;
    $headers = array(
      'Content-Type: application/x-www-form-urlencoded',
      'secret_key: '.env('ZALO_CLIENT_SECRET'),
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 'POST');
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = json_decode(curl_exec($curl));
    curl_close ($curl);
    if (isset($result->access_token)) {
      // Lấy thông tin usẻr
      $url = "https://graph.zalo.me/v2.0/me?fields=id,name,picture";
      $headers = array(
        'access_token: '.$result->access_token
      );
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = json_decode(curl_exec($curl));
      curl_close($curl);
      if ($response->error == 0) {
        try {
          $user = $response;
          $finduser = UserModel::where('zalo_id', $user->id)->first();
          if($finduser) {
            Auth::login($finduser);
            if (Session::has('url')) {
              return redirect()->intended(Session::get('url'));
            } else {
              return redirect()->intended();
            }
          } else {
            $newUser = UserModel::create([
              'name' => $user->name,
              'zalo_id' => $user->id,
              'avatar' => $user->picture->data->url,
              'password' => encrypt('123fastlogin')
            ]);
            Auth::login($newUser);
            if (Session::has('url')) {
              return redirect()->intended(Session::get('url'));
            } else {
              return redirect()->intended();
            }
          }
        } catch (Exception $e) {
          Log::alert($e->getMessage());
          return redirect()->intended();
        }
      }
    }
    return redirect()->intended();
  }

}