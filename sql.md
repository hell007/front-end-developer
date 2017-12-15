
## 创建表

	CREATE TABLE T_DEPARTMENT (
		FID VARCHAR(20),
		FNAME VARCHAR(20),
		FLEVEL INT,
		PRIMARY KEY (FId)
	)

	CREATE TABLE T_EMP (
		FNUMBER VARCHAR(20),
		FNAME VARCHAR(20),
		FDEPARTMENTID VARCHAR(20),
		PRIMARY KEY(FNUMBER),
		FOREGIN KEY(DEPARTMENTID) REFRRENCES T_DEPARTMENT(FID)
	)


## ADD FEILD

	ALTER TABLE T_EMP ADD FAGE INT
	
	ALTER TABLE T_EMP ADD FSEX CHAR(2)


## DROP FEILD

	ALTER TABLE T_EMP DROP FAGE
	
	ALTER TABLE T_EMP DROP FSEX


## DROP TABLE

	DROP TABLE T_EMP


## MYSQL

	CREATE TABLE T_PERSON(
		FNAME VARCHAR(20)
		FAGE INT,
		FREMARK VARCHAR(20),
		PRIMARY KEY(FNAME)
	)
	
	CREATE TABLE T_DEBT(
		FNUMBER VARCHAR(20),
		FAMOUNT DECIMAL(10,2) NOT NULL,
		FPERSON VARCHANR(20),
		PRIMARY KEY(FNUMBER),
		FOREGIN KEY(FPERSON) REFERENCES T_PERSON(FNAME)
	)


## Oracle

	CREATE TABLE T_PERSON(
		FNAME VARCHAR2(20),
		FAGE NUMBER(10),
		FREMARK VARCHAR2(20),
		PRIMARY KEY(FNAME)
	)
	
	CREATE TABLE T_DEBT(
		FNUMBER VARCHAR2(20),
		FAMOUNT NUMERIC(10,2) NOT NULL,
		FPERSON VARCHAR2(20),
		PRIMARY KEY(FNUMBER),
		FOREGIN KEY(FPERSON) REFERENCES T_PERSON(FNAME)
	)


## INSERT

	INSERT INTO T_PERSON (FNAME,FAGE,FREMARK) VALUES ('KD',28,'USA')

	INSERT INTO T_DEBT (FNUMBER,FAMOUNMT,FPERSON,FPERSON) VALUES ('1000',2000.00,'KD')


## UPDATE

	UPDATE T_PERSON SET FREMARK = 'SUPERMAN'

	UPDATE T_PERSON SET FAGE = 22, FNAME = 'TOM' WHRER ...


## SELECT

	SELECT FNUMBER AS NUMBER,FNAME AS NAME,FAGE AS AGE,FSALARY AS SALARY FROM T_EMP 

	SELECT FNUMBER NUMBER,FNAME NAME,FAGE AGE,FSALARY SALARY FORM T_EMP


## MAX

	SELECT MAX(FSALARY) FROM T_EMP WHERE FAGE > 25

	SELECT MAX(FSALARY) AS MAX_SALARY FROM T_EMP WHERE FAGE >25


## AVG

	SELECT AVG(FAGE) FROM T_EMP WHERE FSALARY > 3800


## SUM

	SELECT SUM(FSALARY) FORM T_EMP


## MIN MAX

	SELECT MIN(FSALARY),MAX(FSALARY) FROM T_EMP


## COUNT

	SELECT COUNT(*),COUNT(FNUMBER) FROM T_EMP
	
	COUNT(FNAME) FNAME === NULL 条数不计人


## ORDER BY

	SELECT * FROM T_EMP ORDER BY FAGE ASC //升
	
	== SELECT * FROM T_EMP ORDER BY FAGE (可省略)
	
	SELECT * FROM T_EMP ORDER BY FAGE DESC //降
	
	
	SELECT * FROM T_EMP ORDER BY FAGE DESC,FSALARY DESC //多条件


## 通配符过滤 LIKE

1、单字符匹配 "_"

	SELECT * FROM T_EMP WHERE FNAME LIKE '_erry' //(匹配第一个字符为any的 erry )
	
	//Jerry 
	//Kerry

