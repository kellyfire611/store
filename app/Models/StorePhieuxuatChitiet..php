<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorePhieuxuatChitiet extends Model
{
    use SoftDeletes;

    protected $table = 'store_phieuxuat_chitiet';
    protected $fillable = ['id','ngay_sudungdautien','dongiaxuat','soluongxuat','thue','hansudung','so_lo','so_chungtu', 'cotinhphi', 'nhapxuat_id','phieuxuat_id','soketoan_id','xuat_tu_kho_id','sanpham_id','donvitinh_id', 'phieunhap_chitiet_id', 'deleted_at','created_at','updated_at'];

    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }
}
