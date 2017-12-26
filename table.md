
##### 用户

	create table jie_user(
		uid varchar(64) not null unique primary key comment '用户id',
		username varchar(20) not null unique comment '用户名',
		password char(32) not null comment '密码',
		salt varchar(64) not null comment '盐值',
		email varchar(50) not null unique comment '邮箱',
		mobile varchar(15) not null unique comment '手机号码',
		gender enum('男','女','保密') not null default '保密' comment '性别',
		name varchar(20) not null unique comment '真实姓名',
		nickname varchar(50) not null unique comment '昵称',
		ip varchar(20) not null comment '登录ip',
		create_time datetime not null comment '创建时间',
		login_time datetime not null comment '登录时间',
		status tinyint unsigned not null default 1 comment '状态',
		remark varchar(200) comment '记录'
	)



	create table jie_user_address(
		id int unsigned not null unique primary key auto_increment comment '地址id',
		consignee varchar(20) not null comment '收件人', 
		phone varchar(15) not null comment '手机号码',
		tell varchar(15) comment '座机号码',
		zipcode varchar(10) comment '邮政编码',
		province int unsigned not null comment '省份\直辖市',
		city int unsigned not null comment '市',
		district int unsigned not null comment '区\县',
		address varchar(100) not null comment '详细地址',
		uid varchar(64) not null comment '用户id',
		foreign key (uid) references jie_user(uid)
	)


	insert into jie_user (uid,username,password,salt,email,mobile,gender,name,nickname,ip,create_time,login_time,status,remark)
	values 
	(uuid(),'papi','123456','ddd','papi@sohu.com','13888888888','女','江逸尘','papi酱','127.0.0.1','2017-12-24 04:00:00','2017-12-24 04:00:00',1,null)

	
	insert into jie_user_address (consignee,phone,tell,zipcode,province,city,district,address,uid)
	values 
	('刘小背','13877777777',null,null,2,3,3,'浦江大道新东方花园',(select uid from jie_user where name = '江逸尘'))



##### 文章

	create table jie_article(
		id varchar(64) not null unique primary key comment '文章id',
		title varchar(25) not null unique comment '文章标题',
		keywords varchar(50) not null default '街' comment '关键字',
		author varchar(20) not null default '街' comment '作者',
		views int unsigned not null default 188 comment '浏览量',
		source_pic varchar(100) comment '源图',
		small_pic varchar(100) comment '小图',
		contents text not null comment '文章内容',
		channel_id int unsigned not null comment '文章栏目',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态',
		is_hot tinyint unsigned not null default 1 comment '是/否 热门',
		create_time datetime not null comment '创建时间',
		update_time datetime not null comment '更新时间',
		foreign key (channel_id) references jie_article_channel (id)
	)


	create table jie_article_channel(
		id int unsigned not null unique primary key auto_increment comment '文章栏目id',
		name varchar(20) not null unique comment '文章栏目',
		pid int unsigned not null default 0 comment '文章id父级id',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态',
		sort smallint unsigned not null default '100' comment '排序'
	)
	
##### 广告

	create table jie_advertisement(
		id varchar(64) not null unique primary key comment '广告id',
		name varchar(25) not null unique comment '广告名称',
		ad_img varchar(100) comment '广告图',
		ad_url varchar(255) comment '广告链接',
		ad_code text not null comment '广告代码',
		channel_id int unsigned not null comment '文章栏目',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态',
		is_hot tinyint unsigned not null default 1 comment '是/否 热门',
		start_time datetime not null comment '开始时间',
		end_time datetime not null comment '结束时间',
		create_time datetime not null comment '创建时间',
		update_time datetime not null comment '更新时间',
		foreign key (channel_id) references jie_ad_channel (id)
	)


	create table jie_ad_channel(
		id int unsigned not null unique primary key auto_increment comment '广告栏目id',
		name varchar(20) not null unique comment '广告栏目',
		pid int unsigned not null default 0 comment '广告id父级id',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态',
		sort smallint unsigned not null default '100' comment '排序'
	)

