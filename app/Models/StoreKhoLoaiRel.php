<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StoreKho;
use App\Models\StoreKhoLoai;

class StoreKhoLoaiRel extends Model
{
    use SoftDeletes;

    protected $table = 'store_kho_loai_rel';

    public function kho()
    {
        return $this->belongsTo(StoreKho::class, 'kho_id', 'id');
    }

    public function kho_loai()
    {
        return $this->belongsTo(StoreKhoLoai::class, 'kho_loai_id', 'id');
    }
}
