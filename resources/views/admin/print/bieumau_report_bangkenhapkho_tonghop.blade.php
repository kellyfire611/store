@extends('print.layout.paper')

@section('title')
Biểu mẫu Bảng kê Nhập kho tổng hợp
@endsection

@section('paper-size') A4 landscape @endsection
@section('paper-class') A4 landscape @endsection

@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/bieumau.css') }}">
@endsection

@section('paper-toolbar-top')

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
              <th></th>
              <th class="tg-baqh">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</th>
          </tr>
          <tr>
              <td class="tg-baqh align-center valign-top">{{ config('company.name') }}</td>
              <td class="bold name">{{ $bag['meta']['title'] }}</td>
              <td class="tg-s6z2 align-center">
                  Độc lập - Tự do - Hạnh phúc
              </td>
          </tr>
          <tr>
              <td class="tg-031e"></td>
              <td class="tg-031e align-center"><?php
              $p_ngay_batdau = \Carbon\Carbon::parse($bag['meta']['p_ngay_batdau']);
              $p_ngay_ketthuc = \Carbon\Carbon::parse($bag['meta']['p_ngay_ketthuc']);

              ?> Từ ngày {{ $p_ngay_batdau->format('d/m/Y') }} đến ngày {{ $p_ngay_ketthuc->format('d/m/Y') }}</td>
              <td class="tg-031e"></td>
          </tr>
          <tr>
              <td class="tg-031e align-left" colspan="3">Nguồn vốn : {{ $bag['data']->result[0]->ten_nguoncungcap }}  </td>
          </tr>
      </table>
      <table class="main">
        <tr>
          <th class="main-s6z2" rowspan="2">STT</th>
          <th class="main-s6z2" colspan="2">Chứng từ</th>
          <th class="main-s6z2" rowspan="2">Tên quy cách vật tư dụng cụ, sản phẩm</th>
          <th class="main-s6z2" rowspan="2">Số lô</th>
          <th class="main-s6z2" rowspan="2">Kho</th>
          <th class="main-s6z2" rowspan="2">ĐVT</th>
          <th class="main-s6z2" rowspan="2">Hạn SD</th>

          <th class="main-s6z2" rowspan="2">Đơn giá</th>
          <th class="main-s6z2" rowspan="2">Số lượng</th>

          <th class="main-s6z2" rowspan="2">Thành<br> tiền</th>
          <th class="main-s6z2" rowspan="2">Ghi<br> chú</th>
      </tr>
      <tr>
        <th class="main-s6z2" >Số</th>
        <th class="main-s6z2" >Ngày</th>
    </tr>
          <?php
              $stt = 1;
              $sum = 0;
              foreach ($bag['data']->detail as $detail) {
                  # code...
              
          ?>
          
          <tr class="page-break-inside-avoid">
              <td>{{ $stt }}</td>
              <td>{{ $detail->so_chungtu }}</td>
              <td>{{ $detail->ngay_laphoadon }}</td>
              <td class="align-left" >{{ $detail->ten_sanpham }}</td>
              <td>{{ $detail->so_lo }}</td>
              <td>{{ $detail->ten_kho }}</td>
              <td>{{ $detail->ten_donvitinh }}</td>
              <td>{{ \Carbon\Carbon::parse($detail->hansudung)->format('d/m/Y') }}</td>
              <td class="align-right">{{ number_format($detail->dongianhap, 2) }}</td>
              <td class="align-right">{{ number_format($detail->soluongnhap, 0) }}</td>
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
              <td></td>
              <td></td>
              <td class="align-right">{{ number_format($sum, 0) }}</td>
              <td></td>
          </tr>
          <tr>
              <td class="main-yw4l no-border"></td>

              <td class="main-yw4l no-border" colspan="2">Tổng số tiền (bằng chữ): </td>
              <td class="main-yw4l align-left no-border bold" colspan="9"><?php echo decimalToTextVietnamese($sum); ?></td>

          </tr>
          
          <tr>
              <td class="no-border bold" colspan="2">Người lập</td>
              <td class="no-border bold" colspan="2"></td>
              <td class="no-border bold" colspan="2"></td>
              <td class="no-border bold" colspan="2"></td>
              <td class="no-border bold" colspan="2">Thủ trưởng đơn vị</td>
          </tr>
          <tr style="height: 80px;"></tr>
          <tr>
              <td class="no-border" colspan="2">{{ Admin::user()->name }}</td>
              <td class="no-border" colspan="2"></td>
              <td class="no-border" colspan="2"></td>
              <td class="no-border" colspan="2"></td>
              <td class="no-border" colspan="2">{{ config('company.chucvu.thutruongdonvi') }}</td>
          </tr>

      </table>
  </article>
</section>
@endif
@endsection