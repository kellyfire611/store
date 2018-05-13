<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreKhoLoai extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'store_kho_loai';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_loai_kho];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreKhoLoai::NoneDelete()->pluck('ten_loai_kho', 'id');
    }
}
