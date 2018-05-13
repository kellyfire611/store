<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreSanphamNhom extends Model
{
    use SoftDeletes;

    protected $table = 'store_sanpham_nhom';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_nhom_sanpham];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreSanphamNhom::NoneDelete()->pluck('ten_nhom_sanpham', 'id');
    }
}