##### 品牌

	create table jie_brand(
		id int unsigned not null unique primary key auto_increment comment '品牌id',
		brand_name varchar(20) not null unique comment '品牌名称',
		note varchar(200) comment '描述',
		logo varchar(100) comment '品牌图',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态',
		url varchar(255) comment '品牌链接',
		sort int unsigned not null default '100' comment '排序'
	)

##### 类型

	create table jie_goods_type(
		type_id int unsigned not null unique primary key auto_increment comment '类型id',
		type_name varchar(20) not null unique comment '类型名称',
		type_category varchar(255) comment '类型分类',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态',
		sort int unsigned not null default 50 comment '排序'
	)

##### 属性

	create table jie_goods_attr(
		attr_id int unsigned not null unique primary key auto_increment comment '类型属性id',
		attr_name varchar(20) not null unique comment '类型属性名称',
		attr_may_value text comment '类型属性可选值',
		attr_type tinyint unsigned not null default 0 comment '类型参数(0：参数，1：规格)',
		attr_group_id smallint unsigned not null default 0 comment '未知',
		sort int unsigned not null default '50' comment '排序',
		type_id  int unsigned not null comment '类型id',
		foreign key (type_id) references jie_goods_type(type_id)
	)

##### 分类

	create table jie_category(
		id int unsigned not null unique primary key auto_increment comment '分类id',
		category_name varchar(20) not null unique comment '分类名称',
		keywords varchar(50) not null comment '关键词',
		descption varchar(100) not null comment '描述',
		pid int unsigned not null comment '分类父级id',
		goods_type_id int unsigned not null comment '类型',
		filter_attr varchar(100) not null comment '筛选属性',
		is_nav tinyint unsigned not null default 0 comment '是/否 导航',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态',
		sort int unsigned not null default '50' comment '排序'
	)

##### 商品包

	create table jie_goods_pack(
		pack_id int unsigned not null unique primary key auto_increment comment '商品包id',
		pack_name varchar(40) not null unique comment '商品包名称',
		pid int unsigned not null default 0 comment '商品包父级id',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态',
		sort int unsigned not null default 50 comment '排序'
	)

	create table jie_goods_pack_attr(
		id int unsigned not null unique primary key auto_increment comment '商品包属性id',
		attr_name varchar(20) not null unique comment '商品包属性名称',
		attr_values text comment '属性值',
		attr_type tinyint unsigned not null default 0 comment '属性参数(0：参数，1：规格)',
		attr_radio tinyint unsigned not null default 2 comment '属性是否可选(1:唯一属性;2:单选属性;3:复选属性)',
		attr_input_type tinyint unsigned not null default 2 comment '属性值录入方式',
		attr_group_id tinyint unsigned not null default 0 comment '未知',
		pack_id int unsigned not null comment '商品包id',
		sort int unsigned not null default '50' comment '排序',
		foreign key (pack_id) references jie_goods_pack(pack_id)
	)
	