2、多字符匹配 "%"

	"b%"   b开头
	"%t"   t结尾
	"b%t"  b开头t结尾
	"%n%"  含有n
	"%n_"  最后一个字符为任意字符、倒数第二个字符为“n”、长度任意的字符串

3、集合匹配 "[]" (集合匹配只在 MSSQLServer 上提供支持，在 MYSQL、Oracle、DB2 等数据库中不支持)

	"[bt]%"  匹配第一个字符为 b 或者 t 长度不限的字符串
	
	"[^bt]%" 匹配第一个字符不为 b 或者 t、长度不限的字符串


MYSQL、Oracle、DB2 变向实现集合匹配

	"[bt]%"  ===  SELECT * FROM T_EMP WHERE FNAME LIKE 'b%' OR FNAME LIKE 't%'
	
	"[^bt]%" ===  SELECT * FROM T_EMP WHERE NOT(FNAME LIKE 'b%') AND NOT(FNAME LIKE 't%')

非常强大的功能，不过在使用通配符过滤进行检索的时候，数据库系统
会对全表进行扫描，所以执行速度非常慢,慎用


## 空值检测  

	SELECT * FROM T_EMP WHERE FNAME IS NULL
	
	SELECT * FROM T_EMP WHERE FNAME IS NOT NULL
	
	SELECT * FROM T_EMP WHERE FNAME IS NOT NULL AND FSALARY < 5000


## 反义运算符

!>   !<  ...

	SELECT * FROM T_EMP WHERE FAGE <> 22 AND FSALARY >= 2000


## 多值检测 IN

	SELECT FAGE,FNUMBER,FNAME FROM T_EMP WHERE FAGE=23 OR FAGE = 25

IN

	SELECT FAGE,FNUMBER,FNAME FROM T_EMP WHERE FAGE IN (23,25)


## 范围值检测  BETWEEN ... AND ...

IN 

	WHERE FAGE>=23 AND FAGE <=27
	
	SELECT * FROM T_EMP WHERE FAGE BETWEEN 23 AND 27


## 低效的 "WHERE 1=1"

	SELECT * FROM T_EMP WHERE 1=1 
	AND FNUMBER BETWEEN 'DEV001' AND 'DEV008'
	AND FSALARY BETWEEN 3000 AND 6000

注意点：因为使用添加了“1=1”的过滤条件以后数据库系统就无法使用索引等查询优化策略，
数据库系统将会被迫对每行数据进行扫描（也就是全表扫描）以比较此行是否满足过滤条件，
当表中数据量比较大的时候查询速度会非常慢


## 数据分组 GROUP BY （统计field /统计列）


统计每个分公司的年龄段的人数

	SELECT FSUBCOMPANY,FAGE,COUNT(*) AS PCOUNTS FROM T_EMP
	GROUP BY FSUBCOMPANY,FAGE

	SELECT FSUBCOMPANY,FAGE,COUNT(*) AS PCOUNTS FROM T_EMP
	GROUP BY FSUBXOMPANY,FAGE
	ORDER BY FSUBCOMPANY

统计每个公司中的工资的总值

	SELECT FSUBCOMPANY,SUM(FSALARY) AS FSALARYSUM FROM T_EMP
	GROUP BY FSUBCOMPANY

统计每个垂直部门中的工资的平均值

	SELECT FDEPARTMENT,AVG(FSALARY) AS FSALARYAVG FROM T_EMP
	GROUP BY FDEPARTMENT

统计每个垂直部门中员工年龄的最大值和最小值

	SELECT FDEPARTMENT,MAX(FAGE) AS FAGEMAX,MIN(FAGE) AS FAGEMIN FROM T_EMP
	GROUP BY FDEPARTMENT


