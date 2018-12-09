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
<p style="page-break-before: always">
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
              <td class="tg-031e align-left" colspan="3">{{ $bag['meta']['ten_thong_so_ncc'] }}  </td>
          </tr>
          <tr>
              <td class="tg-031e align-left" colspan="3">{{ $bag['meta']['ten_thong_so_sanpham'] }}  </td>
          </tr>
          <tr>
              <td class="tg-031e align-left" colspan="3">{{ $bag['meta']['ten_thong_so_nhom'] }}  </td>
          </tr>
          <tr>
              <td class="tg-031e align-left" colspan="3">{{ $bag['meta']['ten_thong_so_loai'] }}  </td>
          </tr>
      </table>
      <table class="main">
        <tr>
          <th class="main-s6z2" rowspan="2" style="width: 25px;">STT</th>
          <th class="main-s6z2" colspan="2" style="width: 150px;">Phiếu nhập</th>
          <th class="main-s6z2" rowspan="2">Thông tin quy cách vật tư dụng cụ, sản phẩm</th>
          <th class="main-s6z2" rowspan="2" style="width: 110px;">Số lô</th>
          <th class="main-s6z2" rowspan="2" style="width: 45px;">Kho</th>
          <th class="main-s6z2" rowspan="2" style="width: 45px;">ĐVT</th>
          <th class="main-s6z2" rowspan="2" style="width: 55px;">Hạn SD</th>

          <th class="main-s6z2" rowspan="2" style="width: 120px;">Đơn giá</th>
          <th class="main-s6z2" rowspan="2" style="width: 60px;">Số lượng</th>

          <th class="main-s6z2" rowspan="2" style="width: 95px;">Thành tiền</th>
          <th class="main-s6z2" rowspan="2" style="width: 30px;">Ghi<br> chú</th>
      </tr>
      <tr>
        <th class="main-s6z2" >Số</th>
        <th class="main-s6z2" >Ngày</th>
    </tr>
          <?php
              $stt = 1;
              $sum = 0;
              $arr_tongncc = Array();
              foreach ($bag['data']->detail as $k => $detail) {
                  $nguon_new = false;
                  $tong_ncc = 0;
                  
                  # code...                
              
          ?>
    <tr class="page-break-inside-avoid"><td colspan="12" align = "left">- Nguồn vốn:<b> {{$k}}  </b>   - Tổng: <span class="bold" id = 'ncc_{{$k}}' >123</span>
          <?php
                foreach ($detail as $key => $value) {
                
                
          ?>        
                  <tr class="page-break-inside-avoid">
                <td>{{ $stt }}</td>
                <td>{{ $value->so_phieunhap }}</td>
                <td>{{ empty($value->ngay_nhapkho) ? '' : \Carbon\Carbon::parse($value->ngay_nhapkho)->format('d/m/Y') }}</td>
                <td class="align-left"><b>+ {{ $value->ten_sanpham }}</b>
                    <br>- Loại:{{ $value->ten_loai_sanpham }}<br> </td>
                <td class="align-left">{{ $value->so_lo }}</td>
                <td>{{ $value->ma_kho }}</td>
                <td>{{ $value->ten_donvitinh }}</td>
                <td>{{ \Carbon\Carbon::parse($value->hansudung)->format('m/Y') }}</td>
                <td class="align-right">{{ number_format($value->dongianhap, 2) }}</td>
                <td class="align-right">{{ number_format($value->soluongnhap, 0) }}</td>
                <td class="align-right"><?php $tt = $value->soluongnhap * $value->dongianhap; $sum += $tt; ?>{{ number_format($tt, 0) }}</td>
                <td></td>
              
          </tr>
          <?php
                $tong_ncc += $tt;
                }
          ?>        
    
            <?php 
              $stt++;
              $arr_tongncc[$k] = $tong_ncc;
              }

              
              $sum = round($sum);
//              print_r($arr_tongncc);
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
      <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
      <script>
          $(document).ready(function(){
              <?php
              foreach ($arr_tongncc as $key => $value) {
                  $value = number_format($value, 0);
                  print_r("document.getElementById('ncc_$key').innerHTML = '$value';");
              }
              ?>
          });
      </script>
<p style="page-break-before: always">
</section>
@endif
@endsection