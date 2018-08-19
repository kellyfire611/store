@extends('print.layout.paper')

@section('title')
Biểu mẫu Phiếu xuất kho
@endsection

@section('paper-size') A4 @endsection
@section('paper-class') A4 @endsection

@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/bieumau.css') }}">
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
        <table class="tg" border="0">
            <tr>
                <th class="tg-baqh" style="width: 250px;">{{ config('company.parent.name') }}</th>
                <th class="tg-baqh" style="width: 250px;"></th>
                <th class="tg-baqh" style="width: 100%;">Mẫu số: C21-HD </th>
            </tr>
            <tr>
                <td class="tg-baqh align-center valign-top">{{ config('company.name') }}</td>
                <td class="name"><b>{{ $bag['meta']['title'] }}</b><br/>
                <?php
                $ngayXuat = \Carbon\Carbon::parse($bag['data']->result[0]->ngay_xuatkho);

                ?><span style="font-size: 14px;">Ngày {{ $ngayXuat->day }} tháng {{ $ngayXuat->month }} năm {{ $ngayXuat->year }}</span>
                </td>
                <td class="tg-s6z2 align-center">Ban hành theo quy định số:
                    <br>19/2006/QĐ-BTC
                    <br>ngày 30/03/2006
                    <br>của Bộ Tài Chính</td>
            </tr>
            <tr>
                <td class="tg-031e"></td>
                <td class="tg-031e align-center"></td>
                <td class="tg-031e"></td>
            </tr>
            <tr>
                <td class="tg-031e align-left" colspan="2">Đơn vị nhận hàng : {{ $bag['data']->result[0]->ten_donvi }}</td>
                <td class="tg-031e align-left" colspan="3">Số : {{ $bag['data']->result[0]->so_phieuxuat }}</td>
            </tr>
            <tr>
                <td class="tg-031e align-left" colspan="2">Họ tên người nhận hàng : {{ $bag['data']->result[0]->nguoi_nhanhang }}</td>
                <td class="tg-031e align-left" colspan="3">Số CT: {{ $bag['data']->result[0]->so_chungtu }}<br />Ngày: {{ empty($bag['data']->result[0]->ngay_chungtu) ? '' : \Carbon\Carbon::parse($bag['data']->result[0]->ngay_chungtu)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="tg-031e align-left" colspan="3">Lý do xuất kho : {{ $bag['data']->result[0]->lydo_xuat }}</td>
            </tr>
        </table>
        <table class="main">
            <tr>
                <th class="main-s6z2"  style="width: 26px;">STT</th>
                <th class="main-s6z2"  style="width: 90px;">Tên quy cách vật tư
                    <br>dụng cụ, sản phẩm</th>
                <th class="main-s6z2"  style="width: 80px;">Số lô</th>
                <th class="main-s6z2" style="width: 50px;">Nguồn</th>
                <th class="main-s6z2"  style="width: 60px;">Hạn SD</th>
                <th class="main-s6z2"  style="width: 50px;">Nhóm sản phẩm</th>
                <th class="main-s6z2"  style="width: 40px;">ĐVT</th>

                <th class="main-s6z2" style="width: 60px;">Số lượng</th>
                
                <th class="main-s6z2" style="width: 65px;">Đơn giá</th>

                    <th class="main-s6z2"  style="width: 70px;">Thành
                        <br> tiền</th>
                    <th class="main-s6z2"  style="width: 24px;">Ghi<br>chú</th>
            </tr>
            <?php
                $stt = 1;
                $sum = 0;
                foreach ($bag['data']->detail as $detail) {
                    # code...
                
            ?>
            
            <tr class="page-break-inside-avoid">
                <td>{{ $stt }}</td>
                <td class="align-left" >{{ $detail->ten_sanpham }} - {{ $detail->nongdohamluong }}</td>
                <td class="align-left">{{ $detail->SOLO }}</td>
                <td>{{ $detail->ma_nguoncungcap }}</td>
                <td>{{ \Carbon\Carbon::parse($detail->HanSD)->format('m/Y') }}</td>
                <td>{{ $detail->ma_nhom_sanpham}}</td>
                <td>{{ $detail->ten_donvitinh }}</td>
                <td class="align-right">{{ number_format($detail->soluongxuat, 0) }}</td>
                <td class="align-right">{{ number_format($detail->dongiaxuat, 0) }}</td>
                <td class="align-right"><?php $tt = $detail->soluongxuat * $detail->dongiaxuat; $sum += $tt; ?>{{ number_format($tt, 0) }}</td>
                <td></td>
            </tr>
            <?php 
                $stt++;
                }

                $sum = round($sum);
            ?>
            <tr>
                <td></td>
                <td class="bold">Tổng</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="align-right">{{ number_format($sum, 0) }}</td>
                <td></td>
            </tr>
            </table>
            <table>
            <tr>
                

                <td class="main-yw4l no-border align-left" style="width: 150px;">Tổng số tiền (bằng chữ): </td>
                <td class="main-yw4l align-left no-border bold"><?php echo decimalToTextVietnamese($sum); ?>.</td>

            </tr>
            <tr>
                

                <td class="main-yw4l no-border align-left">Chứng từ kèm theo: </td>
                <td class="main-yw4l align-left no-border"></td>

            </tr>
            </table>
            <table>
            <tr>
                <td class="no-border bold" >Người lập</td>
                <td class="no-border bold" >Người nhận hàng</td>
                <td class="no-border bold" >Thủ kho</td>
                <td class="no-border bold" >Kế toán trưởng</td>
                <td class="no-border bold" >Thủ trưởng đơn vị</td>
            </tr>
            <tr style="height: 80px;"></tr>
            <tr>
                <td class="no-border" >{{ Admin::user()->name }}</td>
                <td class="no-border" >{{ $bag['data']->result[0]->nguoi_nhanhang }}</td>
                <td class="no-border" >Dương Trung</td>
                <td class="no-border" >{{ config('company.chucvu.ketoantruong') }}</td>
                <td class="no-border" >{{ config('company.chucvu.thutruongdonvi') }}</td>
            </tr>

        </table>
    </article>
</section>
@endif
@endsection