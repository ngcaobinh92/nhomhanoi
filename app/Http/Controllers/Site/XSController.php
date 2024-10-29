<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\SmsModel;
use App\Models\LogModel;
use App\Models\KQXSModel;
use \Crypt;
use \Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use Illuminate\Http\Response;
use File;

class XSController extends Controller
{
    function __construct()
    {
      $this->dau_so_dich_vu = 9986;
      $this->key = '2Yk8AcPF6TcH6xvV';
      $this->secret_key = 'kqxs';

      //Lấy ra danh sách các tỉnh
      $danhsach = DB::table('kqxs')->select('companyid','company')->groupBy('companyid')->get();
      foreach ($danhsach as $value) {
        if ($value->companyid == 'MB') {
          $value->company = 'Truyền thống';
        }
      }
      view()->share(['danhsach' => $danhsach]);

    }

    public function getHome(Request $request)
    {
      $agent = new \Jenssegers\Agent\Agent;
      $ip = getUserIP();
      $token = hash_hmac('sha256', $ip, $this->secret_key);
      $ip = encryptIt($ip);

      if($agent->isMobile()){
        return view('site.content.kqxs.home-mobile', ['client' => $ip, 'token' => $token]);
      } else {
        return view('site.content.kqxs.home-mobile', ['client' => $ip, 'token' => $token]);
        // return view('site.content.home');
      }
    }

    public function getChitet(Request $request, $companyid = '')
    {
      $agent = new \Jenssegers\Agent\Agent;
      $ip = getUserIP();
      $token = hash_hmac('sha256', $ip, $this->secret_key);
      $ip = encryptIt($ip);

      $cal = array();
      for ($i=0; $i<7; $i++) {
        $cal[$i]['date'] = date("m/d/yy", strtotime($i." days ago"));
        $day = date("w", strtotime($i." days ago"));
        switch ($day) {
          case 1:
            $day = 'Thứ 2';
            break;
          case 2:
            $day = 'Thứ 3';
            break;
          case 3:
            $day = 'Thứ 4';
            break;
          case 4:
            $day = 'Thứ 5';
            break;
          case 5:
            $day = 'Thứ 6';
            break;
          case 6:
            $day = 'Thứ 7';
            break;
          default:
            $day = 'Chủ nhật';
            break;
        }
        $cal[$i]['days'] = $day;
      }

      $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      // $uriSegments = ;

      if (in_array('xo-so-mien-nam', $uriSegments)) {
        $url['module'] = 'NAM';
        $url['link'][] = 'Xổ số Miền Nam';
        $uriSegments = array_pop($uriSegments);
        if ($uriSegments != 'xo-so-mien-nam') {
          $info = KQXSModel::select('company')->where('companyid', 'like', strtoupper($uriSegments))->first();
          if ($info != '') {
            $url['link'][] = $info->company;
          }
        }
      } else if (in_array('xo-so-mien-trung', $uriSegments)) {
        $url['module'] = 'TRUNG';
        $url['link'][] = 'Xổ số Miền Trung';
        $uriSegments = array_pop($uriSegments);
        if ($uriSegments != 'xo-so-mien-trung') {
          $info = KQXSModel::select('company')->where('companyid', 'like', strtoupper($uriSegments))->first();
          if ($info != '') {
            $url['link'][] = $info->company;
          }
        }
      } else {
        $url['module'] = 'BAC';
        $url['link'][] = 'Xổ số Miền Bắc';
      }

      if($agent->isMobile()){
        return view('site.content.kqxs.chitiet.kqxs', ['client' => $ip, 'token' => $token, 'cal' => $cal, 'url' => $url, 'companyid' => $companyid]);
      } else {
        return view('site.content.kqxs.chitiet.kqxs', ['client' => $ip, 'token' => $token, 'cal' => $cal, 'url' => $url, 'companyid' => $companyid]);
      }
    }

    public function getvietlott(Request $request)
    {
      $agent = new \Jenssegers\Agent\Agent;
      $ip = getUserIP();
      $token = hash_hmac('sha256', $ip, $this->secret_key);
      $ip = encryptIt($ip);

      $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      $uriSegments = array_pop($uriSegments);

      $url['module'] = 'vietlott';
      $url['link'][] = 'VietLott';
      $url['type'] = '';

      switch ($uriSegments) {
        case '645':
          $url['link'][] = '6/45';
          $url['type'] = 'mega';
          break;
        case '655':
          $url['link'][] = '6/55';
          $url['type'] = 'power';
          break;
        case '4d':
          $url['link'][] = 'Max 4D';
          $url['type'] = 'MAX4D';
          break;
      }

      return view('site.content.kqxs.chitiet.vietlott', ['url' => $url, 'client' => $ip, 'token' => $token]);
    }

