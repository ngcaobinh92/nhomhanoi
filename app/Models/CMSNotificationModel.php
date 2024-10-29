<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CMSNotificationModel extends Model
{
    //
    protected $table = 'cms_notification';

    public function getlist($param){
        $query = CMSNotificationModel::query();

        if (isset($param['id'])){
            $query->where('id', $param['id']);
            $query->Orwhere('parent', $param['id']);
        }

        if (isset($param['user_id'])){
            $query->where('user_id', $param['user_id']);
        }

        if (isset($param['status'])){
            $query->where('status', $param['status']);
        }

        if (isset($param['except']) && $param['except'] > 0){
            $query->where('user_id', '>', '0');
        }

        if (isset($param['order_by']) && $param['order_by'] != '')
        {
            $query->orderBy($param['order_by'],'desc');
        } else {
            $query->orderBy('id','desc');
        }

        if (isset($param['limit']) && $param['limit'] > 1) {
            $result = $query->paginate($param['limit']);
        } elseif (isset($param['limit']) && $param['limit'] == 1) {
            $result = $query->first();
        } else {
            $result = $query->get();
        }

        return $result;
    }
}
