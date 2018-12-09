@extends('print.layout.paper')

@section('title')
 {{$bag['meta']['title']}}
@endsection

@section('paper-size') A4 landscape @endsection
@section('paper-class') A4 landscape @endsection

@section('custom-css')
<link rel="stylesheet" href="{{ asset('css/bieumau.css') }}">
@endsection

@section('paper-toolbar-top')
<form method="post" action="{{ route('store.print', ['view' => 'bieumau_report_nhapxuatton_chitiet']) }}">
  {{ csrf_field() }}
  <input type="hidden" name="phieuxuat_id" value="1" />
  <button class="btn btn-sm btn-primary grid-refresh" type="submit"><i class="fa fa-refresh"></i> Xu?t Excel</button>
</form>
@endsection

@section('content')
@if(empty($bag['data']->result))
<section class="sheet padding-10mm">
    <article>
        <h1>Không tìm thấy dữ liệu</h1>
        <a href="{{ admin_base_path('/') }}"><b>Quay về trang chủ</b></a>
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

              ?> Từ ngày {{ $p_ngay_batdau->format('d/m/Y') }} Đến ngày {{ $p_ngay_ketthuc->format('d/m/Y') }}</td>
              <td class="tg-031e"></td>
          </tr>

      </table>
      <table class="main">
        
        <thead>
            <?php 
                if($bag['meta']['loai_bao_cao_ten'] == 'xnt'  ){
            ?>
            <tr class="bold" >
                <td rowspan="2" style="width:4%">STT</td>
                <td rowspan="2" style="width:240px" >Sản phẩm</td>
                <!--<td rowspan="2">Ngu?n v?n</td>-->
<!--                <td rowspan="2">�VT</td>
                <td rowspan="2">��n gi�</td>
                <td rowspan="2">HSD</td>-->
                <?php if ($bag['meta']['p_ngay_batdau'])
                ?>
                <td colspan="2">Tồn đầu kỳ</td>
                <td colspan="2">Nhập</td>
                <td colspan="2">Xuất</td>
                <td colspan="2">Cuối kỳ</td>     
                <td rowspan="2">Ghi chú</td>
            </tr>
            <tr>    
                <td>Tồn<br>đầu kỳ</td>
                <td>Thành tiền<br></td>
                <td>Nhập</td>
                <td>Thành tiền</td>
                <td>Tổng xuất</td>
                <td>Thành tiền</td>
                <td>Tồn<br>cuối kỳ</td>
                <td>Thành tiền</td>
            </tr>
            <?php
                }else {
            ?>
            <tr class="bold" >
                <td rowspan="2" style="width:4%">STT</td>
                <td rowspan="2" style="width:350px" >Sản phẩm</td>
                <!--<td rowspan="2">Ngu?n v?n</td>-->
<!--                <td rowspan="2">�VT</td>
                <td rowspan="2">��n gi�</td>
                <td rowspan="2">HSD</td>-->
                <?php if ($bag['meta']['p_ngay_batdau'])
                ?>
                <td colspan="2">Tồn đầu kỳ</td>
                <td colspan="2">Cuối kỳ</td>     
                <td rowspan="2">Ghi chú</td>
            </tr>
            <tr>    
                <td>Tồn<br>đầu kỳ</td>
                <td>Thành tiền<br></td>
                <td>Tồn<br>cuối kỳ</td>
                <td>Thành tiền</td>
            </tr>
            <?php
                }
            ?>
        </thead>
        <tbody>
            <?php 
                if($bag['meta']['loai_bao_cao_ten'] == 'xnt'  ){
            ?>
            
            
            <?php
            $stt = 0;
            $sumTonDauKy = 0;
            $sumTongNhap = 0;
            $sumTongXuat = 0;
            $sumTonCuoiKy = 0;
            ?>
            @foreach($bag['data']->detail as $key => $value)
            <?php
            $stt++;
            $ttTonDauKy = $value->dongianhap * $value->tong_soluong_tondauky;
            $ttTongNhap = $value->dongianhap * $value->tong_soluongnhap;
            $ttTongXuat = $value->dongianhap * $value->tong_soluongxuat;
            $ttTonCuoiKy = $ttTonDauKy + $ttTongNhap - $ttTongXuat;
            ?>
            
            <?php
                if($key == 0  || ( isset($bag['data']->detail[$key-1]->ma_nguoncungcap) && $bag['data']->detail[$key-1]->ma_nguoncungcap != $bag['data']->detail[$key]->ma_nguoncungcap)  ){
                    $nguon_new = true;
              ?>
                <tr class="page-break-inside-avoid"><td colspan="11" align = "left">- Nguồn vốn:<b> {{$bag['data']->detail[$key]->ma_nguoncungcap}}   </b> 
                        <!--- T?ng gi� tr? nh?p: <b>{{  number_format(0, 0)}} �</b> </td></tr>-->            

              <?php 
                }
                //if( $value->tong_soluong_tondauky!= 0 && $value->tong_soluongnhap!= 0 && $value->tong_soluongxuat!= 0 ){
              ?>
            <tr>
                <td>{{ $stt }}</td>
                <td  align="left" ><b> + {{ $value->ten_sanpham }} </b>
                    <br>Đơn vị tính: {{ $value->ten_donvitinh }} 
                    <br> Đơn giá: {{ number_format($value->dongianhap, 4) }} 
                    <br> HSD: {{ \Carbon\Carbon::parse($value->hansudung)->format('m/Y') }}   </td>
                <!--<td>{{ $value->ma_nguoncungcap }}</td>-->
<!--                <td></td>
                <td class="dongia align-right"></td>
                <td></td>-->
                <td class="soluong align-right">{{ number_format($value->tong_soluong_tondauky, 0) }}</td>
                <td class="thanhtien align-right">{{ number_format($ttTonDauKy, 0) }}</td>
                <td class="soluong align-right">{{ number_format($value->tong_soluongnhap, 0) }}</td>
                <td class="thanhtien align-right">{{ number_format($ttTongNhap, 0) }}</td>
                <td class="soluong align-right">{{ number_format($value->tong_soluongxuat, 0) }}</td>
                <td class="thanhtien align-right">{{ number_format($ttTongXuat, 0) }}</td>
                <td class="soluong align-right">{{ number_format($value->tong_soluong_tondauky + $value->tong_soluongnhap - $value->tong_soluongxuat, 0) }}</td>
                <td class="thanhtien align-right">{{ number_format($ttTonCuoiKy, 0) }}</td>
                <td></td>
            </tr>
            <?php
                
            $sumTonDauKy += $ttTonDauKy;
            $sumTongNhap += $ttTongNhap;
            $sumTongXuat += $ttTongXuat;
            $sumTonCuoiKy = $sumTonDauKy + $sumTongNhap - $sumTongXuat;
                //}
            ?>
            @endforeach    
            <tr class="bold">
              <td></td>
                <td>T?ng</td>
<!--                <td></td>
                <td></td>
                <td></td>-->
                <td>0</td>
                <td class="thanhtien align-right">{{ number_format($sumTonDauKy, 0) }}</td>
                <td></td>
                <td class="thanhtien align-right">{{ number_format($sumTongNhap, 0) }}</td>
                <td></td>
                <td class="thanhtien align-right">{{ number_format($sumTongXuat, 0) }}</td>
                <td>0</td>
                <td class="thanhtien align-right">{{ number_format($sumTonCuoiKy, 0) }}</td>
                <td></td>
          </tr>
          <tr>
              <td class="main-yw4l no-border"></td>

              <td class="main-yw4l no-border" colspan="2" align = "left">Tổng số tiền (bằng chữ): </td>
              <td class="main-yw4l align-left no-border bold" colspan="8"><?php echo decimalToTextVietnamese($sumTonCuoiKy); ?></td>

          </tr>
          
          <tr>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">Người lập</td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">Thủ kho</td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">Kế toán trưởng</td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">Thủ trưởng đơn vị</td>
              <td class="no-border bold" colspan="1"></td>

          </tr>
          <tr style="height: 80px;"></tr>
          <tr>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">{{ Admin::user()->name }}</td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">{{ config('company.chucvu.thukho') }}</td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">{{ config('company.chucvu.ketoantruong') }}</td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="1">{{ config('company.chucvu.thutruongdonvi') }}</td>
              <td class="no-border bold" colspan="1"></td>
              
          </tr>
        </tbody>
        <?php
                } else {
        ?>
        <?php
            $stt = 0;
            $sumTonDauKy = 0;
            $sumTongNhap = 0;
            $sumTongXuat = 0;
            $sumTonCuoiKy = 0;
            ?>
            @foreach($bag['data']->detail as $key => $value)
            <?php
            $stt++;
            $ttTonDauKy = $value->dongianhap * $value->tong_soluong_tondauky;
            $ttTongNhap = $value->dongianhap * $value->tong_soluongnhap;
            $ttTongXuat = $value->dongianhap * $value->tong_soluongxuat;
            $ttTonCuoiKy = $ttTonDauKy + $ttTongNhap - $ttTongXuat;
            ?>
            <?php
                if($key == 0  || ( isset($bag['data']->detail[$key-1]->ma_nguoncungcap) && $bag['data']->detail[$key-1]->ma_nguoncungcap != $bag['data']->detail[$key]->ma_nguoncungcap)  ){
                    $nguon_new = true;
              ?>
                <tr class="page-break-inside-avoid"><td colspan="7" align = "left">- Nguồn vốn:<b> {{$bag['data']->detail[$key]->ma_nguoncungcap}}   </b> 
                        <!--- T?ng gi� tr? nh?p: <b>{{  number_format(0, 0)}} �</b> </td></tr>-->            

              <?php 
                }
              ?>
            
            <tr>
                <td>{{ $stt }}</td>
                 <td  align="left" ><b> + {{ $value->ten_sanpham }} </b>
                    <br>Đơn vị tính: {{ $value->ten_donvitinh }} 
                    <br> Đơn giá: {{ number_format($value->dongianhap, 4) }} 
                    <br> HSD: {{ \Carbon\Carbon::parse($value->hansudung)->format('m/Y') }}   </td>
                
                <td class="soluong align-right">{{ number_format($value->tong_soluong_tondauky, 0) }}</td>
                <td class="thanhtien align-right">{{ number_format($ttTonDauKy, 0) }}</td>
<!--                <td class="soluong align-right">{{ number_format($value->tong_soluongnhap, 0) }}</td>
                <td class="thanhtien align-right">{{ number_format($ttTongNhap, 0) }}</td>
                <td class="soluong align-right">{{ number_format($value->tong_soluongxuat, 0) }}</td>
                <td class="thanhtien align-right">{{ number_format($ttTongXuat, 0) }}</td>-->
                <td class="soluong align-right">{{ number_format($value->tong_soluong_tondauky + $value->tong_soluongnhap - $value->tong_soluongxuat, 0) }}</td>
                <td class="thanhtien align-right">{{ number_format($ttTonCuoiKy, 0) }}</td>
                <td></td>
            </tr>
            <?php
            $sumTonDauKy += $ttTonDauKy;
            $sumTongNhap += $ttTongNhap;
            $sumTongXuat += $ttTongXuat;
            $sumTonCuoiKy = $sumTonDauKy + $sumTongNhap - $sumTongXuat;
            ?>
            @endforeach    
            <tr class="bold">
              <td></td>
                <td>Tổng</td>
<!--                <td></td>
                <td></td>
                <td></td>-->
                <td>0</td>
                <td class="thanhtien align-right">{{ number_format($sumTonDauKy, 0) }}</td>
                <td></td>
                <td class="thanhtien align-right">{{ number_format($sumTonCuoiKy, 0) }}</td>
                <td></td>
          </tr>
          <tr>
              <td class="main-yw4l no-border"></td>

              <td class="main-yw4l no-border" colspan="1" align = "left">Tổng số tiền (bằng chữ): </td>
              <td class="main-yw4l align-left no-border bold" colspan="4"><?php echo decimalToTextVietnamese($sumTonCuoiKy); ?></td>

          </tr>
          
          <tr>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="2">Người lập</td>
              <td class="no-border bold" colspan="1"></td>
              <td class="no-border bold" colspan="2">Thủ trưởng đơn vị</td>
              <td class="no-border bold" colspan="1"></td>

          </tr>
          <tr style="height: 80px;"></tr>
          <tr>
              <td class="no-border" colspan="1"></td>
              <td class="no-border" colspan="2">{{ Admin::user()->name }}</td>
              <td class="no-border" colspan="1"></td>
              <td class="no-border" colspan="2">{{ config('company.chucvu.thutruongdonvi') }}</td>
              <td class="no-border" colspan="1"></td>
          </tr>
        </tbody>
        <?php 
                }
        ?>
    </table> 
    </article>
    <p style="page-break-before: always">
</section>
@endif
@endsection