<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreDonvitinh extends Model
{
    use SoftDeletes;

    protected $table = 'store_donvitinh';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_donvitinh];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreDonvitinh::NoneDelete()->pluck('ten_donvitinh', 'id');
    }
}
