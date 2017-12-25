
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
		id varchar(64) not null unique primary key comment '品牌id',
		name varchar(20) not null unique comment '品牌名称',
		note varchar(200) comment '描述',
		logo varchar(100) comment '品牌图',
		status tinyint unsigned not null default 1 comment '开启/关闭 状态',
		url varchar(255) comment '品牌链接',
		sort int unsigned not null default '100' comment '排序'
	)


##### 管理人员

create table jie_admin(
	id int unsigned not null unique primary key auto_increment comment '系统id',
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


##### 管理人员




