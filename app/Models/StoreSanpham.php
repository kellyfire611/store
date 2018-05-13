<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreSanpham extends Model
{
    use SoftDeletes;

    protected $table = 'store_sanpham';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_sanpham];

        })->flatten();
    }

    public static function selectboxData()
    {
        $data = StoreSanpham::NoneDelete()->pluck('ten_sanpham', 'id');
        //dd($data);
        return $data;
    }
}
