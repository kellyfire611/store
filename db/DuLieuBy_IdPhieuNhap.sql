select k.ten_kho
	, sp.ma_sanpham, sp.ten_sanpham
	, pnct.soluongnhap, pnct.dongianhap
from store_phieunhap_chitiet pnct
	join store_phieunhap pn on pnct.phieunhap_id = pn.id
	join store_sanpham sp on pnct.sanpham_id = sp.id
	join store_kho k on pn.nhap_vao_kho_id = k.id