##  HAVING 

	SELECT FAge,COUNT(*) AS CountOfThisAge FROM T_Employee
	GROUP BY FAge
	WHERE COUNT(*)>1 //报错

	SELECT FAGE,COUNT(*) AS FACOUNTS FROM T_EMP
	GROUP BY FAGE
	HAVING COUNT(*) =1 


	SELECT FAGE,COUNT(*) AS FACOUNTS FROM T_EMP
	GROUP BY FAGE
	HAVING COUNT(*) =1 OR COUNT(*) =3

	SELECT FAGE,COUNT(*) AS FACOUNTS FROM T_EMP
	GROUP BY FAGE 
	HAVING COUNT(*) IN (1,3)

	SELECT FAGE,COUNT(*) AS FACOUNTS FROM T_EMP
	GROUP BY FAGE  //通过FAGE分组
	HAVING FNAME IS NOT NULL //报错  注意：HAVING语句中不能包含未分组的列名

	SELECT FAGE,COUNT(*) AS FCOUNTS FROM T_EMP
	WHERE FNAME IS NOT NULL  //未分组的列名使用WHERE
	GROUP BY FAGE

HAVING  VS  WHERE

是否使用未分组的列名（ group by 列名 ）


## 限制结果集行数 

MYSQL  LIMIT

	SELECT * FROM T_EMP ORDER BY FSALARY DESC LIMIT 2,5

ORACLE  rownum  （这里需要学习下oracle）

	SELECT * FROM T_EMP 
	WHERE rownum <=6 
	ORDER BY FSALARY DESC

	SELECT rownum,FNumber,FName,FSalary,FAge FROM T_Employee
	WHERE rownum BETWEEN 3 AND 5
	ORDER BY FSalary DESC //报错


实现数据库分页


## 抑制数据重复

注意：DISTINCT关键字是用来进行重复数据抑制的最简单的功能，而且所有的数据库系统都支持DISTINCT

	SELECT DISTINCT FDEPARTMENT FROM T_EMP

注意：DISTINCT是对整个结果集进行数据重复抑制的，而不是针对每一个列，执行下面的SQL语句

	SELECT DISTINCT FDEPARTMENT,FSUBCOMPANY FROM T_EMP


##  计算字段

1.常量字段

	SELECT 'CowNew集团',918000000,FNAME,FAGE,FSUBCOMPANY FROM T_EMP

'CowNew集团'和918000000并不是一个实际的存在的列，但是在查询出来的数据
中它们看起来是一个实际存在的字段，这样的字段被称为“常量字段”（也称为“常量值”

	SELECT 'CowNew 集 团' AS COMPANYNAME, 918000000 AS REGAMOUNT,FNAME,FSUBCOMPANY FROM T_EMP

2.字段间计算

	SELECT FNUMBER,FNAME,FAGE * FSALARY AS FSALARYINDEX FROM T_EMP
	
	SELECT 125+521,FNUMBER,FNAME,FSALARY/(FAGE-21) AS FHAPPYINDEX FROM T_EMP
	
	SELECT * FROM T_EMP WHERE FSALARY/(FAGE-21) > 1000


## 数据处理函数 参看函数第五章

#### 数学函数



#### 字符串函数

1.计算字符串长度的函数

MYSQL、Oracle、DB2中这个函数名称为LENGTH;   MSSQLServer中 LEN

	SELECT FNAME,LENGTH(FNAME) AS NAMELENGTH FROM T_EMP WHERE FNAME IS NOT NULL

2.取得字符串的子串的函数

接受三个参数，
第一个参数为要取的主字符串，
第二个参数为字串的起始位置（从1开始计数），
第三个参数为字串的长度

>MYSQL、MSSQLServer中这个函数名称为SUBSTRING

	SELECT FNAME,SUBSTRING(FNAME,2,3) FROM T_EMP WHERE FNAME IS NOT NULL

>Oracle、DB2这个函数名称为SUBSTR

	SELECT FNAME,SUBSTR(FNMAE,2,3)FROM T_EMP WHERE FNAME IS NOT NULL

3.计算正弦函数值的函数SIN  计算绝对值的函数ABS，它们都接受一个数值类型的参

	SELECT FNAME,FAGE,SIN(FAGE),ABS(SIN(FAGE)) FROM T_EMP


#### 日期函数




## 字符串的拼接

	SELECT '12'+'33',FAGE+'1' FROM T_EMP

> MYSQL

在MYSQL中,当用加号"+"连接两个字段（或者多个字段）的时候,
MYSQL会尝试将字段值转换为数字类型（如果转换失败则认为字段值为0），然后进行字段的加法运算

