<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreSoketoan extends Model
{
    use SoftDeletes;

    protected $table = 'store_soketoan';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ma_soketoan];

        })->flatten();
    }

    public static function selectboxData()
    {
        return StoreSoketoan::NoneDelete()->pluck('ma_soketoan', 'id');
    }
}
