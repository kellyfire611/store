@extends('print.layout.paper')

@section('title')
Biểu mẫu Báo cáo Bảng kê xuất kho theo sản phẩm
@endsection

@section('paper-size') A4 landscape @endsection
@section('paper-class') A4 landscape @endsection

@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/bieumau.css') }}">
@endsection

@section('paper-toolbar-top')

@endsection

@section('content')
@if(empty($bag['data']->detail))
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
              <td class="bold name">Báo cáo xuất kho tổng hợp</td>
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
              <th class="main-s6z2" style="width:5%" >STT</th>
              <th class="main-s6z2 align-left"   style="width:10% ;"  >Mã đơn vị nhận</th>
              <th class="main-s6z2 align-left"  style="width:50% ; " >Tên đơn vị nhận</th>
              <th class="main-s6z2 align-right"  style="width:10%" >Số sản phẩm</th>
              <th class="main-s6z2 align-right"  >Tổng giá trị xuất</th>
              <th class="main-s6z2"   style="width: 10%;">Ghi chú</th>
          </tr>
          
            
          <?php  
            $sum_total = 0;
                    $stt = 1;
                foreach ($bag['data']->arr_donvi as $k => $v) {    
          ?>

          <tr class="page-break-inside-avoid">
              <td>{{$stt}}</td>
              <td class="align-left">{{$v->ma_donvi}}</td>
              <td class="align-left">{{$v->ten_donvi}}</td>
              <td class="align-right">{{$v->tong_sp}}</td>
              <td class="align-right">{{number_format($v->tong_giatri, 0)}}</td>
              <td></td>
              
          </tr>
          <?php 
              $stt++;
              $sum_total += $v->tong_giatri;
              }
          ?>
          <tr class="bold">
              <td></td>
              <td class="bold">Tổng</td>
              <td></td>
              <td></td>
              <td class="align-right">{{ number_format($sum_total, 0) }}</td>
              <td></td>
          </tr>
          <tr>
              <td class="main-yw4l no-border"></td>

              <td class="main-yw4l no-border" colspan="1">Tổng số tiền (bằng chữ): </td>
              <td class="main-yw4l align-left no-border bold" colspan="4"><?php echo decimalToTextVietnamese($sum_total); ?></td>

          </tr>
          
          <tr>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">Người lập</td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">Thủ trưởng đơn vị</td>
              <td class="no-border bold" colspan="1"></td>
          </tr>
          <tr style="height: 80px;"></tr>
          <tr>
              <td class="no-border" colspan="1"></td>
              <td class="no-border" colspan="1">{{ Admin::user()->name }}</td>
              <td class="no-border" colspan="1"></td>
              <td class="no-border" colspan="1"></td>
              <td class="no-border" colspan="1">{{ config('company.chucvu.thutruongdonvi') }}</td>
              <td class="no-border" colspan="1"></td>
          </tr>

      </table>
  </article>
        <p style="page-break-before: always">
    <?php  
    $sum_total = 0;
        foreach ($bag['data']->detail as $k => $v) {    
    
    ?>
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
              <td class="tg-031e align-left" colspan="3">Đơn vị nhận: {{ $k }}  </td>
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
              <th class="main-s6z2" rowspan="2">STT</th>
              <th class="main-s6z2" colspan="2">Phiếu xuất</th>
              <th class="main-s6z2" rowspan="2" style="width: 11%;">Tên quy cách vật tư dụng cụ, sản phẩm</th>
              <th class="main-s6z2" rowspan="2">Số lô</th>
              <th class="main-s6z2" rowspan="2">Kho</th>
              <th class="main-s6z2" rowspan="2">ĐVT</th>
              <th class="main-s6z2" rowspan="2">Hạn SD</th>

              <th class="main-s6z2" rowspan="2">Đơn giá</th>
              <th class="main-s6z2" rowspan="2">Số lượng</th>

              <th class="main-s6z2" rowspan="2" style="width: 10%;">Thành<br> tiền</th>
              <th class="main-s6z2" rowspan="2" style="width: 30px;">Ghi<br> chú</th>
          </tr>
          <tr>
            <th class="main-s6z2" >Số</th>
            <th class="main-s6z2" >Ngày</th>
        </tr>
          <?php
              $stt = 1;
              $sum = 0;
              foreach ($v as $kv => $vv) {
                  # code...
              
          ?>
          
            
          <?php
            if($kv == 0  || ( isset($v[$kv-1]->ten_nhom_sanpham) && $v[$kv-1]->ten_nhom_sanpham != $v[$kv]->ten_nhom_sanpham)  ){
          ?>
            <tr class="page-break-inside-avoid"><td colspan="12" align = "left">- - Nhóm sản phẩm:<b> {{$v[$kv]->ten_nhom_sanpham}} </b> </td></tr>
        <?php 
           }
          ?>  

          <tr class="page-break-inside-avoid">
              <td>{{ $stt }}</td>
              <td>{{ $vv->so_phieuxuat }}</td>
              <td>{{ $vv->ngay_xuatkho }}</td>
              <td class="align-left"><b>+ {{ $vv->ten_sanpham }}</b>
                  <br>- Loại:{{ $vv->ten_loai_sanpham }}<br> </td>
              <td>{{ $vv->so_lo }}</td>
              <td>{{ $vv->ten_kho }}</td>
              <td>{{ $vv->ten_donvitinh }}</td>
              <td>{{ \Carbon\Carbon::parse($vv->hansudung)->format('d/m/Y') }}</td>
              <td class="align-right">{{ number_format($vv->dongiaxuat, 2) }}</td>
              <td class="align-right">{{ number_format($vv->soluongxuat, 0) }}</td>
              <td class="align-right"><?php $tt = $vv->soluongxuat * $vv->dongiaxuat; $sum += $tt; ?>{{ number_format($tt, 0) }}</td>
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
        <p style="page-break-before: always">

  <?php 
  
  $sum_total += $sum;
    } 
    print_r(number_format($sum_total, 0));
  ?>
    
</section>

@endif
@endsection