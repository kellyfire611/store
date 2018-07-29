<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreDonvi extends Model
{
    use SoftDeletes;

    protected $table = 'store_donvi';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_donvi];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreDonvi::NoneDelete()->pluck('ten_donvi', 'id');
    }
}
