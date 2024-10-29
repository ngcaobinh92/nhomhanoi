<?php
namespace App\Http\Controllers\Api;

use App\Models\UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;
use JWTAuthException;
use Hash;
use Carbon\Carbon;
use DB;
use Session;

class UserController extends Controller
{   
    private $user;
   
    public function register(Request $request){
        $params = $request->only('user_name','user_phone','user_password');
    	$user = new UserModel();
        $data = $user::query()->where('user_phone', 'like', $params['user_phone']);
        if ($data->exists() == true) {
            $data = $data->get()->first();
            return $this->login($params);
        } else {
            $UserNull = 'User_'.Carbon::now()->timestamp;
            $user->user_name = $params['user_name'] ? $params['user_name'] : $UserNull;
            $user->user_phone = $params['user_phone'];
            $user->user_password = Hash::make($params['user_password']);
            $user->user_birthday = Carbon::now();
            $user->role = 0;
            $user->save();
            $token = JWTAuth::fromUser($user);
            return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Login success',
                'data' => [
                    'token' => $token,
                    'user' => $user,
                ],
            ],Response::HTTP_OK);
        }
    }
    
    protected function login($request){
        $credentials = array(
            'user_phone' => $request['user_phone'], 
            'password' => $request['user_password']
        );
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'invalid user_phone or user_password'
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
           }
        } catch (JWTAuthException $e) {
            return response()->json([
                'status' => false,
                'code' => 500,
                'message' => 'failed to create token'
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $token = compact('token');
        $user = JWTAuth::toUser($token['token']);
        return response()->json([
                'status' => true,
                'code' => 200,
                'message' => 'Login success',
                'data' => [
                    'token' => $token['token'],
                    'user' => $user,
                ],
            ],Response::HTTP_OK);
    }

    public function getUserInfo(Request $request){
	    $user = JWTAuth::toUser($request->header('Authorization'));
        return response()->json(['result' => $user]);
    }

    public function postUpdatePassword(Request $request){
        if (UserModel::where('user_phone', $request->user_phone)->exists() === true) {
            $update = DB::table('user')->where('user_phone', $request->user_phone)->update(['user_password' => Hash::make($request->user_password)]);
            if ($update) {
                return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => 'update success'
                    ],Response::HTTP_OK);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'message' => 'internal server error'
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'invalid user_phone'
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function getUpdatePassword(Request $request){
        if (UserModel::where('user_phone', $request->user_phone)->exists() === true) {
            $update = DB::table('user')->where('user_phone', $request->user_phone)->update(['user_password' => Hash::make($request->user_password)]);
            if ($update) {
                return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => 'update success'
                    ],Response::HTTP_OK);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'message' => 'internal server error'
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'invalid user_phone'
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function getcheckUserExist(Request $request){
        if (isset($request->user_phone)) {
            if (UserModel::where('user_phone', $request->user_phone)->exists() === true) {
                $user = UserModel::where('user_phone', $request->user_phone)->get()->first();
                return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => true,
                        'data' => $user,
                    ],Response::HTTP_OK);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 422,
                    'message' => false,
                    'data' => '',
                ],Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => false,
                'data' => '',
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function postCreatePhone(Request $request){
        if (isset($request->user_phone)) {
            if (UserModel::where('user_phone', $request->user_phone)->exists() === false) {
                $id = (UserModel::select('user_id')->orderBy('user_id', 'DESC')->get()->first()->user_id) + 1;
                $now = Carbon::now();
                $user = new UserModel;
                $user->user_name = 'User_'.$id;
                $user->user_email = '';
                $user->user_phone = $request->user_phone;
                $user->user_avatar = '';
                $user->user_gender = 'male';
                $user->user_status = 'active';
                $user->user_created_date = $now;
                $user->user_birthday = $now;
                $user->lang = 'kr';
                $user->save();
                $insertedId = $user->user_id;
                if ($insertedId > 0) {
                    return response()->json([
                        'status' => true,
                        'code' => 200,
                        'message' => true,
                        'data' => $user,
                    ],Response::HTTP_OK);
                } else {
                    return response()->json([
                        'status' => false,
                        'code' => 422,
                        'message' => false,
                        'data' => '',
                    ],Response::HTTP_UNPROCESSABLE_ENTITY);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 422,
                    'message' => false,
                    'data' => '',
                ],Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        } else {

            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => false,
                'data' => '',
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function getAlertTele(Request $request){
        if (isset($request->msg)) {

            $data = DB::table('cdk')->insert(
                ['msg' => $request->msg, 'created_at' => date('Y-m-d H:i:s')]
            );

            if ($data) {
                return response()->json([
                    'status' => true,
                    'code' => 200,
                    'message' => 'OK',
                ],Response::HTTP_OK);
            } else {
                return response()->json([
                    'status' => false,
                    'code' => 500,
                    'message' => 'INTERNAL SERVER ERROR',
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            return response()->json([
                'status' => false,
                'code' => 422,
                'message' => 'UNPROCESSABLE ENTITY',
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function getGuest(Request $request){
        $get_first = function($x){
            return $x[0];
        };
        // Same as getallheaders(), just with lowercase keys
        $user = array_map($get_first, $request->headers->all());
        $user['session_id'] = session()->getId();
        \Session::put('users', $user);

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => true,
            'data' => $user,
        ],Response::HTTP_OK);

      // echo $request->header('User-Agent');
    }
}  
