<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreSanphamNhomLoaiRel extends Model
{
    use SoftDeletes;

    protected $table = 'store_sanpham_nhom_loai_rel';

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }
}