1.在MYSQL中进行字符串的拼接要使用CONCAT函数,CONCAT函数支持一个或者多个参数，
参数类型可以为字符串类型也可以是非字符串类型,
CONCAT函数会将所有参数按照参数的顺序拼接成一个字符串做为返回值

	SELECT CONCAT('工号为:',FNUMBER,'的员工的幸福指数:',FSALARY/(FAGE-21)) FROM T_EMP

2.CONCAT_WS可以在待拼接的字符串之间加入指定的分隔符，它的第一个参
数值为采用的分隔符，而剩下的参数则为待拼接的字符串值

	SELECT CONCAT_WS(','FNUMBER,FAGE,FDEPARTMENT,FSALARY) FROM T_EMP


> ORACLE

Oracle中使用"||"进行字符串拼接

	SELECT '工号为'||FNUMBER||'的员工姓名为'||FNAME FROM T_EMP WHERE FNAME IS NOT NULL

Oracle还支持使用CONCAT()函数进行字符串拼接

	SELECT CONCAT('年龄',FAGE) FROM T_EMP


注意点：与MYSQL的CONCAT()函数不同，Oracle的CONCAT()函数只支持两个参数，不支持两
个以上字符串的拼接


## 联合结果集

1.UNION可以连接多个结果集，就像"+"可以连接多个数字一样简单，只要在每个结果集之间加入UNION即可

	SELECT FNUMBER,FNAME,FAGE FROM T_EMP 
	UNION 
	SLECT FIDCARDNUMBER,FNAME,FAGE FROM T_EMP2


> 原则

一是每个结果集必须有相同的列数

	SELECT FNUMBER,FNAME,FAGE,FDEPARTMENT FROM T_EMP
	UNION
	SELECT FIDCARDNUMBER,FNAME,FAGE FROM T_EMP2 //报错

//解决方案  ==> 常量补充不足列

二是每个结果集的列必须类型相容（数据类型必须相同或者能够转换为同一种数据类型）


2. 如果需要在联合结果集中返回所有的记录而不管它们是否唯一，则需要在UNION运算符后使用ALL操作符

	SELECT FNAME,FAGE FROM T_EMP
	UNION ALL
	SELECT FNAME,FAGE FROM T_EMP2

应用：报表

	SELECT FNUMBER,FASALRY FROM T_EMP
	UNION
	SELECT '工资合计',SUM(FSALARY) FROM T_EMP


>注意：
mysql

	SELECT '以下是正式员工的姓名' 

oracle

	SELECT '以下是正式员工的姓名' FROM DUAL (DUAL内置表)



## 索引与约束

#### 索引

1.创建索引   CREATE INDEX 索引名 ON 表名(字段 1, 字段 2,……字段 n)

	CREATE INDEX idx_person_name ON T_Person(FName)
	
	CREATE INDEX idx_person_nameage ON T_Person(FName,FAge)

2.删除索引

>mysql  DROP INDEX 索引名 ON 表名

	DROP INDEX idx_person_name ON T_Person
	
	DROP INDEX idx_person_nameage ON T_Person

>MSSQLServer

	DROP INDEX T_Person.idx_person_name
	
	DROP INDEX T_Person.idx_person_nameage

>Oracle 和 DB2 的 DROP INDEX 语句不要求指定表名，只要指定索引名即可

	DROP INDEX idx_person_name
	
	DROP INDEX idx_person_nameage


### 约束

数据库系统中主要提供了如下几种约束：非空约束；唯一约束； CHECK 约束；主键约束；外键约束。

 1.非空约束    NOT NULL
 
	CREATE TABLE T_Person (
		FNumber VARCHAR(20) NOT NULL ,//非空约束
		FName
		VARCHAR(20),
		FAge INT
	)
	
	CREATE TABLE T_Person (
		FNumber VARCHAR2(20) NOT NULL ,//非空约束
		FName VARCHAR2(20),
		FAge NUMBER (10)
	)

inser into, update 报错：

不能将值 NULL 插入列 'FNumber'，表 'demo.dbo.T_Person'；列不允许有空值。INSERT 失败

