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
use App\Models\CMSNotificationModel;
use App\Models\CMSMenuModel;
use Carbon\Carbon;
use Session;
use Mail;
// use App\Http\Controllers\Cms\UserController;

class NotificationController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            view()->share(['module' => 'notified']);
            $this->module = 'notified';
            return $next($request);
        });
    }

    public function getList(Request $request)
    {
        view()->share(['path' => 'list']);
        $this->path = 'list';
        $this->authorizeRoles();
        $params = $request->all();
        $param['orderby'] = 'id';
        $param['except'] = '1';
        $CMSNotificationModel = new CMSNotificationModel();
        $data = $CMSNotificationModel->getlist($param);
        return view('cms.content.messenger.list', ['data' => $data]);
    }

    public function getDelete($id)
    {
        view()->share(['path' => 'delete']);
        $this->path = 'delete';
        $this->authorizeRoles();

        $data = CMSNotificationModel::find($id);
        if ($data == null) {
            return response()->json(['0']);
        } else {
            if ($data->parent == 0) {
                $action = CMSNotificationModel::where('id', $id)->Orwhere('parent', $id)->delete();
            } else {
                $action = CMSNotificationModel::where('id', $data->parent)->Orwhere('parent', $data->parent)->delete();
            }

            if ($action) {
                return response()->json(['1']);
            } else {
                return response()->json(['0']);
            }
        }
    }

    public function getDetail($id)
    {
        view()->share(['path' => 'detail']);
        $this->path = 'detail';
        $this->authorizeRoles();
        $data = CMSNotificationModel::find($id);
        if ($data == null) {
            return redirect('cms/notified/list')->with('thongbao', 'Không tìm thấy nội dung yêu cầu!');
        } else {
            $user = UserModel::find($data->user_id);
            if ($data->parent > 0) {
                $id = $data->parent;
            }
            $data = CMSNotificationModel::where('id', $id)->Orwhere('parent', $id)->update(['status' => 0]);
            $data = CMSNotificationModel::where('id', $id)->Orwhere('parent', $id)->get();
        }

        $AdminRoles = UserRoleModel::where('status', '>', 0)->get();
        return view('cms.content.messenger.detail', ['data' => $data, 'user' => $user, 'to_noid' => $id]);
    }


    public function postDetail(Request $request, $id)
    {
        view()->share(['path' => 'detail']);
        $this->path = 'detail';
        $this->authorizeRoles();
        $data = CMSNotificationModel::find($id);

        if ($data == null) {
            return redirect('cms/notified/list')->with('thongbao', 'Không tìm thấy nội dung yêu cầu!');
        } else {
            $this->validate($request, 
                [
                    'content' => 'required',
                ]);

            $data = new CMSNotificationModel;
            $data->parent = $request->to_noid;
            $data->content = $request->content;
            $data->user_id = '0';
            $data->status = '0';
            $data->save();
            $insertedId = $data->id;
            if ($insertedId > 0) {
                return redirect('cms/notified/detail/'.$id)->with('thongbao', 'Gửi thành công');
            }else{
                return back()->with('thongbao', 'Gửi thất bại, vui lòng thử lại sau');
            }
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
}