<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreNhacungcap extends Model
{
    use SoftDeletes;

    protected $table = 'store_nhacungcap';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_nhacungcap];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreNhacungcap::NoneDelete()->pluck('ten_nhacungcap', 'id');
    }
}
