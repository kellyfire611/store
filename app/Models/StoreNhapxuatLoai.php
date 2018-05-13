<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreNhapxuatLoai extends Model
{
    use SoftDeletes;

    protected $table = 'store_nhapxuat_loai';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_loai_nhapxuat];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreNhapxuatLoai::NoneDelete()->pluck('ten_loai_nhapxuat', 'id');
    }
}
