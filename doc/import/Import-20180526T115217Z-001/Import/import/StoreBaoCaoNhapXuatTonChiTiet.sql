set @p_ngay_batdau = '2017-01-01';
set @p_ngay_ketthuc = '2017-12-31';
set @p_kho_id = 1;


/* --- TÍNH TỔN ĐẦU KỲ --- */
-- Nhập
CREATE TEMPORARY TABLE IF NOT EXISTS tmpTonDauKy_PhieuNhap AS (
	select *
	from
		(select k.id as kho_id, k.ten_kho
			, sp.id as sanpham_id, sp.ma_sanpham, sp.ten_sanpham
			, pnct.dongianhap as dongianhap, pnct.soluongnhap as soluongnhap, pnct.hansudung, ncc.ten_nguoncungcap
			, 0 dongiaxuat, 0 as soluongxuat
		from store_phieunhap_chitiet pnct
			join store_phieunhap pn on pnct.phieunhap_id = pn.id
			join store_sanpham sp on pnct.sanpham_id = sp.id
			join store_kho k on pn.nhap_vao_kho_id = k.id
			left join store_nguoncungcap ncc on pnct.nguoncungcap_id = ncc.id
		where pn.nhap_vao_kho_id = @p_kho_id
			and pn.ngay_nhapkho < @p_ngay_batdau
			and pn.nhapxuat_id != 45 -- Tồn kho đầu kỳ
		
		union all
		
		select k.id as kho_id, k.ten_kho
			, sp.id as sanpham_id, sp.ma_sanpham, sp.ten_sanpham
			, pnct.dongianhap as dongianhap, pnct.soluongnhap as soluongnhap, pnct.hansudung, ncc.ten_nguoncungcap
			, 0 dongiaxuat, 0 as soluongxuat
		from store_phieunhap_chitiet pnct
			join store_phieunhap pn on pnct.phieunhap_id = pn.id
			join store_sanpham sp on pnct.sanpham_id = sp.id
			join store_kho k on pn.nhap_vao_kho_id = k.id
            left join store_nguoncungcap ncc on pnct.nguoncungcap_id = ncc.id
		where pn.nhap_vao_kho_id = @p_kho_id
			and pn.nhapxuat_id = 45 -- Tồn kho đầu kỳ
		
		) as ext
);
-- select * from tmpTonDauKy_PhieuNhap;

-- Xuất
CREATE TEMPORARY TABLE IF NOT EXISTS tmpTonDauKy_PhieuXuat AS (
	select k.id as kho_id, k.ten_kho
		, sp.id as sanpham_id, sp.ma_sanpham, sp.ten_sanpham
		, 0 as dongianhap, 0 as soluongnhap, NULL as hansudung, '' as ten_nguoncungcap
		, pxct.dongiaxuat, pxct.soluongxuat
	from store_phieuxuat_chitiet pxct
		join store_phieuxuat px on pxct.phieuxuat_id = px.id
		join store_sanpham sp on pxct.sanpham_id = sp.id
		join store_kho k on px.xuat_tu_kho_id = k.id
	where px.xuat_tu_kho_id = @p_kho_id
		and px.ngay_xuatkho < @p_ngay_batdau
);
-- select * from tmpTonDauKy_PhieuXuat;

-- Dữ liệu Nhập xuất group theo từng sản phẩm
CREATE TEMPORARY TABLE IF NOT EXISTS tmpTonDauKy AS (
	select tondauky.kho_id, tondauky.ten_kho, tondauky.sanpham_id, tondauky.ma_sanpham, tondauky.ten_sanpham, tondauky.dongianhap, tondauky.hansudung, tondauky.ten_nguoncungcap, tondauky.dongiaxuat
		, sum(soluongnhap) as tong_soluongnhap
		, sum(soluongxuat) as tong_soluongxuat
	from (
		select pn.kho_id, pn.ten_kho, pn.sanpham_id, pn.ma_sanpham, pn.ten_sanpham
			, pn.dongianhap, pn.soluongnhap, pn.hansudung, pn.ten_nguoncungcap
			, px.dongiaxuat, px.soluongxuat
		from tmpTonDauKy_PhieuNhap pn
			left join tmpTonDauKy_PhieuXuat px on pn.kho_id = px.kho_id and pn.sanpham_id = px.sanpham_id
		) as tondauky
	group by tondauky.kho_id, tondauky.ten_kho, tondauky.sanpham_id, tondauky.ma_sanpham, tondauky.ten_sanpham, tondauky.dongianhap, tondauky.hansudung, tondauky.ten_nguoncungcap, tondauky.dongiaxuat
);
-- select * from tmpTonDauKy;
/* --- END TÍNH TỔN ĐẦU KỲ --- */
	