不能将值 NULL 插入列 'FNumber'，表 'demo.dbo.T_Person'；列不允许有空值。INSERT 失败

2.唯一约束 UNIQUE

单字段唯一约束

	CREATE TABLE T_Person (
		FNumber VARCHAR(20) UNIQUE,//唯一约束
		FName VARCHAR(20),
		FAge INT
	)

	CREATE TABLE T_Person (
		FNumber VARCHAR2(20) UNIQUE,//唯一约束
		FName VARCHAR2(20),
		FAge NUMBER (10)
	)

复合唯一约束： CONSTRAINT 约束名  UNIQUE(字段 1,字段 2……字段 n)

	CREATE TABLE T_Person (
		FNumber VARCHAR(20),
		FDepartmentNumber VARCHAR(20),
		FName VARCHAR(20),FAge INT,
		CONSTRAINT unic_dep_num UNIQUE(FNumber,FDepartmentNumber)
	)

	CREATE TABLE T_Person (
		FNumber VARCHAR2(20),
		FDepartmentNumber VARCHAR(20),
		FName VARCHAR2(20),FAge NUMBER (10),
		CONSTRAINT unic_dep_num UNIQUE(FNumber,FDepartmentNumber)
	)

添加约束：ALTER TABLE 表名  ADD CONSTRAINT 唯一约束名 UNIQUE(字段 1,字段 2……字段 n)

	mysql,oracle
	ALTER TABLE T_Person ADD CONSTRAINT unic_3 UNIQUE(FName, FAge)

	mysql
	ALTER TABLE T_Person DROP INDEX unic_1;

inser into, update 报错：

违反了 UNIQUE KEY 约束 'UQ__T_Person__1A14E395'。不能在对象 'dbo.T_Person' 中插入重复键

违反了 UNIQUE KEY 约束 'unic_dep_num'。不能在对象 'dbo.T_Person' 中插入重复键


3.CHECK 约束


	CREATE TABLE T_Person (
		FNumber VARCHAR(20) CHECK (LENGTH(FNumber)>12),//CHECK 约束
		FName VARCHAR(20),
		FAge INT CHECK(FAge >0),//CHECK 约束
		FWorkYear INT CHECK(FWorkYear>0)//CHECK 约束
	)


	CREATE TABLE T_Person (
		FNumber VARCHAR2(20) CHECK (LENGTH(FNumber)>12),//CHECK 约束
		FName VARCHAR2(20),
		FAge NUMBER (10) CHECK(FAge >0),//CHECK 约束
		FWorkYear NUMBER (10) CHECK(FWorkYear>12)//CHECK 约束
	)

注意点：
CHECK 子句添加 CHECK 约束的方式的缺点是约束条件不能引用其他列

	... FWorkYear INT CHECK(FWorkYear< FAge)) ...

解决：
如果希望 CHECK子句中的条件语句中使用其他列，则必须在 CREATE TABLe 语句的末尾使用 CONSTRAINT 关键字定义它
CONSTRAINT 约束名 CHECK(约束条件)

	CREATE TABLE T_Person (
		FNumber VARCHAR(20),
		FName VARCHAR(20),
		FAge INT,
		FWorkYear INT,
		CONSTRAINT ck_1 CHECK(FWorkYear< FAge)
	)

inser into, update 报错：

INSERT 语句与 CHECK 约束"CK__T_Person__FWorkY__24927208"冲突。该冲突发生于数据库"demo"，表
"dbo.T_Person", column 'FWorkYear'

INSERT 语句与 CHECK 约束"ck_1"冲突。该冲突发生于数据库"demo"，表"dbo.T_Person"


4.主键约束  主键必须能够唯一标识一条记录，也就是主键字段中的值必须是唯一的，而且不能包含NULL 值

单一字段组成的主键

	CREATE TABLE T_Person (
		FNumber VARCHAR(20) PRIMARY KEY,
		FName VARCHAR(20),
		FAge INT
	)

	CREATE TABLE T_Person (
		FNumber VARCHAR2(20) PRIMARY KEY,
		FName VARCHAR2(20),
		FAge NUMBER (10)
	)

