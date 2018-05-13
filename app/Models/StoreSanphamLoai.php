<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreSanphamLoai extends Model
{
    use SoftDeletes;

    protected $table = 'store_sanpham_loai';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_loai_sanpham];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreSanphamLoai::NoneDelete()->pluck('ten_loai_sanpham', 'id');
    }
}