/* --- NHẬP XUẤT TRONG THỜI GIAN BÁO CÁO --- */
-- Nhập
CREATE TEMPORARY TABLE IF NOT EXISTS tmpNhapXuatTrongThang_PhieuNhap AS (
	select k.id as kho_id, k.ten_kho
		, sp.id as sanpham_id, sp.ma_sanpham, sp.ten_sanpham
		, pnct.dongianhap as dongianhap, pnct.soluongnhap as soluongnhap, pnct.hansudung, ncc.ten_nguoncungcap
		, 0 dongiaxuat, 0 as soluongxuat
	from store_phieunhap_chitiet pnct
		join store_phieunhap pn on pnct.phieunhap_id = pn.id
		join store_sanpham sp on pnct.sanpham_id = sp.id
		join store_kho k on pn.nhap_vao_kho_id = k.id
        left join store_nguoncungcap ncc on pnct.nguoncungcap_id = ncc.id
	where pn.nhap_vao_kho_id = @p_kho_id
		 and (pn.ngay_nhapkho between @p_ngay_batdau and @p_ngay_ketthuc)
		 and pn.nhapxuat_id != 45 -- Tồn kho đầu kỳ
         and pnct.sanpham_id in (68,69)
);
 select * from tmpNhapXuatTrongThang_PhieuNhap;

-- Xuất
CREATE TEMPORARY TABLE IF NOT EXISTS tmpNhapXuatTrongThang_PhieuXuat AS (
	select k.id as kho_id, k.ten_kho
		, sp.id as sanpham_id, sp.ma_sanpham, sp.ten_sanpham
		, pnct.dongianhap as dongianhap, 0 as soluongnhap, NULL as hansudung, '' as ten_nguoncungcap
		, pxct.dongiaxuat, pxct.soluongxuat
	from store_phieuxuat_chitiet pxct
		join store_phieuxuat px on pxct.phieuxuat_id = px.id
		join store_sanpham sp on pxct.sanpham_id = sp.id
		join store_kho k on px.xuat_tu_kho_id = k.id
		join store_phieunhap_chitiet pnct on pxct.phieunhap_chitiet_id = pnct.id
	where px.xuat_tu_kho_id = @p_kho_id
		and (px.ngay_xuatkho between @p_ngay_batdau and @p_ngay_ketthuc)
        and pxct.sanpham_id in (68,69)
);
 select * from tmpNhapXuatTrongThang_PhieuXuat;

-- Left join dữ liệu Nhập trong tháng
CREATE TEMPORARY TABLE IF NOT EXISTS tmpNhapTrongThang AS (
	select pn.kho_id, pn.ten_kho, pn.sanpham_id, pn.ma_sanpham, pn.ten_sanpham
		, pn.dongianhap, pn.soluongnhap, pn.hansudung, pn.ten_nguoncungcap
		, px.dongiaxuat, px.soluongxuat
	from tmpNhapXuatTrongThang_PhieuNhap pn
		left join tmpNhapXuatTrongThang_PhieuXuat px on pn.kho_id = px.kho_id and pn.sanpham_id = px.sanpham_id
	where pn.sanpham_id in (68,69)
);

-- Right join dữ liệu Xuất trong tháng
CREATE TEMPORARY TABLE IF NOT EXISTS tmpXuatTrongThang AS (
	select px.kho_id, px.ten_kho, px.sanpham_id, px.ma_sanpham, px.ten_sanpham
		, px.dongianhap, px.soluongnhap, pn.hansudung, pn.ten_nguoncungcap
		, px.dongiaxuat, 0 as soluongxuat
	from tmpNhapXuatTrongThang_PhieuNhap pn
		right join tmpNhapXuatTrongThang_PhieuXuat px on pn.kho_id = px.kho_id and pn.sanpham_id = px.sanpham_id
	where pn.sanpham_id in (68,69)
);

 select * from tmpNhapTrongThang;
 select * from tmpXuatTrongThang;
 
select *
from (
	select tondauky.kho_id, tondauky.ten_kho, tondauky.sanpham_id, tondauky.ma_sanpham, tondauky.ten_sanpham, tondauky.dongianhap, tondauky.hansudung, tondauky.ten_nguoncungcap, tondauky.dongiaxuat
		soluongnhap
		, soluongxuat
	from (
		select * from tmpNhapTrongThang
		union all
		select * from tmpXuatTrongThang
		) as tondauky
	where tondauky.sanpham_id in (68,69)
	group by tondauky.kho_id, tondauky.ten_kho, tondauky.sanpham_id, tondauky.ma_sanpham, tondauky.ten_sanpham, tondauky.dongianhap, tondauky.hansudung, tondauky.ten_nguoncungcap, tondauky.dongiaxuat
) as a;


