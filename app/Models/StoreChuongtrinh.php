<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreChuongtrinh extends Model
{
    use SoftDeletes;

    protected $table = 'store_chuongtrinh';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_chuongtrinh];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreChuongtrinh::NoneDelete()->pluck('ten_chuongtrinh', 'id');
    }
}
