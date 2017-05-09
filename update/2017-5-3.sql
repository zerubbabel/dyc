--
-- 表的结构 `cmf_dyc_data_tables`
-- 自定义报表时根据此表读取数据来源表
-- 可以添加，但cmf_dyc_spxg这张基础表一定有
--
CREATE TABLE `thinkcmf`.`cmf_dyc_data_tables` ( `id` INT NOT NULL AUTO_INCREMENT , `table_id` VARCHAR(50) NOT NULL , `table_name` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `cmf_dyc_data_tables` (`id`, `table_id`, `table_name`) VALUES (NULL, 'cmf_dyc_spxg', '店铺基础信息表');



INSERT INTO `cmf_menu` (`id`, `parentid`, `app`, `model`, `action`, `data`, `type`, `status`, `name`, `icon`, `remark`, `listorder`) VALUES (NULL, '193', 'Dyc', 'Report', 'index', '', '1', '1', '自定义报表管理', '', '', '0');
INSERT INTO `cmf_menu` (`id`, `parentid`, `app`, `model`, `action`, `data`, `type`, `status`, `name`, `icon`, `remark`, `listorder`) VALUES (NULL, '193', 'Dyc', 'Report', 'add', '', '1', '1', '添加报表', '', '', '0');
--
-- 表的结构 `cmf_dyc_report`
--

CREATE TABLE `cmf_dyc_report` (
  `id` int(11) NOT NULL,
  `report_name` varchar(200) NOT NULL,
  `report_sql` text NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cmf_dyc_report`
--
ALTER TABLE `cmf_dyc_report`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cmf_dyc_report`
--
ALTER TABLE `cmf_dyc_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
ALTER TABLE `cmf_dyc_report` ADD `status` BOOLEAN NOT NULL DEFAULT TRUE AFTER `create_time`;
ALTER TABLE `cmf_dyc_report` CHANGE `report_sql` `report_sql` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;