-- Dữ liệu Nhập xuất group theo từng sản phẩm
CREATE TEMPORARY TABLE IF NOT EXISTS tmpNhapXuatTrongThang AS (
	select tondauky.kho_id, tondauky.ten_kho, tondauky.sanpham_id, tondauky.ma_sanpham, tondauky.ten_sanpham, tondauky.dongianhap, tondauky.hansudung, tondauky.ten_nguoncungcap, tondauky.dongiaxuat
		, sum(soluongnhap) as tong_soluongnhap
		, sum(soluongxuat) as tong_soluongxuat
	from (
		select * from tmpNhapTrongThang
		union all
		select * from tmpXuatTrongThang
		) as tondauky
	where tondauky.sanpham_id in (68,69)
	group by tondauky.kho_id, tondauky.ten_kho, tondauky.sanpham_id, tondauky.ma_sanpham, tondauky.ten_sanpham, tondauky.dongianhap, tondauky.hansudung, tondauky.ten_nguoncungcap, tondauky.dongiaxuat
);
/* --- NHẬP XUẤT TỒN TRONG THỜI GIAN BÁO CÁO --- */

/* --- KẾT QUẢ --- */
 select * from tmpTonDauKy;	
 select * from tmpNhapXuatTrongThang;	

-- Join Tổng hợp Sản Phẩm có dữ liệu Tồn, Nhập/Xuất trong thời gian lập báo cáo
CREATE TEMPORARY TABLE IF NOT EXISTS tmpCacSanPhamPhatSinhTrongThoiGianBaoCao AS
(
	select distinct *
	from (
		select kho_id, ten_kho, sanpham_id, ma_sanpham, ten_sanpham, dongianhap, hansudung, ten_nguoncungcap from tmpTonDauKy
		union all
		select kho_id, ten_kho, sanpham_id, ma_sanpham, ten_sanpham, dongianhap, hansudung, ten_nguoncungcap from tmpNhapXuatTrongThang
	) as tmp
);
select * from tmpCacSanPhamPhatSinhTrongThoiGianBaoCao;

select spPhatSinh.*, dvt.ten_donvitinh,
	tonDauKy.tong_soluongnhap as tong_soluong_tondauky,
	nhapXuatTrongThang.tong_soluongnhap as tong_soluongnhap,
	nhapXuatTrongThang.tong_soluongxuat as tong_soluongxuat
from tmpCacSanPhamPhatSinhTrongThoiGianBaoCao as spPhatSinh
	left join tmpTonDauKy as tonDauKy on spPhatSinh.kho_id = tonDauKy.kho_id 
									and spPhatSinh.ten_kho = tonDauKy.ten_kho 
									and spPhatSinh.sanpham_id = tonDauKy.sanpham_id
									and spPhatSinh.ma_sanpham = tonDauKy.ma_sanpham
									and spPhatSinh.ten_sanpham = tonDauKy.ten_sanpham
									and spPhatSinh.dongianhap = tonDauKy.dongianhap
									and spPhatSinh.hansudung = tonDauKy.hansudung
                                    and spPhatSinh.ten_nguoncungcap = tonDauKy.ten_nguoncungcap
	left join tmpNhapXuatTrongThang as nhapXuatTrongThang on spPhatSinh.kho_id = nhapXuatTrongThang.kho_id 
									and spPhatSinh.ten_kho = nhapXuatTrongThang.ten_kho 
									and spPhatSinh.sanpham_id = nhapXuatTrongThang.sanpham_id
									and spPhatSinh.ma_sanpham = nhapXuatTrongThang.ma_sanpham
									and spPhatSinh.ten_sanpham = nhapXuatTrongThang.ten_sanpham
									and spPhatSinh.dongianhap = nhapXuatTrongThang.dongianhap
									and spPhatSinh.hansudung = nhapXuatTrongThang.hansudung
                                    and spPhatSinh.ten_nguoncungcap = nhapXuatTrongThang.ten_nguoncungcap
	join store_sanpham sp on spPhatSinh.sanpham_id = sp.id
	join store_donvitinh dvt on sp.donvitinh_id = dvt.id
    where spPhatSinh.sanpham_id in (68,69)
order by spPhatSinh.ten_sanpham;

/* --- END KẾT QUẢ --- */
DROP TEMPORARY TABLE tmpTonDauKy_PhieuNhap;
DROP TEMPORARY TABLE tmpTonDauKy_PhieuXuat;
DROP TEMPORARY TABLE tmpTonDauKy;
DROP TEMPORARY TABLE tmpNhapXuatTrongThang_PhieuNhap;
DROP TEMPORARY TABLE tmpNhapXuatTrongThang_PhieuXuat;
DROP TEMPORARY TABLE tmpNhapTrongThang;
DROP TEMPORARY TABLE tmpXuatTrongThang;
DROP TEMPORARY TABLE tmpNhapXuatTrongThang;
DROP TEMPORARY TABLE tmpCacSanPhamPhatSinhTrongThoiGianBaoCao;