## mongodb [链接](http://yijiebuyi.com/blog/b6a3f4a726b9c0454e28156dcc96c342.html)

### 1.安装

	wzhdeMacBook-Air:~ wzh$ brew install mongodb
	...//省略
	/usr/local/Cellar/mongodb/3.4.1

### 2.启动	
第一次启动服务端,这里需要做一些准备工作.
	
	1.默认mongodb 数据文件是放到根目录 data/db 文件夹下,如果没有这个文件,请自行创建
	wzhdeMacBook-Air:~ wzh$ mkdir -p /data/db
	
	2.如果你当前的环境变量还没有加入 mongod  ,手动添加的环境变量中.
	wzhdeMacBook-Air:~ wzh$ vi .bash_profile
	//添加mongodb安装目录到环境变量中
	export PATH=/usr/local/Cellar/mongodb/3.4.1/bin:${PATH}
	
	3.如果让环境变量马上生效? 执行下面的shell
	wzhdeMacBook-Air:~ wzh$ source .bash_profile
	
	4.修改mongodb配置文件,配置文件默认在 /usr/local/etc 下的 mongod.conf
	systemLog:
	  destination: file
	  path: /usr/local/var/log/mongodb/mongo.log
	  logAppend: true
	storage:
	  dbPath: /data/db
	net:
	  bindIp: 127.0.0.1
	  第二行修改成数据库文件写入目录地址,如果准备连接非本地环境的mongodb数据库时,bindIp= 0.0.0.0 即可

	5.给 /data/db 文件夹赋权限
	wzhdeMacBook-Air:~ wzh$ sudo chmod -R 777 /data/db
	
	6.启动mongodb服务端
	wzhdeMacBook-Air:~ wzh$ mongod
	
	7.启动mongodb客户端 (此步骤有错  不启用也可以使用)
	wzhdeMacBook-Air:~ wzh$ mongo 
	zhangzhi@moke:/usr/local/etc$ mongo
	
## 使用
	nodejs爬虫案列

	
	