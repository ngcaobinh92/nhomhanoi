<?php
namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use \Crypt;
use \Log;
use \DB;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use App\Models\UserRoleModel;
use App\Models\CMSMenuModel;
use App\Models\SiteSlideModel;
  

class HomeController extends Controller

{
    /**

     * Create a new controller instance.

     *

     * @return void

     */

    function __construct()
    {
        
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

    public function getHome(Request $request)
    {
        $params = $request->all();
        return view('cms.content.home');
    }

    public function getMessenger(Request $request)
    {
        $params = $request->all();
        return redirect('cms')->with('thongbao', trans('cms.khong_cho_phep'));
    }

    public function getSetting(Request $request)
    {
        if (Auth::check() == true){
            $user = Auth::user();
            if ($user->role == 0) {
                view()->share(['module' => 'setting']);
                $this->module = 'setting';
                $cms_cat = DB::table('cms_site_menu')->where('menu_id', '0')->orderBy('order','ASC')->get();
                foreach ($cms_cat as $key => $cat) {
                    $cat->require = explode(',', $cat->require);
                    $cat->child = DB::table('cms_site_menu')->where('menu_id', $cat->id)->orderBy('order','ASC')->get();
                    if (count($cat->child) > 0) {
                        foreach ($cat->child as $value) {
                            $value->require = explode(',', $value->require);
                        }
                    }
                }
                $cms_role = DB::table('roles')->where('id', '>', '0')->where('status', '1')->get();
                $cms_slide = SiteSlideModel::where('post_id', '0')->orderBy('order', 'DESC')->get();
                $cms_siteInfo = DB::table('site_configs')->first();
                return view('cms.content.setting.index', ['cms_cat' => $cms_cat, 'cms_role' => $cms_role, 'cms_siteInfo' => $cms_siteInfo, 'cms_slide' => $cms_slide]);
            } else {
                return redirect('cms/message/show')->with('thongbao', trans('cms.khong_cho_phep'));
            }
        } else {
            return redirect('cms/login');
        }
    }


    public function postSetting(Request $request)
    {
        $params = $request->all();
        $message = '';
        if (isset($params['form_type']) && $params['form_type'] == 'config_site') {
            $update = DB::table('site_configs')
              ->where('id', 1)
              ->update([
                'google_plus' => @$params['google_plus'],
                'facebook' => @$params['facebook'],
                'hotline' => @$params['hotline'],
                'email' => @$params['email'],
                'twitter' => @$params['twitter'],
                'pinterest' => @$params['pinterest'],
                'zalo' => @$params['zalo'],
                'address' => @$params['address'],
                'showroom' => @$params['showroom'],
                'factory' => @$params['factory'],
                'google_map' => @$params['google_map']
            ]);
            if ($update) {
                $message = 'Cập nhật thành công';
            }
        } elseif (isset($params['form_type']) && $params['form_type'] == 'config_roles') {
            //Reset Config
            DB::table('cms_site_menu')->update(['require' => '0']);
            foreach ($params as $key => $value) {
                if (is_numeric($key) == true) {
                    $data = '0,'.implode(',', $value);
                    DB::table('cms_site_menu')->where('id', $key)->update(['require' => $data]);
                }
            }
            $message = 'Cập nhật thành công';
        } elseif (isset($params['form_type']) && $params['form_type'] == 'config_slide') {
            SiteSlideModel::where('post_id', '0')->delete();
            if (count($params['slider']) > 0) {
                foreach ($params['slider'] as $value) {
                    if ($value != '') {
                        $data = array(
                          'image' => $value,
                        );
                        SiteSlideModel::insert($data);
                    }
                }
            }
            $message = 'Cập nhật thành công';
        } else {

        }
        return redirect('cms/setting')->with('thongbao', $message);
    }

    public function checksms()
    {
        view()->share(['path' => 'misssms']);
        $this->path = 'misssms';
        $this->module = 'check';
        $this->authorizeRoles();
        $data = DB::table('temp_isdn_active')->get();
        return view('cms.content.sms.list', ['data' => $data]);
    }

    public function getguisms()
    {
        view()->share(['path' => 'sendsms']);
        $this->path = 'sendsms';
        $this->module = 'check';
        $this->authorizeRoles();
        return view('cms.content.sms.add');
    }

    public function postguisms(Request $request)
    {
        $this->validate($request, 
            [
                'USER_ID' => 'required',
                'SERVICE_ID' => 'required',
                'MOBILE_OPERATOR' => 'required',
                'COMMAND_CODE' => 'required',
                'CONTENT_TYPE' => 'required',
                'INFO' => 'required',
                'MESSAGE_TYPE' => 'required',
            ]);

        $data = array();
        $data['USER_ID'] = $request->USER_ID;
        $data['SERVICE_ID'] = $request->SERVICE_ID;
        $data['MOBILE_OPERATOR'] = $request->MOBILE_OPERATOR;
        $data['COMMAND_CODE'] = $request->COMMAND_CODE;
        $data['CONTENT_TYPE'] = $request->CONTENT_TYPE;
        $data['INFO'] = $request->INFO;
        $data['MESSAGE_TYPE'] = $request->MESSAGE_TYPE;
        $data['SUBMIT_DATE'] = Carbon::now();
        $data['DONE_DATE'] = Carbon::now();
        $id = DB::connection('mysql2')->table('mt_send_queue')->insertGetId($data);
        if ($id > 0) {
            return redirect('cms/check/sendsms')->with('thongbao', 'thêm mới thành công')->send();
        } else {
            return back()->with('thongbao', 'Thêm thất bại, vui lòng thử lại sau')->send();
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

    public function getreadmess()
    {
        DB::table('cms_notification')->update(['status' => '0']);
        return redirect('cms/notified/list')->send();
    }

}