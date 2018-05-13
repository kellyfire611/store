<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreNguoncungcap extends Model
{
    use SoftDeletes;

    protected $table = 'store_nguoncungcap';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_nguoncungcap];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreNguoncungcap::NoneDelete()->pluck('ten_nguoncungcap', 'id');
    }
}
