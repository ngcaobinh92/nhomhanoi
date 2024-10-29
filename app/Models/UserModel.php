<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable
{
    use Notifiable;
    public $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'password',"avatar","zalo_id",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roledata()
    {
        return $this->belongsTo('App\Models\UserRoleModel', 'roles', 'id');
    }

    public function getlist($param){
        $query = UserModel::query();

        if (isset($param['name'])){
            $name = $param['name'];
            $query->where('name', 'like', "%$name%");
        }

        if (isset($param['email'])){
            $email = $param['email'];
            $query->where('email', 'like', "%$email%");
        }

        if (isset($param['gender'])){
            $gender = $param['gender'];
            $query->where('gender', 'like', "%$gender%");
        }

        if (isset($param['order_by']) && $param['order_by'] != '')
        {
            $query->orderBy($param['order_by'],'desc');
        } else {
            $query->orderBy('id','desc');
        }

        if (isset($param['offset']) && $param['offset'] != '')
            $query->offset($param['offset']);

        $result = $query->paginate(10);
        return $result;
    }
}
