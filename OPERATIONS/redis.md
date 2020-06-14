## redis

### 1.安装
	$ brew install redis
	
### 2.启动
	$ redis-server
	
	
## Mac 下安装Redis

1、Redis下载

2、解压redis-3.0.7.tar.gz
拷贝到指定目录，执行解压命令。
tar xzf redis-3.0.7.tar.gz

3、编译，安装
cd edis-3.0.7
make
make install
执行完，基本安装完了，配置都采用默认配置

4、启动redis
cd 到redis解压目录下，执行src/redis-server,回车即启动
查看redis是否启动成功
在终端执行，ps -ef | grep redis ,看到redis-server进程则成功

5、关闭redis
cd 到redis解压目录下，执行src/redis-cli -p 6379 shutdown ,回车即启动 




CentOS 7安装配置Redis数据库
http://jingyan.baidu.com/article/6dad507510ea07a123e36e95.html

服务器重启后ngix占据端口处理
pkill -9 nginx


##  mac下启动

	$ cd /usr/local/Cellar/redis
	
	$ redis-server


