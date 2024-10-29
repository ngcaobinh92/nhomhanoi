<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SiteSlideModel extends Model
{
    //
    protected $table = 'site_slider';
    public $timestamps = false;

    public function getlist($id){
        $query = SiteSlideModel::query();
        $query->where('post_id', $id);
        $query->orderBy('order','desc');
        $result = $query->get();
        return $result;
    }
}
