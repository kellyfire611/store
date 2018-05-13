@extends('print.layout.paper')

@section('title')
Biểu mẫu Phiếu nhập kho
@endsection

@section('paper-size') A4 @endsection
@section('paper-class') A4 @endsection

@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/bieumau.css') }}">
@endsection

@section('paper-toolbar-top')
<form method="post" action="{{ route('store.export.excel.phieuNhap') }}">
  {{ csrf_field() }}
  <input type="hidden" name="phieunhap_id" value="1" />
  <button class="btn btn-sm btn-primary grid-refresh" type="submit"><i class="fa fa-refresh"></i> Xuất Excel</button>
</form>
@endsection

@section('content')
@if(empty($bag['data']->result))
<section class="sheet padding-10mm">
    <article>
        <h1>Không tìm thấy dữ liệu</h1>
        <a href="{{ admin_base_path('/') }}"><b>Quay về Trang chủ</b></a>
    </article>
</section>
@else
<section class="sheet padding-10mm">
    <article>
        <table class="tg">
            <tr>
                <th class="tg-baqh">{{ config('company.parent.name') }}</th>
                <th class="tg-baqh"></th>
                <th class="tg-baqh">Mẫu số: C20-HD </th>
            </tr>
            <tr>
                <td class="tg-baqh align-center valign-top">{{ config('company.name') }}</td>
                <td class="bold name">{{ $bag['meta']['title'] }}</td>
                <td class="tg-s6z2 align-center">Ban hành theo quy định số:
                    <br>19/2006/QĐ-BTC
                    <br>ngày 30/03/2006
                    <br>của Bộ Tài Chính</td>
            </tr>
            <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e align-center"><?php
                $ngayNhap = \Carbon\Carbon::parse($bag['data']->result[0]->ngay_nhapkho);

                ?>  Ngày {{ $ngayNhap->day }} tháng {{ $ngayNhap->month }} năm {{ $ngayNhap->year }}</td>
                <td class="tg-031e"></td>
            </tr>
            <tr>
                <?php ?>
                <td class="tg-031e align-left" colspan="3">Số : {{ $bag['data']->result[0]->so_phieunhap }}  </td>

            </tr>
            <tr>
                <td class="tg-031e align-left" colspan="3">Đơn vị giao :</td>
            </tr>
            <tr>
                <td class="tg-031e align-left" colspan="3">Lý do nhập : {{ $bag['data']->result[0]->lydo_nhap }}</td>
            </tr>
            <tr>
                <td class="tg-031e align-left" colspan="3">Nhập tại kho :</td>
            </tr>
            <tr>
                <td class="tg-031e align-left" >Nguồn :</td>
                <td class="tg-031e align-left" >Số chứng từ : {{ $bag['data']->result[0]->so_chungtu }}</td>
                <td class="tg-031e align-left" >Ngày :</td>
            </tr>
        </table>
        <table class="main">
            <tr>
                <th class="main-s6z2" >STT</th>
                <th class="main-s6z2" >Tên quy cách vật tư dụng cụ, sản phẩm</th>
                <th class="main-s6z2" >Số lô</th>
                <th class="main-s6z2" >Hạn SD</th>
                <th class="main-s6z2" >Loại TS</th>
                <th class="main-s6z2" >ĐVT</th>

                <th class="main-s6z2" >Số lượng</th>
                <th class="main-s6z2" >Đơn giá</th>

                <th class="main-s6z2" >Thành<br> tiền</th>
                <th class="main-s6z2" >Ghi<br> chú</th>
            </tr>
            <?php
                $stt = 1;
                $sum = 0;
                foreach ($bag['data']->detail as $detail) {
                    # code...
                
            ?>
            
            <tr class="page-break-inside-avoid">
                <td>{{ $stt }}</td>
                <td class="align-left" >{{ $detail->ten_sanpham }}</td>
                <td>{{ $detail->so_lo }}</td>
                <td>{{ $detail->hansudung }}</td>
                <td></td>
                <td>{{ $detail->ten_donvitinh }}</td>
                <td class="align-right">{{ number_format($detail->soluongnhap, 0) }}</td>
                <td class="align-right">{{ number_format($detail->dongianhap, 2) }}</td>
                <td class="align-right"><?php $tt = $detail->soluongnhap * $detail->dongianhap; $sum += $tt; ?>{{ number_format($tt, 0) }}</td>
                <td></td>
                
            </tr>
            <?php 
                $stt++;
                }
            ?>
            <tr class="bold">
                <td></td>
                <td class="bold">Tổng</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>                
                <td></td>
                <td></td>
                <td class="align-right">{{ number_format($sum, 0) }}</td>
                <td></td>
            </tr>
            <tr>
                <td class="main-yw4l no-border"></td>

                <td class="main-yw4l no-border">Tổng số tiền (bằng chữ): </td>
                <td class="main-yw4l align-left no-border bold" colspan="9"><?php echo decimalToTextVietnamese($sum); ?></td>

            </tr>
            <tr>
                <td class="main-yw4l no-border"></td>

                <td class="main-yw4l no-border">Chứng từ kèm theo: </td>
                <td class="main-yw4l align-left no-border" colspan="9"></td>

            </tr>
            <tr>
                <td class="no-border bold" colspan="2">Người lập</td>
                <td class="no-border bold" colspan="2">Người giao hàng</td>
                <td class="no-border bold" colspan="2">Thủ kho</td>
                <td class="no-border bold" colspan="2">Kế toán trưởng</td>
                <td class="no-border bold" colspan="2">Thủ trưởng đơn vị</td>
            </tr>
            <tr style="height: 80px;"></tr>
            <tr>
                <td class="no-border" colspan="2">{{ Admin::user()->name }}</td>
                <td class="no-border" colspan="2">{{ $bag['data']->result[0]->nguoi_giaohang }}</td>
                <td class="no-border" colspan="2"></td>
                <td class="no-border" colspan="2">{{ config('company.chucvu.ketoantruong') }}</td>
                <td class="no-border" colspan="2">{{ config('company.chucvu.thutruongdonvi') }}</td>
            </tr>

        </table>
    </article>
</section>
@endif
@endsection