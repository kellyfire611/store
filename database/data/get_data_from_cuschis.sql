    select 
	'[ '
	+ '''id'' => ''' + CAST(ROW_NUMBER() OVER (ORDER BY [IdDmQuocGia]) as VARCHAR) + ''''
	+ ', ''ma_quocgia'' => ''' + ISNULL(maquocgia, '') + ''''
	+ ', ''ten_donvitinh'' => ''' + ISNULL(tenquocgia, '') + ''''
	+ ', ''ten_quocgia'' => ' + '$now' + ''
	+ '],'
  from [HIS_TAMTHAN].[dbo].[DmQuocGia]


-- List all column
SET SESSION group_concat_max_len = 1000000;

SELECT CONCAT('''', table_name, '''', ' => [', column_comment, '],')
FROM (
SELECT table_name, CONCAT(GROUP_CONCAT(CONCAT('''', column_name, '''', ' => ', IF(column_comment IS NULL OR column_comment = '', concat('''', column_name, ''''), concat('''', column_comment, '''')))), ',') AS column_comment
FROM information_schema.columns
WHERE table_schema = 'aigf2bdf_store'
	-- order by table_name,ordinal_position
GROUP BY table_name) AS a
	
-- Fillale
SET SESSION group_concat_max_len = 1000000;

SELECT CONCAT('''', table_name, '''', ' => [', column_comment, '],')
FROM (
SELECT table_name, GROUP_CONCAT(CONCAT('''', column_name, '''')) AS column_comment
FROM information_schema.columns
WHERE table_schema = 'aigf2bdf_store'
	AND table_name = 'store_phieunhap_chitiet'
	-- order by table_name,ordinal_position
GROUP BY table_name) AS a
	
	
	
	
	
	