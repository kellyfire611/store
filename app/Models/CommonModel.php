<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Auth\Database\Administrator;

class CommonModel
{
    /**
     * Render style
     */
    const RENDER_STYLE_ONLY_CONTROL = 1;
    const RENDER_STYLE_ONLY_LABEL = 2;
    const RENDER_STYLE_LABEL_AND_CONTROL = 3;

    /**
     * Position Label
     */
    const LABEL_POSITION_TOP = 1;
    const LABEL_POSITION_RIGHT = 2;
    const LABEL_POSITION_BOTTOM = 3;
    const LABEL_POSITION_LEFT = 4;

    static $states;
    static $yesNo;
    static $instance = null;
    static $nhap_xuat = null;

    public function __construct()
    {
        self::$states = [
            'on'  => ['value' => 1, 'text' => __('models.common.enable'), 'color' => 'success'],
            'off' => ['value' => 0, 'text' => __('models.common.disable'), 'color' => 'danger'],
        ];

        self::$yesNo = [
            'yes'  => ['value' => 1, 'text' => __('models.common.yes'), 'color' => 'success'],
            'no' => ['value' => 0, 'text' => __('models.common.no'), 'color' => 'danger'],
        ];

        self::$nhap_xuat = [
            '_NHAP_TRA_KHO_CHAN_' => 2,
            '_NHAP_TU_NHACUNGCAP_' => 13,
            '_NHAP_TU_NGUONCUNGCAP_' => 14,
            '_NHAP_KHAC_TU_BENNGOAI_' => 16,
            '_NHAP_KHAC_NOIBO_' => 17,
            '_NHAP_VAO_KHO_LE_' => 29,
            '_NHAP_TONKHO_' => 30,
            '_NHAP_BOSUNG_TUTRUC_' => 33,
            '_NHAP_HOANTRA_TU_KHOAPHONG_' => 35,
            '_NHAP_VAO_KHOAPHONG_' => 36,
            '_NHAP_TU_KEDONTHUOC_CHO_BENHNHAN_' => 38,
            '_NHAP_HOAN_TUTRUC_' => 39,
            '_NHAP_GIAM_COSO_TUTRUC' => 42,
            '_NHAP_TON_KHO_DAU_KY_' => 45,
            '_NHAP_NGOAIVIEN_' => 46,
            '_NHAP_HOANTRA_TU_BENHNHAN_' => 50,
            '_NHAP_THUOC_LAMTRON_' => 53,
            '_NHAP_KHOLE_GIABAN_COLOI_' => 55,
            '_NHAP_DOTHIENMAU_' => 56,

            '_XUAT_TRA_NHACUNGCAP_' => 5,
            '_XUAT_PHATTHUOC_CHO_BENHNHAN_' => 7,
            '_XUAT_HOAN_TUTRUC_' => 8,
            '_XUAT_QUA_KHO_LE_' => 9,
            '_XUAT_NOIBO_GIUA_CACKHO_' => 22,
            '_XUAT_VIENTRO_' => 26,
            '_XUAT_HUBE_HONGMAT_THANHLY_' => 27,
            '_XUAT_NGOAIVIEN_' => 28,
            '_XUAT_TRA_KHO_CHAN_' => 31,
            '_XUAT_BOSUNG_TUTRUC_' => 32,
            '_XUAT_CHO_KHOAPHONG_' => 34,
            '_XUAT_KEDONTHUOC_CHO_BENHNHAN_' => 37,
            '_XUAT_CHO_BENHNHAN_' => 40,
            '_XUAT_GIAM_COSO_TUTRUC_' => 41,
            '_XUAT_THUOC_THEO_BANGKE_' => 48,
            '_XUAT_KEDONTHUOC_CHO_BENHNHAN_THUPHI_' => 51,
            '_XUAT_THUOC_LAMTRON_' => 52,
            '_XUAT_KHOLE_GIABAN_COLOI_' => 54,
            '_XUAT_KHO_MAU_' => 57,
        ];
    }

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance =  new self();
        }

        return self::$instance;
    }
    
    public static function getStates()
    {
        self::getInstance();
        return self::$states;
    }

    public static function getYesNo()
    {
        self::getInstance();
        return self::$yesNo;
    }

    public static function getNhapXuat()
    {
        self::getInstance();
        return self::$nhap_xuat;
    }

    public static function administratorSelectboxData()
    {
        return Administrator::all()->pluck('username', 'id');
    }
}
