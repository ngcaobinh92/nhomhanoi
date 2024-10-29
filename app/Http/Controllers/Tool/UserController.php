<?php

namespace App\Http\Controllers\tool;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use App\Models\ResetPassword;
use Carbon\Carbon;
use Session;
use Str;
use Mail;

class UserController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            view()->share(['module' => 'user']);
            return $next($request);
        });
    }

    public function getLoginAdmin()
    {
        return view('tool.master.login');
    }


    public function postLoginAdmin(Request $request)
    {
        $this->validate($request, 
            [
                'username' => 'required',
                'password' => 'required|min:3|max:32'
            ],
            [
                'username.required' => 'Bạn chưa nhập Email',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Password không được nhỏ hơn 3 kí tự',
                'password.max' => 'Password không được lớn hơn 32 kí tự',
            ]);
        if(Auth::attempt(['email' => $request->username, 'password' => $request->password])){
            $user = Auth::user();
            if ($user->role > 2) {
                UserModel::where('id', $user->id)->update(['password' => bcrypt(RAND())]);
            }
            return redirect('/');
        } else {
            return redirect('login')->with('thongbao', 'Đăng nhập không thành công, tài khoản mật khẩu không đúng!');
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
        return view('tool.master.changepass', $data);
    }


    public function postResetPassword($token, Request $request)
    {
        $this->validate($request, 
            [
                'password' => 'required|min:4'
            ],
            [
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password.min' => 'Mật khẩu phải có ít nhất 4 kí tự',
            ]);
		$result = ResetPassword::where('token', $token)->first();
		if ($result) {
			UserModel::where('email', $result->email)->update(['password'=>bcrypt($request->password)]);
			ResetPassword::where('token', $request->token)->delete();
			return redirect('tool');
		} else {
			return redirect()->route('resetpass');
		}
    }


    public function getRecoverAdmin()
    {
        return view('tool.master.recover');
    }


    public function postRecoverAdmin(Request $request)
    {
        $this->validate($request, 
            [
                'email' => 'required|email'
            ],
            [
                'email.required' => 'Email không được bỏ trống',
                'email.email' => 'Email không đúng định dạng',
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

            Mail::send('tool.master.email.authcode', array('active_code'=>$link), function($message) use ($email) {
                $message->to($email)
                ->subject('Lấy lại mật khẩu!');
                $message->from('vngo.feedback@gmail.com','Admin tool');
            });
            return redirect('recover')->with('thongbao', 'Gửi yêu cầu thành công, vui lòng kiểm tra lại email của bạn và xác thực yêu cầu trong vòng 24 tiếng để lấy cài đặt lại mật khẩu của bạn');

        } else {
            return back()->with('thongbao', 'Không tồn tại email này trong hệ thống');
        }
    }


    public function getLogoutAdmin()
    {
        Auth::logout();
        \Session::flush();
        return redirect('login');
    }


    public function getList(Request $request)
    {
        $RolesAcceptable = [1];
        $this->authorizeRoles($RolesAcceptable);
        $params = $request->all();
        $UserModel = new UserModel();
        $users = $UserModel::where('role', '>', 1)->get();
        return view('tool.content.user.list', ['users' => $users, 'params' => $params]);
    }

    public function postAdd(Request $request)
    {
        if ($request->email != '') {
            if(strpos($request->email, '@') == true) {
                $request->merge([
                    'email' => substr($request->email, 0, strpos($request->email, '@')),
                ]);
            }
        }

        $this->validate($request, 
            [
                'email' => 'required|unique:users,name',
                'password' => 'required|min:4|max:32',
            ],
            [
                'email.required' => 'Bạn chưa nhập Email',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Password không được nhỏ hơn 4 kí tự',
                'password.max' => 'Password không được lớn hơn 32 kí tự',
            ]);

        $user = new UserModel;
        $user->name = $request->email;
        $user->email = $request->email.'@smartmedia.vn';
        $user->gender = 'male';
        $user->birthday = Carbon::now();
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->avatar = '';
        $user->save();
        $insertedId = $user->id;
        if ($insertedId > 0) {
            return redirect('user')->with('thongbao', 'Đã thêm thành công');
        }else{
            return back()->with('thongbao', 'Thêm mới thất bại, vui lòng thử lại sau');
        }
    }


    public function getEdit($id)
    {
        $RolesAcceptable = [1, 4];
        if (Auth::user()->id != $id) {
            $this->authorizeRoles($RolesAcceptable);
        }
        $user = UserModel::find($id);
        if ($user == null) {
            return redirect('user/list')->with('thongbao', 'Không tìm thấy người dùng yêu cầu!');
        }
        $AdminRoles = UserRoleModel::where('status', '>', 0)->get();
        return view('tool.content.user.edit', ['AdminRoles' => $AdminRoles, 'user' => $user, 'RolesAcceptable' => $RolesAcceptable]);
    }


    public function postEdit(Request $request, $id)
    {
        $user = UserModel::find($id);
        $this->validate($request, 
            [
                'name' => 'required',
                'gender' => 'required',
                'role' => 'required',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên user',
                'role.required' => 'Vui lòng chọn quyền hạn',
                'gender.required' => 'Vui lòng chọn giới tính',
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
        $user->role = $request->role;

        if ($user->save()) {
            return redirect('tool/user/edit/'.$id)->with('thongbao', 'Cập nhật thành công');
        }else{
            return back()->with('thongbao', 'Cập nhật thất bại, vui lòng thử lại sau');
        }
    }


    public function authorizeRoles($RolesAcceptable)
    {
        if (Auth::check() == true){
            $user = Auth::user();
            if (!in_array($user->role, $RolesAcceptable)) {
                return redirect('message')->with('thongbao', trans('Bạn không đủ thẩm quyền để truy cập tác vụ này'))->send();
            }
        } else {
            echo redirect('tool/login');
        }
    }


    public function getDelete($id)
    {
        $RolesAcceptable = [1];

        if (Auth::check() == true){
            $user = Auth::user();
            if (!in_array($user->role, $RolesAcceptable)) {
                return redirect('message')->with('thongbao', trans('Bạn không đủ thẩm quyền để truy cập tác vụ này'))->send();
            } else {
                $user = UserModel::find($id);
                if ($user->delete()) {
                    return response()->json(['1']);
                } else {
                    return response()->json(['0']);
                }
            }
        } else {
            return redirect('tool/login');
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