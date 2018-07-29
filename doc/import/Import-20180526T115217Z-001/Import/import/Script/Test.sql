set @p_ngay_batdau = '2017-01-01';
set @p_ngay_ketthuc = '2017-12-31';
set @p_kho_id = 1;

-- select * from store_nhapxuat;

/* --- NHẬP XUẤT TRONG THỜI GIAN BÁO CÁO --- */
-- Nhập
-- Sản phẩm nào, nhập vào kho nào, loại nhập là gì?
CREATE TEMPORARY TABLE IF NOT EXISTS tmpNhapXuatTrongThang_PhieuNhap AS (
	select dataNXTT_PN.phieunhap_chitiet_id, dataNXTT_PN.kho_id, dataNXTT_PN.sanpham_id, dataNXTT_PN.dongianhap
		, SUM(CASE WHEN dataNXTT_PN.nhapxuat_id = 45 THEN dataNXTT_PN.soluongnhap ELSE 0 END) as nhapxuat_id_45
		, SUM(CASE WHEN dataNXTT_PN.nhapxuat_id = 14 THEN dataNXTT_PN.soluongnhap ELSE 0 END) as nhapxuat_id_14
	from (
		select pnct.id as phieunhap_chitiet_id
			, pnct.nhap_vao_kho_id as kho_id
			, pnct.sanpham_id as sanpham_id
			, pnct.dongianhap as dongianhap, pnct.soluongnhap as soluongnhap
			-- , pnct.dongianhap dongiaxuat, 0 as soluongxuat
			, pnct.nhapxuat_id
		from store_phieunhap_chitiet pnct
			join store_phieunhap pn on pnct.phieunhap_id = pn.id	
		where pn.nhap_vao_kho_id = @p_kho_id
			 and (pn.ngay_nhapkho between @p_ngay_batdau and @p_ngay_ketthuc)
	) as dataNXTT_PN
    group by dataNXTT_PN.phieunhap_chitiet_id, dataNXTT_PN.kho_id, dataNXTT_PN.sanpham_id, dataNXTT_PN.dongianhap
);
-- select * from tmpNhapXuatTrongThang_PhieuNhap;

-- Xuất
CREATE TEMPORARY TABLE IF NOT EXISTS tmpNhapXuatTrongThang_PhieuXuat AS (
	select dataNXTT_PX.phieunhap_chitiet_id, dataNXTT_PX.kho_id, dataNXTT_PX.sanpham_id, dataNXTT_PX.dongiaxuat
		, SUM(CASE WHEN dataNXTT_PX.nhapxuat_id = 28 THEN dataNXTT_PX.soluongxuat ELSE 0 END) as nhapxuat_id_28
		, SUM(CASE WHEN dataNXTT_PX.nhapxuat_id = 9 THEN dataNXTT_PX.soluongxuat ELSE 0 END) as nhapxuat_id_9
	from (
		select pxct.phieunhap_chitiet_id as phieunhap_chitiet_id 
			, pxct.xuat_tu_kho_id as kho_id
			, pxct.sanpham_id as sanpham_id
			, pxct.dongiaxuat, pxct.soluongxuat
			, pxct.nhapxuat_id
		from store_phieuxuat_chitiet pxct
			join store_phieuxuat px on pxct.phieuxuat_id = px.id
		where px.xuat_tu_kho_id = @p_kho_id
			and (px.ngay_xuatkho between @p_ngay_batdau and @p_ngay_ketthuc)
	) as dataNXTT_PX
    group by dataNXTT_PX.phieunhap_chitiet_id, dataNXTT_PX.kho_id, dataNXTT_PX.sanpham_id, dataNXTT_PX.dongiaxuat
);
-- select * from tmpNhapXuatTrongThang_PhieuXuat;

-- Full key Nhập + Xuất
CREATE TEMPORARY TABLE IF NOT EXISTS tmpNhapXuatTrongThang_dataKey AS (
	select distinct *
		from (
			select pn.phieunhap_chitiet_id, pn.kho_id, pn.sanpham_id from tmpNhapXuatTrongThang_PhieuNhap as pn
			union
			select px.phieunhap_chitiet_id, px.kho_id, px.sanpham_id from tmpNhapXuatTrongThang_PhieuXuat as px
		) as t
);

CREATE TEMPORARY TABLE IF NOT EXISTS tmpNhapXuatTrongThang AS (
	select datakey.*
		, pn.dongianhap
		, px.dongiaxuat
		, pn.nhapxuat_id_45, pn.nhapxuat_id_14
		, px.nhapxuat_id_28, px.nhapxuat_id_9
	from tmpNhapXuatTrongThang_dataKey as datakey
	left join tmpNhapXuatTrongThang_PhieuNhap as pn on datakey.phieunhap_chitiet_id = pn.phieunhap_chitiet_id and datakey.kho_id = pn.kho_id and datakey.sanpham_id = pn.sanpham_id    
	left join tmpNhapXuatTrongThang_PhieuXuat as px on datakey.phieunhap_chitiet_id = px.phieunhap_chitiet_id and datakey.kho_id = px.kho_id and datakey.sanpham_id = px.sanpham_id
);

select * 
from tmpNhapXuatTrongThang dataNXTT
join store_sanpham sp on dataNXTT.sanpham_id = sp.id
join store_phieunhap_chitiet pnct on dataNXTT.phieunhap_chitiet_id = pnct.id;
/* ./.--- NHẬP XUẤT TRONG THỜI GIAN BÁO CÁO --- */


-----
DROP TEMPORARY TABLE tmpNhapXuatTrongThang_PhieuNhap;
DROP TEMPORARY TABLE tmpNhapXuatTrongThang_PhieuXuat;
DROP TEMPORARY TABLE tmpNhapXuatTrongThang;