    public function getDauDuoi(Request $request)
    {
      $agent = new \Jenssegers\Agent\Agent;
      $ip = getUserIP();
      $token = hash_hmac('sha256', $ip, $this->secret_key);
      $ip = encryptIt($ip);

      $param = $request->all();

      $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      $uriSegments = array_pop($uriSegments);

      if (isset($request->companyid) && $request->companyid != '') {
        $param['companyid'] = strtoupper($request->companyid);
      } else {
        $param['companyid'] = 'MB';
      }

      if (isset($request->date) && $request->date != '') {
        $param['created_from'] = $request->date;
      } else {
        $param['created_from'] = Carbon::now()->subDays(10);
      }

      if (isset($request->DateRange) && $request->DateRange != '') {
        $DateRange = $request->DateRange;
        $param['created_to'] = Carbon::parse($request->date)->addDays($DateRange);
      } else {
        $DateRange = '10';
        $param['created_to'] = Carbon::now();
      }

      $KQXSModel = new KQXSModel;
      $data = $KQXSModel->getlist($param);
      $result_dau = array();
      $result_duoi = array();

      if ($data != '') {
        foreach ($data as $key => $value) {
          $dts = array();
          $dau = array();
          $duoi = array();

          if ($uriSegments == 'dau-duoi-db') {
            $dts[] = substr($value['a0'], -2);
          } else {
            $dts = explode('-', $value['lotos']);
          }

          for ($i=0; $i < 10; $i++) { 
            $dau[$i] = 0;
            $duoi[$i] = 0;
          }

          foreach ($dts as $dt) {
            $dau[$dt[0]]++;
            $duoi[$dt[1]]++;
          }

          $rs_0['created_at'] = Carbon::parse($value['created_at'])->format('Y-m-d');
          $rs_0['lotos'] = $dau;
          $rs_1['created_at'] = Carbon::parse($value['created_at'])->format('Y-m-d');
          $rs_1['lotos'] = $duoi;
          $result_dau[] = $rs_0;
          $result_duoi[] = $rs_1;
        }
      }

      $url['module'] = 'Thống kê';
      $url['link'][] = 'Thống kê';

      $data = array();
      if ($param['companyid'] == 'MB') {
        $company = 'Truyền thống';
      } else {
        $company = KQXSModel::where('companyid', $param['companyid'])->first()->company;
      }

      $data['companyid'] = $param['companyid'];
      $data['company'] = $company;
      $data['created_from'] = Carbon::parse($param['created_from'])->format('d/m/Y');
      $data['date_range'] = $DateRange;
      $data['dau_loto'] = array_reverse($result_dau);
      $data['duoi_loto'] = array_reverse($result_duoi);
      if ($uriSegments == 'dau-duoi-db') {
        $data['module'] = 'đặc biệt';
        $url['link'][] = 'Đầu đuôi đặc biệt';
      } else {
        $data['module'] = 'loto';
        $url['link'][] = 'Đầu đuôi lô tô';
      }
      return view('site.content.kqxs.dau-duoi', ['url' => $url, 'client' => $ip, 'token' => $token, 'data' => $data]);
    }

    public function getthongke0099(Request $request)
    {
      $agent = new \Jenssegers\Agent\Agent;
      $ip = getUserIP();
      $token = hash_hmac('sha256', $ip, $this->secret_key);
      $ip = encryptIt($ip);

      $param = $request->all();

      $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      $uriSegments = array_pop($uriSegments);

      if (isset($request->companyid) && $request->companyid != '') {
        $param['companyid'] = strtoupper($request->companyid);
      } else {
        $param['companyid'] = 'MB';
      }

      $param['created_from'] = Carbon::now()->subDays(30);
      $param['created_to'] = Carbon::now();

      $KQXSModel = new KQXSModel;
      $data = $KQXSModel->getlist($param);

      $total = array();
      for ($i=0; $i < 100; $i++) { 
        $total[$i] = 0;
      }

      if ($data != '') {
        foreach ($data as $key => $value) {
          $dts = array();
          $dau = array();

          if ($uriSegments == 'tk-09-db') {
            $dts[] = substr($value['a0'], -2);
          } else {
            $dts = explode('-', $value['lotos']);
          }

          for ($i=0; $i < 100; $i++) { 
            $dau[$i] = 0;
          }

          foreach ($dts as $dt) {
            $dau[intval($dt)]++;
            $total[intval($dt)]++;
          }

          $rs_0['created_at'] = Carbon::parse($value['created_at'])->format('Y-m-d');
          $rs_0['lotos'] = $dau;
          $result_dau[] = $rs_0;
        }
      }

      $url['module'] = 'Thống kê';
      $url['link'][] = 'Thống kê';
      $data = array();
      if ($param['companyid'] == 'MB') {
        $company = 'Truyền thống';
      } else {
        $company = KQXSModel::where('companyid', $param['companyid'])->first()->company;
      }

      $data['total'] = $total;
      $data['companyid'] = $param['companyid'];
      $data['company'] = $company;
      $data['dau_loto'] = array_reverse($result_dau);

      if ($uriSegments == 'tk-09-db') {
        $data['module'] = 'đặc biệt';
        $url['link'][] = '00-99 đặc biệt';
      } else {
        $data['module'] = 'loto';
        $url['link'][] = '00-99 lô tô';
      }
      return view('site.conten.kqxs.0099', ['url' => $url, 'client' => $ip, 'token' => $token, 'data' => $data]);
    }