复合主键或者联合主键

	CREATE TABLE T_Person (
		FNumber VARCHAR(20),
		FName VARCHAR(20),
		FAge INT,
		CONSTRAINT pk_1 PRIMARY KEY(FNumber,FName)
	)

	CREATE TABLE T_Person (
		FNumber VARCHAR2(20)
		FName VARCHAR2(20),
		FAge NUMBER (10) ,
		CONSTRAINT pk_1 PRIMARY KEY(FNumber,FName)
	)

添加主键

	ALTER TABLE T_Person
	ADD CONSTRAINT pk_1 PRIMARY KEY(FNumber,FName)

删除主键
	ALTER TABLE T_Person
	DROP PRIMARY KEY;


5.外键约束

添加外键
	ALTER TABLE T_Book
	ADD CONSTRAINT fk_book_author
	FOREIGN KEY (FAuthorId) REFERENCES T_AUTHOR(FId)

删除外键
DROP TABLE T_Book;
DROP TABLE T_AUTHOR;

先删除T_Book



## 表连接

#### 内连接（INNER JOIN）

>INNER JOIN table_name ON condition

在 INNER JOIN 关键字后指明要被连接的表，而在 ON 关键字后则指定了进行连接时所使用的条件

内部连接要求组成连接的两个表必须具有匹配的记录

	SELECT T_Order.FId,FNumber,FPrice FROM T_Order 
	INNER JOIN T_Customer
	ON FCustomerId= T_Customer.FId
	WHERE T_Customer.FName='TOM'

注意： 

为了避免列名歧义并且提高可读性，这里建议使用表连接的时候要显式列所属的表

INNER JOIN 中的 INNER 是可选的，INNER JOIN 是默认的连接方式

表连接的时候可以不局限于只连接两张表，因为有很多情况下需要联系许多表

简化

	SELECT o.FId,o.FNumber,o.FPrice,c.FName,c .FAge 
	FROM T_Order o
	JOIN T_Customer c
	ON o.FCustomerId= c.FId
	WHERE c.FName='TOM'


	SELECT T_Order.FNumber,T_Order.FPrice,T_Customer.FName,T_Customer.FAge
	FROM T_Order
	JOIN T_Customer
	ON T_Order.FPrice< T_Customer.FAge*5
	and T_Order.FCustomerId=T_Customer.FId //and


#### 交叉连接

隐式

	SELECT c.FId, c.FName, c.FAge,o.FId, o.FNumber, o.FPrice
	FROM T_Customer c, T_Order o

显式 CROSS JOIN 

	SELECT c.FId, c.FName, c.FAge,
	o.FId, o.FNumber, o.FPrice
	FROM T_Customer c
	CROSS JOIN T_Order o

>注意：

交叉连接的显式定义方式为使用CROSS JOIN关键字，其语法与INNER JOIN类似

使用CROSS JOIN的方式声明的交叉连接只能被MYSQL、MSSQLServer和Oracle所支
持，在DB2中是不被支持的

因为所有的数据库系统都支持隐式的交叉连接，所以它是执行
交叉连接的最好方法


#### 自连接

>交叉连接、内连接、外连接等连接方式中只要参与连接的表是同一张表，那么它们就可以被称为自连接

	SELECT o1.FNumber,o1.FPrice,o1.FTypeId,o2.FNumber,o2.FPrice,o2.FTypeId
	FROM T_Order o1
	INNER JOIN T_Order o2
	ON o1.FTypeId=o2.FTypeId and o1.FId<o2.FId

>注意

	SELECT FNumber,FPrice,FTypeId
	FROM T_Order
	WHERE FTypeId= FTypeId//无意义

	SELECT FNumber,FPrice,FTypeId
	FROM T_Order o
	INNER JOIN T_Order
	ON T_Order.FTypeId=T_Order.FTypeId//T_Order报错

	SELECT o1.FNumber,o1.FPrice,o1.FTypeId,
	o2.FNumber,o2.FPrice,o2.FTypeId
	FROM T_Order o1
	INNER JOIN T_Order o2
	ON o1.FTypeId=o2.FTypeId and o1.FId<>o2.FId //<>

