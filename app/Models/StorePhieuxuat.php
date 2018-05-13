<?php

namespace App\Models;

use App\Models\StorePhieuxuatChitiet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorePhieuxuat extends Model
{
    use SoftDeletes;

    protected $table = 'store_phieuxuat';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }

    public function scopePhieuXuat($nhapxuat_id)
    {
        return $this->where('nhapxuat_id', $nhapxuat_id);
    }

    public static function options($id)
    {
        return static::where('id', $id)->get()->map(function ($obj) {

            return [$obj->id => $obj->so_phieuxuat];

        })->flatten();
    }

    public function chitiet()
    {
        return $this->hasMany(StorePhieuxuatChitiet::class, 'phieuxuat_id', 'id');
    }
}
