<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoleModel extends Model
{
    public $table = "roles";
    public $timestamps = false;

    public function roledata()
    {
        return $this->hasMany('App\Models\UserRoleModel', 'roles', 'id');
    }

}