1.注意sql语句的写法，否组无意义
2.同一张表需要指定不同的别名   (T_Order => o1,o2)
3.数据库系统把“A匹配B”与“B匹配A”看成了两个不同的匹配，导致数据重复,所以and后面的条件非常重要


#### 外部连接

外部连接的语法与内部连接几乎是一样的，主要区别就是对于空值的处理

外部连接不需要两个表具有匹配记录

外部连接分为三种类型：右外部连接（RIGHT OUTER JOIN）、左外部连接（LEFT OUTER JOIN）和全外部连接（FULL OUTER JOIN

三者不同点说明如下：

左外部连接还返回左表中不符合连接条件的数据；

右外部连接还返回右表中不符合连接条件的数据；

全外部连接还返回左表中不符合连接条件的数据以及右表中不符合连接条件的数据，它其实是左外部连接和左外部连接的合集

（这里的左表和右表是相对于JOIN关键字来说的，位于JOIN关键字左侧的表即被称为左表，而位于JOIN关键字右侧的表即被称为右表）

1.左外部连接

	SELECT o.FNumber,o.FPrice,o.FCustomerId,
	c.FName,c.FAge
	FROM T_Order o
	LEFT OUTER JOIN T_Customer c
	ON o.FCustomerId=c.FId

2.右外部连接

	SELECT o.FNumber,o.FPrice,o.FCustomerId,
	c.FName,c.FAge
	FROM T_Order o
	RIGHT OUTER JOIN T_Customer c
	ON o.FCustomerId=c.FId

3.全外部连接

几乎所有的数据库系统都支持左外部连接和右外部连接，但是全外部连接则不是所有数据库系统都支持，特别是最常使用的MYSQL就不支持全外部连接

	SELECT o.FNumber,o.FPrice,o.FCustomerId,
	c.FName,c.FAge
	FROM T_Order o
	FULL OUTER JOIN T_Customer c
	ON o.FCustomerId=c.FId

mysql中使用左外部连接 、右外部连接 和UNION

	SELECT o.FNumber,o.FPrice,o.FCustomerId,c.FName,c.FAge
	FROM T_Order o
	LEFT OUTER JOIN T_Customer c
	ON o.FCustomerId=c.FId
	
	UNION
	
	SELECT o.FNumber,o.FPrice,o.FCustomerId,c.FName,c.FAge
	FROM T_Order o
	RIGHT OUTER JOIN T_Customer c
	ON o.FCustomerId=c.FId

>注意： 外连接返回的不符合条件的语句  通过where条件是可以过滤掉的


## 子查询

查询的语法与普通的 SELECT 语句语法相同，所有可以在普通 SELECT 语句中使用
的特性都可以在子查询中使用，比如 WHERE 子句过滤、UNION 运算符、HAVING 子句、
GROUPBY 子句、ORDER BY 子句，甚至在子查询中还可以包含子查询。同时，不仅可以
在 SELECT 语句中使用子查询，还可以在 UPDATE、DELETE 等语句中使用子查询

SELECT 语句可以嵌套在其他语句中,比如 SELECT,INSERT,UPDATE 以及 DELETE 等，这些被嵌套的 SELECT 语句就称为子查询

1.单值子查询 （标量子查询）

注意：子查询的返回值必须只有一行记录，而且只能有一个列

标量子查询可以用在 SELECT 语句的列表中、表达式中、WHERE 语句中等很多场合


2.列值的子查询 （表子查询）

列值子查询可以返回一个多行多列的结果集

表子查询可以用在 SELECT 语句的 FROM子句中、INSERT 语句、连接、IN 子句等很多场合

注意：表子查询可以看作一张临时的表，所以引用子查询中列的时候必须使用子查询中定义的列名，也就是如果子查询中为列定义了别名，那么在引用的时候也要使用别名

	SELECT T_Reader.FName,t2.FYear,t2.FName ,t2.F3
	FROM T_Reader,
	(SELECT FYearPublished AS FYear,FName,1+2 as F3 FROM T_Book WHERE FYearPublished < 1800) t2

这里的表子查询为 FYearPublished 列取了一个别名 FYear，这样在引用它的时候就必须使用 FYear 而不能继续使用 FYearPublished 
