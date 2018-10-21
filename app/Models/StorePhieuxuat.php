<?php

namespace App\Models;

use App\Models\StorePhieuxuatChitiet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorePhieuxuat extends Model
{
    use SoftDeletes;

    protected $table = 'store_phieuxuat';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public function scopePhieuXuat($nhapxuat_id)
    {
        return $this->where('nhapxuat_id', $nhapxuat_id)->orderBy('ngay_xuatkho', 'desc');;
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->so_phieuxuat];

        })->flatten();
    }

    public function chitiet()
    {
        return $this->hasMany(StorePhieuxuatChitiet::class, 'phieuxuat_id', 'id');
    }

    public function tongthanhtien()
    {
        $query = $this->chitiet()
            ->selectRaw('sum(soluongxuat * dongiaxuat) as aggregate')
            ->groupBy('phieuxuat_id');
        return $query;
        // return $query->first()->aggregate;
    }

    // Post model
    // public function commentsCount()
    // {
    //     return $this->hasOne('Comment')
    //         ->selectRaw('post_id, count(*) as aggregate')
    //         ->groupBy('post_id');
    // }
    
    // public function getCommentsCountAttribute()
    // {
    //     // if relation is not loaded already, let's do it first
    //     if ( ! array_key_exists('commentsCount', $this->relations)) 
    //         $this->load('commentsCount');
        
    //     $related = $this->getRelation('commentsCount');
        
    //     // then return the count directly
    //     return ($related) ? (int) $related->aggregate : 0;
    // }
}
