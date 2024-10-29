<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class SitePostModel extends Model
{
    //
    protected $table = 'site_post';

    public function getlist($params){

    	$query = SitePostModel::query();

		if (isset($params['type']) && $params['type'] != ''){
		    $query->where('type', $params['type']);
		}

		if (isset($params['title']) && $params['title'] != ''){
		    $query->where('title', 'like', '%'.$params['title'].'%');
		}

		if (isset($params['type_date']) && $params['type_date'] != ''){
			if (isset($params['start']) && $params['start'] != ''){
				$query->whereDate($params['type_date'], '>=', Carbon::parse($params['start']));
			}
			if (isset($params['end']) && $params['end'] != ''){
				$query->whereDate($params['type_date'], '<=', Carbon::parse($params['end']));
			}
		}

	    $query->orderBy('id','DESC');

		if (isset($params['orderBy']) && $params['orderBy'] != ''){
		    if (isset($params['order']) && $params['order'] != ''){
				$query->orderBy($params['orderBy'], $params['order']);
			} else {
				$query->orderBy($params['orderBy'], 'DESC');
			}
		}

		$result = $query->get();

		return $result;
    }

    public function getProduct($params){

    	$query = SitePostModel::query();

        $query->leftJoin('site_product', 'site_post.id', '=', 'site_product.post_id');
        $query->select('site_post.*','site_product.quantity','site_product.sale','site_product.origin_price');

        if (isset($params['id']) && $params['id'] > 0) {

		    $query->where('site_post.id', $params['id']);
			$result = $query->first();

        } else {
			if (isset($params['type']) && $params['type'] != ''){
			    $query->where('type', $params['type']);
			}

			if (isset($params['title']) && $params['title'] != ''){
			    $query->where('title', 'like', '%'.$params['title'].'%');
			}

			if (isset($params['type_date']) && $params['type_date'] != ''){

			    if ($params['type_date'] == 'origin_price') {
			      $check1 = $params['start'];
			      $check2 = $params['end'];
			    } else {
			      $check1 = strtotime($params['start']);
			      $check2 = strtotime($params['end']);
			    }

			    if ($check1 > $check2) {
			      $flags = '';
			      $flags = $params['start'];
			      $params['start'] = $params['end'];
			      $params['end'] = $flags;
			    }

				if ($params['type_date'] == 'origin_price') {
					if (isset($params['start']) && $params['start'] != ''){
						$query->where($params['type_date'], '>=', $params['start']);
					}
					if (isset($params['end']) && $params['end'] != ''){
						$query->where($params['type_date'], '<=', $params['end']);
					}
				} else {
					if (isset($params['start']) && $params['start'] != ''){
						$query->whereDate($params['type_date'], '>=', Carbon::parse($params['start']));
					}
					if (isset($params['end']) && $params['end'] != ''){
						$query->whereDate($params['type_date'], '<=', Carbon::parse($params['end']));
					}
				}
			}

		    $query->orderBy('id','DESC');

			if (isset($params['orderBy']) && $params['orderBy'] != ''){
			    if (isset($params['order']) && $params['order'] != ''){
					$query->orderBy($params['orderBy'], $params['order']);
				} else {
					$query->orderBy($params['orderBy'], 'DESC');
				}
			}

			$result = $query->get();
        }

		return $result;
    }
}
