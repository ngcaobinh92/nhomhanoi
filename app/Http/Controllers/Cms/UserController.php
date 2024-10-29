<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use App\Models\ResetPassword;
use App\Models\CMSMenuModel;
use Carbon\Carbon;
use Session;
use Mail;

class UserController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (Auth::check() == true) {
                $user = Auth::user();
                $roles_list = UserRoleModel::where('status', 1)->where('id', '>=', $user->role)->get();
                view()->share(['roles_list' => $roles_list]);
            }
            view()->share(['module' => 'user']);
            $this->module = 'user';
            return $next($request);
        });
    }

    public function getLoginAdmin()
    {
        return view('cms.master.login');
    }

    public function postLoginAdmin(Request $request)
    {
        $this->validate($request, 
            [
                'username' => 'required',
                'password' => 'required|min:3|max:32'
            ]);
        $rememberme = ($request->has('rememberme')) ? true : false;
        if(Auth::attempt(['email' => $request->username, 'password' => $request->password], $rememberme)) {
            return redirect('cms');
        } else {
            return redirect('cms/login')->with('thongbao', trans('cms.dang_nhap_loi'));
        }
    }

    public function getResetPassword($token = '', $data = [])
    {
    	$data['info'] = '';
    	if ($token != '') {
        	ResetPassword::where('created_at', '<=', Carbon::now()->subDay())->delete();
	    	$result = ResetPassword::where('token', $token)->first();
	    	if ($result) {
	    		$data['info'] = $result->token;
	    	}
	    }
        return view('cms.master.changepass', $data);
    }

    public function postResetPassword($token, Request $request)
    {
        $this->validate($request, 
            [
                'password' => 'required|min:4'
            ]);
		$result = ResetPassword::where('token', $token)->first();
		if ($result) {
			UserModel::where('email', $result->email)->update(['password'=>bcrypt($request->password)]);
			ResetPassword::where('token', $request->token)->delete();
			return redirect()->route('login')->with('thongbao', trans('cms.phuc_hoi_hoan_toan'));
		} else {
			return redirect()->route('resetpass');
		}
    }

    public function getRecoverAdmin()
    {
        return view('cms.master.recover');
    }

    public function postRecoverAdmin(Request $request)
    {
        $this->validate($request, 
            [
                'email' => 'required|email'
            ]);
        $result = UserModel::where('email', $request->email)->first();
        if($result){
        	ResetPassword::where('created_at', '<=', Carbon::now()->subDay())->delete();
        	ResetPassword::where('email', $request->email)->delete();
        	$resetPassword = ResetPassword::insert([
        		'email' => $request->email, 
        		'token' => Str::random(60), 
        		'created_at' => Carbon::now()
        	]);
    		$token = ResetPassword::where('email', $request->email)->orderBy('id', 'DESC')->first();
    		
    		$link = url('resetPassword')."/".$token->token;
            $email = $request->email;

            /***************************************************************************
            'We heard that you lost your password. Sorry about that!

            But don’t worry! You can use the following link to reset your password:{{$link}}

            If you don’t use this link within 24 hours, it will expire. To get a new password reset link, visit {{$url_reset}}
            Thanks'
            ***************************************************************************/

            Mail::send('cms.master.email.authcode', array('active_code'=>$link), function($message) use ($email) {
                $message->to($email)
                ->subject(trans('cms.lay_lai_mat_khau'));
                $message->from('vngo.feedback@gmail.com','Admin CMS');
            });
            return redirect('cms/recover')->with('thongbao', trans('cms.phuc_hoi_thanh_cong'));

        } else {
            return back()->with('thongbao', trans('cms.khong_co_email'));
        }
    }

    public function getLogoutAdmin()
    {
        Auth::logout();
        \Session::flush();
        return redirect('cms/login');
    }


    public function getList(Request $request)
    {
        view()->share(['path' => 'list']);
        $this->path = 'list';
        $this->authorizeRoles();

        $params = $request->all();
        $UserModel = new UserModel();
        $users = $UserModel::where('id', '>', 1)->where('role', '>=', Auth::user()->role)->get();

        return view('cms.content.user.list', ['users' => $users, 'params' => $params]);
    }

    public function getAdd()
    {
        view()->share(['path' => 'add']);
        $this->path = 'add';
        $this->authorizeRoles();
        $AdminRoles = UserRoleModel::where('status', '>', 0)->get();
        return view('cms.content.user.add', ['AdminRoles' => $AdminRoles, 'RolesAcceptable' => $this->RolesAcceptable]);
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, 
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:4|max:32',
                'gender' => 'required',
                'role' => 'required',
            ]);
        $featured_image = '';

        if($request->hasfile('avatar'))
        {
            $this->validate($request, 
            [
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'avatar.image' => 'File ảnh lỗi!',
                'avatar.mimes' => 'Định dạng không đúng, chỉ chấp nhận định dạng jpeg,png,jpg,gif,svg',
                'avatar.max' => 'Dung lượng ảnh quá lớn!',
            ]);
            $path = '/media/items/';
            if (!file_exists(public_path().$path)) { mkdir(public_path().$path, 0777, true);}
            $image = $request->file('avatar');
            $name = $image->getClientOriginalName();
            $image->move(public_path().$path, $name);
            $featured_image = asset('/').'public'.$path.$name;
        }

        $user = new UserModel;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->avatar = $featured_image;
        $user->save();
        $insertedId = $user->id;
        if ($insertedId > 0) {
            return redirect('cms/user/list')->with('thongbao', 'Đã thêm thành công');
        }else{
            return back()->with('thongbao', 'Thêm mới thất bại, vui lòng thử lại sau');
        }
    }

    public function getEdit($id)
    {
        view()->share(['path' => 'edit']);
        $this->path = 'edit';
        if (Auth::user()->id != $id) {
            $this->authorizeRoles();
        } else {
            $category_master = CMSMenuModel::select('id')->where('url', $this->module)->first();
            if ($category_master != '') {
                $category_role = CMSMenuModel::select('require')->where('menu_id', $category_master->id)->where('url', $this->path)->first();
                if ($category_role != '') {
                    $this->RolesAcceptable = explode(',', $category_role->require);
                } else {
                    $this->RolesAcceptable = [0];
                }
            } else {
                $this->RolesAcceptable = [0];
            }
        }
        
        $user = UserModel::find($id);
        if ($user == null) {
            return redirect('cms/user/list')->with('thongbao', 'Không tìm thấy người dùng yêu cầu!');
        }
        $AdminRoles = UserRoleModel::where('status', '>', 0)->get();
        return view('cms.content.user.edit', ['AdminRoles' => $AdminRoles, 'user' => $user, 'RolesAcceptable' => $this->RolesAcceptable]);
    }

    public function postEdit(Request $request, $id)
    {
        $user = UserModel::find($id);
        $this->validate($request, 
            [
                'name' => 'required',
                'gender' => 'required',
            ]);
        if($request->hasfile('avatar'))
        {
            $this->validate($request, 
            [
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
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
            $this->validate($request, 
                [
                    'password' => 'required|min:4|max:32|confirmed',
                ],
                [
                    'password.required' => 'Bạn chưa nhập mật khẩu',
                    'password.min' => 'Password không được nhỏ hơn 4 kí tự',
                    'password.max' => 'Password không được lớn hơn 32 kí tự',
                    'password.confirmed' => 'Password xác nhận không khớp',
                ]);
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->gender = $request->gender;
        if (isset($request->role) && $request->role != '') {
            $user->role = $request->role;
        }

        if ($user->save()) {
            return redirect('cms/user/edit/'.$id)->with('thongbao', 'Cập nhật thành công');
        }else{
            return back()->with('thongbao', 'Cập nhật thất bại, vui lòng thử lại sau');
        }
    }

    public function authorizeRoles()
    {
        if (Auth::check() == true){
            $user = Auth::user();
            $category_master = CMSMenuModel::select('id')->where('url', $this->module)->first();
            if ($category_master != '') {
                $category_role = CMSMenuModel::select('require')->where('menu_id', $category_master->id)->where('url', $this->path)->first();
                if ($category_role != '') {
                    $category_role = explode(',', $category_role->require);
                    if (!in_array($user->role, $category_role)) {
                        return redirect('cms/message/show')->with('thongbao', trans('cms.khong_cho_phep'))->send();
                    } else {
                        $this->RolesAcceptable = $category_role;
                    }
                } else {
                return redirect('cms')->send();
                }
            } else {
                return redirect('cms')->send();
            }
        } else {
            return redirect('cms/login')->send();
        }
    }

    public function getDelete($id)
    {
        view()->share(['path' => 'delete']);
        $this->path = 'delete';
        $this->authorizeRoles();
        $user = UserModel::find($id);
        if ($user->delete()) {
            return response()->json(['1']);
        } else {
            return response()->json(['0']);
        }
    }

    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);
        return redirect()->back();
    }

    public function changeLanguagePost($language)
    {
        $user = Auth::user();
        if ($user != null) {
            $user->lang = $language;
            $user->save();
        }
        \Session::put('post_language', $language);
        return redirect()->back();
    }
}