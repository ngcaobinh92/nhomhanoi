<?php
namespace App\Http\Controllers\Tool;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\CronMailModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\Post;
use Session;
use \Crypt;
use Input;
use Excel;
use \Log;
use Mail;
use File;
use Auth;
use DB;

use App\Models\UserModel;
use App\Models\KeygenModel;

class HomeController extends Controller
{
    public function getList(Request $request)
    {
        $params = $request->all();
        $KeygenModel = new KeygenModel();
        $list = $KeygenModel->getlist($params);
        return view('tool/content/check/add', ['list' => $list]);
    }

    public function postList(Request $request)
    {
        $this->validate($request, 
            [
                'campaign' => 'required',
                'amount' => 'required',
            ],
            [
                'campaign.required' => 'Chương trình giảm giá không được để trống',
                'amount.required' => 'Số lượng không được để trống',
            ]);

        $total = $request->amount;
        $i = 0;

        // Công thức
        // a = RAND (0-7)
        // 0       1       2       3       4   5       6       7
        // RAND    S+a     RAND    RAND    a   M+a     RAND    J+a

        while($i <= $total) {
            $a = RAND(0,7);
            $key = '';
            for ($j=0; $j < 8; $j++) { 
                switch ($j) {
                    case 1:
                        $key .= num2alpha(18+$a);
                        break;
                    case 4:
                        $key .= $a;
                        break;
                    case 5:
                        $key .= num2alpha(12+$a);
                        break;
                    case 7:
                        $key .= num2alpha(9+$a);
                        break;
                    default:
                        $key .= randomString(1);
                        break;
                }
            }

            if (KeygenModel::where('key', $key)->exists() == false) {
                $add = new KeygenModel;
                $add->campaign = $request->campaign;
                $add->key = strtoupper($key);
                $add->created_at = Carbon::now();
                $add->timestamps = false;
                $InsertedId = $add->save();
                if ($InsertedId > 0) {
                    $i++;
                }
            }
        }

        return redirect('tool/list')->with('thongbao_taoma', 'Tạo mới thành công');
    }

    public function getMessage()
    {
        return view('tool/content/message');
    }

    public function getcheck()
    {
        return view('tool/content/check/list');
    }

    public function postcheck(Request $request)
    {
        $params = $request->all();
        if (strlen($params['key']) == 8)  {
            $data = KeygenModel::where('key', $params['key'])->first();
            if ($data != '') {
                $data['error'] = 0;
                if ($params['type'] == 'charge') {
                    KeygenModel::where('key', $params['key'])->update(['status' => 1]);
                } 

                if ($params['type'] == 'giveaway') {
                    KeygenModel::where('key', $params['key'])->update(['status' => 2]);
                }
                return $data;
            } else {
                $data = array();
                $data['error'] = 1;
                $data['content'] = 'Không tồn tại mã ưu đãi này trên hệ thống';
                return $data;
            }
        }
    }

}