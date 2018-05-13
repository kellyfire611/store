<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HrmQuocgia extends Model
{
    use SoftDeletes;

    protected $table = 'hrm_quocgia';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->ten_quocgia];

        })->flatten();
    }

    public static function selectboxData()
    {
        return HrmQuocgia::NoneDelete()->pluck('ten_quoc_gia', 'id');
    }
}