##### 商品

	create table jie_goods(
		goods_id varchar(64) not null unique primary key comment '商品id',
		goods_sn int unsigned not null unique comment '商品编号', 
		goods_name varchar(50) not null unique comment '商品名称',
		promote_word varchar(100) not null comment '促销词',
		keywords varchar(60) not null comment '关键词',
		description varchar(150) comment '描述',
		contents text not null comment '商品内容',
		goods_icon varchar(50) comment '活动图标',
		brand_id int unsigned not null comment '品牌',
		category_id int unsigned not null comment '分类',
		type_id int unsigned not null comment '类型',
		pack_id int unsigned not null comment '商品包',
		pack_attr varchar(255) not null comment '商品包属性',
		goods_color tinyint unsigned not null comment '颜色',
		goods_volume tinyint unsigned not null comment '容量',
		shop_id varchar(64) not null default '000000' comment '商户',
		market_price decimal(10,2) unsigned not null comment '市场价',
		goods_price decimal(10,2) unsigned not null comment '商品价',
		is_promote tinyint unsigned not null default 0 comment '促销',
		promote_price decimal(10,2) unsigned not null comment '促销价',
		promote_stime datetime not null comment '促销开始时间',
		promote_etime datetime not null comment '促销结束时间',
		is_on_sale tinyint unsigned not null default 0 comment '上架',
		is_first tinyint unsigned not null default 0 comment '首发',
		is_hot tinyint unsigned not null default 0 comment '热卖',
		is_activity tinyint unsigned not null default 0 comment '是/否  活动，默认不支持，支持的话，详情不可访问',
		activity_price decimal(10,2) unsigned not null comment '活动价',
		activity_stime datetime not null comment '活动开始时间',
		activity_etime datetime not null comment '活动结束时间',
		sku int unsigned not null default 0 comment '库存',
		limit_num int unsigned not null default 99999 comment '限制购买数量、默认不限制',
		unit enum('件','箱') not null default '件' comment '单位',
		views int unsigned not null default 188 comment '浏览数',
		concerns int unsigned not null default 0 comment '关注数',
		samll_pic varchar(100) not null comment '小图',
		medium_pic varchar(100) not null comment '中图',
		create_time datetime not null comment '创建时间',
		update_time datetime not null comment '更新时间'
	)

	create table jie_goods_attr_list(
		attr_list_id int unsigned not null unique primary key comment '商品属性列表id',
		attr_value varchar(100) not null comment '商品属性列表值',
		goods_sn int unsigned not null comment '商品编号',
		goods_attr_id int unsigned not null comment '商品属性id',
		foreign key (goods_sn) references jie_goods(goods_sn)
	)


#### 图片库

	create table jie_goods_gallery(
		gallery_id int unsigned not null unique primary key comment '商品画廊id',
		gallery_name varchar(10) not null comment '颜色名称',
		samll_pic varchar(100) not null comment '小图',
		medium_pic varchar(100) not null comment '中图',
		source_pic varchar(100) not null comment '中图',
		goods_sn int unsigned not null comment '商品编号',
		foreign key (goods_sn) references jie_goods(goods_sn)
	)

#### 热词

	create table jie_search(
		id int unsigned not null unique primary key auto_increment comment '热词id',
		goods_sn  int unsigned not null comment '商品编号',
		name varchar(20) not null unique comment '热词名称',
		url varchar(100) not null comment '热词链接',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态'
	)



	
##### 管理人员 权限表

	create table jie_admin(
	id int unsigned not null unique primary key auto_increment comment '系统id',
	role_id int unsigned not null comment '角色',
	name varchar(20) not null unique comment '系统用户',
	password char(32) not null comment '密码',
	salt varchar(64) not null comment '盐值',
	email varchar(50) not null unique comment '邮箱',
	mobile varchar(15) not null unique comment '手机号码',
	ip varchar(20) not null comment '登录ip',
	is_super tinyint unsigned not null comment '是/否 超级管理者',
	status tinyint unsigned not null default 1 comment '开启/关闭 状态',
	create_time datetime not null comment '创建时间',
	login_time datetime not null comment '登录时间'
	)

	create table jie_role(
	role_id int unsigned not null unique primary key auto_increment comment '角色id',
	name varchar(20) not null unique comment '角色名称',
	description varchar(100) not null comment '角色职责描述',
	status tinyint unsigned not null default 1 comment '开启/关闭 状态'
	)
	
	create table jie_access(
	role_id int unsigned not null comment '角色id',
	permission_id int unsigned not null comment '权限id'
	)
	
	create table jie_permission(
	permission_id int unsigned not null unique primary key auto_increment comment '权限id',
	permission_name varchar(32) not null unique comment '权限名称',
	pid int unsigned not null comment '权限父id',
	code varchar(100) comment '权限标识',
	url varchar(100) comment '权限链接',
	level tinyint unsigned not null comment '权限级别',
	is_common tinyint unsigned not null default 0 comment '开启/关闭 常用',
	status tinyint unsigned not null default 1 comment '开启/关闭 状态',
	sort tinyint unsigned not null default 1 comment '排序',
	)


##### 

	



