-- Clear dữ liệu nhập xuất
update store_phieunhap set phieuxuat_id = NULL;
delete from store_phieuxuat_chitiet; ALTER TABLE `store_phieuxuat_chitiet` AUTO_INCREMENT=1;
delete from store_phieuxuat; ALTER TABLE `store_phieuxuat` AUTO_INCREMENT=1;
delete from store_phieunhap_chitiet; ALTER TABLE `store_phieunhap_chitiet` AUTO_INCREMENT=1;
delete from store_phieunhap; ALTER TABLE `store_phieunhap` AUTO_INCREMENT=1;

-- Clear dữ liệu danh mục sản phẩm
delete from store_sanpham_nhom_loai_rel; ALTER TABLE `store_sanpham_nhom_loai_rel` AUTO_INCREMENT=1;
delete from store_sanpham_nhom; ALTER TABLE `store_sanpham_nhom` AUTO_INCREMENT=1;
delete from store_sanpham; ALTER TABLE `store_sanpham` AUTO_INCREMENT=1;