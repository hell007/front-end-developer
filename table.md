

1.user

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

	insert into jie_user (uid,username,password,salt,email,mobile,gender,name,nickname,ip,create_time,login_time,status,remark)
		values 
		(uuid(),'pi','123456','ddd','pi@sohu.com','13877777777','男','范逸尘','pi酱','127.0.0.1','2017-12-24 04:00:00','2017-12-24 04:00:00',1,null)
	
	
	insert into jie_user_address (consignee,phone,tell,zipcode,province,city,district,address,uid)
	values 
	('刘小背','13877777777',null,null,2,3,3,'浦江大道新东方花园',(select uid from jie_user where name = '江逸尘'))

	insert into jie_user_address (consignee,phone,tell,zipcode,province,city,district,address,uid)
		values 
		('关大玉','13876677777',null,null,2,3,3,'浦江大道新东方花园',(select uid from jie_user where name = '范逸尘'))






2.

create table admin (
	id int unsigned not null unique primary key auto_increment
)
