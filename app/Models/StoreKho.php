<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreKho extends Model
{
    use SoftDeletes;

    protected $table = 'store_kho';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_kho];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreKho::NoneDelete()->pluck('ten_kho', 'id');
    }
}
