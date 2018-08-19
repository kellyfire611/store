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
        <table class="tg" >
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
                <td class="tg-031e">Số : {{ $bag['data']->result[0]->so_phieunhap }}  </td>
            </tr>
           
            <tr class="align-left">
                <td class="tg-031e align-left" colspan="2">Đơn vị giao hàng: {{ $bag['data']->result[0]->ten_nhacungcap }}</td>
                <td>
                <?php 
                $dataCT = array();
                $dataNguon = array();
                
                foreach ($bag['data']->detail as $detail) {
                    //dd($detail);
                    $dataCT[] = [
                        'so_chungtu' => $detail->so_chungtu,
                        'ngay_chungtu' => $detail->ngay_chungtu
                    ];

                    $dataNguon[] = [
                        'ten_nguoncungcap' => $detail->ten_nguoncungcap
                    ];
                ?>
                <?php
                }

                //dd($bag['data']->detail);
                //dd($data);
                
                $dataCT = array_unique_multidimensional($dataCT);
                foreach($dataCT as $CT) {
                ?>
                Số CT: {{ $CT['so_chungtu'] }} - Ngày: {{ empty($CT['ngay_chungtu']) ? '' : \Carbon\Carbon::parse($CT['ngay_chungtu'])->format('d/m/Y') }}<br />
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td class="tg-031e align-left" colspan="3">Lý do nhập : {{ $bag['data']->result[0]->lydo_nhap }}</td>
            </tr>
            <tr>
                <td class="tg-031e align-left" colspan="3">Nhập tại kho : {{ $bag['data']->result[0]->ten_kho }}</td>
            </tr>
            <tr>
                <td class="tg-031e align-left" colspan="3" >Nguồn : 
                <?php 
                //dd(unique_multidim_array($dataNguon, 'ten_nguoncungcap'));
                $dataNguonCungCap = unique_multidim_array($dataNguon, 'ten_nguoncungcap');
                foreach($dataNguonCungCap as $nguonCungCap) {
                ?>
                {{ $nguonCungCap['ten_nguoncungcap'] }},
                <?php } ?>
                </td>
            </tr>
        </table>
        <table class="main">
            <tr>
                <th class="main-s6z2" style="width: 30px;" >STT</th>
                <th class="main-s6z2" style="width: 90px;">Tên quy cách vật tư dụng cụ, sản phẩm</th>
                <th class="main-s6z2" style="width: 90px;">Số lô</th>
                <th class="main-s6z2" style="width: 60px;">Hạn SD</th>
                <th class="main-s6z2" style="width: 50px;">Nhóm sản phẩm</th>
                <th class="main-s6z2" style="width: 40px;">ĐVT</th>

                <th class="main-s6z2" style="width: 55px;">Số lượng</th>
                <th class="main-s6z2" style="width: 90px;">Đơn giá</th>

                <th class="main-s6z2" style="width: 92px;">Thành<br> tiền</th>
                <th class="main-s6z2" style="width: 25px;">Ghi<br> chú</th>
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
                <td class="align-left">{{ $detail->so_lo }}</td>
                <td>{{ \Carbon\Carbon::parse($detail->hansudung)->format('m/Y') }}</td>
                <td>{{ $detail->ma_nhom_sanpham }}</td>
                <td>{{ $detail->ten_donvitinh }}</td>
                <td class="align-right">{{ number_format($detail->soluongnhap, 0) }}</td>
                <td class="align-right">{{ number_format($detail->dongianhap, 2) }}</td>
                <td class="align-right"><?php $tt = $detail->soluongnhap * $detail->dongianhap; $sum += $tt; ?>{{ number_format($tt, 0) }}</td>
                <td></td>
                
            </tr>
            <?php 
                $stt++;
                }

                $sum = round($sum);
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
        </table>
        <table>
            <tr>
               

                <td class="main-yw4l align-left no-border" style="width: 150px">Tổng số tiền (bằng chữ): </td>
                <td class="main-yw4l align-left no-border bold"><?php echo decimalToTextVietnamese($sum); ?>.</td>

            </tr>
            <tr>
              

                <td class="main-yw4l align-left no-border">Chứng từ kèm theo: </td>
                <td class="main-yw4l align-left no-border"></td>

            </tr>
            </table>
        <table>
            <tr>
                <td class="no-border bold" >Người lập</td>
                <td class="no-border bold" >Người giao hàng</td>
                <td class="no-border bold" >Thủ kho</td>
                <td class="no-border bold" >Kế toán trưởng</td>
                <td class="no-border bold" >Thủ trưởng đơn vị</td>
            </tr>
            <tr style="height: 80px;"></tr>
            <tr>
                <td class="no-border" >{{ Admin::user()->name }}</td>
                <td class="no-border" >{{ $bag['data']->result[0]->nguoi_giaohang }}</td>
                <td class="no-border" >Dương Trung</td>
                <td class="no-border" >{{ config('company.chucvu.ketoantruong') }}</td>
                <td class="no-border" >{{ config('company.chucvu.thutruongdonvi') }}</td>
            </tr>
        </table>
    </article>
</section>
@endif
@endsection