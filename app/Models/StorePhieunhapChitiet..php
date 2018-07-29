<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StorePhieunhapChitiet extends Model
{
    use SoftDeletes;

    protected $table = 'store_phieunhap_chitiet';
    protected $fillable = ['id','ngay_sudungdautien','dongianhap','soluongnhap','soluong_conlai','soluong_theohopdong','thue','hansudung','so_lo','so_chungtu','nhapxuat_id','phieunhap_id','soketoan_id','nhap_vao_kho_id','sanpham_id','donvitinh_id','nguoncungcap_id','deleted_at','created_at','updated_at','nongdohamluong', 'ngay_chungtu', 'nuocsanxuat_id'];
    
    public function scopeNoneDelete()
    {
        return $this->where('deleted_at', null);
    }
}