    public function getthongketong(Request $request)
    {
      $agent = new \Jenssegers\Agent\Agent;
      $ip = getUserIP();
      $token = hash_hmac('sha256', $ip, $this->secret_key);
      $ip = encryptIt($ip);

      $param = $request->all();

      $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
      $uriSegments = array_pop($uriSegments);

      if (isset($request->companyid) && $request->companyid != '') {
        $param['companyid'] = strtoupper($request->companyid);
      } else {
        $param['companyid'] = 'MB';
      }

      if (isset($request->date) && $request->date != '') {
        $param['created_from'] = $request->date;
      } else {
        $param['created_from'] = Carbon::now()->subDays(10);
      }

      if (isset($request->DateRange) && $request->DateRange != '') {
        $DateRange = $request->DateRange;
        $param['created_to'] = Carbon::parse($request->date)->addDays($DateRange);
      } else {
        $DateRange = '10';
        $param['created_to'] = Carbon::now();
      }

      $KQXSModel = new KQXSModel;
      $data = $KQXSModel->getlist($param);
      $result_dau = array();

      if ($data != '') {
        foreach ($data as $key => $value) {
          $dts = array();
          $dau = array();

          $dts = explode('-', $value['lotos']);

          for ($i=0; $i < 10; $i++) { 
            $dau[$i] = 0;
          }

          if (count($dts) > 1) {
            foreach ($dts as $dt) {
              $tong = $dt[0] + $dt[1];
              $tong = substr($tong, '-1');
              $dau[intval($tong)]++;
            }
          }

          $rs_0['created_at'] = Carbon::parse($value['created_at'])->format('Y-m-d');
          $rs_0['lotos'] = $dau;
          $result_dau[] = $rs_0;
        }
      }

      $url['module'] = 'Thống kê';
      $url['link'][] = 'Thống kê';

      $data = array();
      if ($param['companyid'] == 'MB') {
        $company = 'Truyền thống';
      } else {
        $company = KQXSModel::where('companyid', $param['companyid'])->first()->company;
      }

      $data['companyid'] = $param['companyid'];
      $data['company'] = $company;
      $data['created_from'] = Carbon::parse($param['created_from'])->format('d/m/Y');
      $data['date_range'] = $DateRange;
      $data['dau_loto'] = array_reverse($result_dau);
      $data['module'] = 'loto';
      $url['link'][] = 'Đầu đuôi lô tô';

      return view('site.content.kqxs.tong', ['url' => $url, 'client' => $ip, 'token' => $token, 'data' => $data]);
    }

    public function getTeleShow(Request $request)
    {
        $start = Carbon::createFromTimeString('18:05');
        $end = Carbon::createFromTimeString('18:31');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $ch_source = 'smil:vtc9.smil';
        $secret = '2fbc5edb4096a81f';
        $wowzastart = strtotime(date('d-m-Y H:i'));
        $wowzaend = strtotime(date('d-m-Y 18:31'));
        $wowzatoken = '_';
        if ($now->between($start, $end)) {
          $hashstr = hash('sha256', 'live/_definst_/'.$ch_source.'?'.$secret.'&'.$wowzatoken.'endtime='.$wowzaend.'&'.$wowzatoken.'starttime='.$wowzastart.'', true);
          $usableHash= strtr(base64_encode($hashstr), '+/', '-_');
          $linktv = "http://210.245.81.87:1935/live/_definst_/".$ch_source."/playlist.m3u8?".$wowzatoken."endtime=".$wowzaend."&".$wowzatoken."starttime=".$wowzastart."&".$wowzatoken."hash=".$usableHash;
        } else {
          $linktv = "";
        }
        return view('site.content.kqxs.tvshow-mobile', ['urlstream' => $linktv]);
    }

}