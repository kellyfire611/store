-- drop table
delete from store_phieuxuat_chitiet;
delete from store_phieuxuat;
delete from store_phieunhap_chitiet;
delete from store_phieunhap;
delete from store_sanpham;
delete from store_donvi;

ALTER TABLE store_phieuxuat_chitiet AUTO_INCREMENT = 1;
ALTER TABLE store_phieuxuat AUTO_INCREMENT = 1;
ALTER TABLE store_phieunhap_chitiet AUTO_INCREMENT = 1;
ALTER TABLE store_phieunhap AUTO_INCREMENT = 1;
ALTER TABLE store_sanpham AUTO_INCREMENT = 1;
ALTER TABLE store_donvi AUTO_INCREMENT = 1;