# linux下 java服务器环境搭建

一、先卸载系统中自带的java，没有就不用卸载 

```
yum list installed |grep java(查看已有的java) 
yum -y remove java-1.7.0-openjdk*（卸载相应的java 1.7.0位版本号，因人而异） 
yum -y remove tzdata-java.noarch （卸载tzdata-java）（以上命令没装java跑跑也没事）
```

二.java配置（jdk）

```
#新建java目录，下载java压缩包
#cd usr
#mkdir java
#cd java 
#wget http://.......
#下载完成后，重命名
#mv jdk-7u79-linux-x64.gz\xx\xx   jdk-7u79-linux-x64.gz
#解压jdk
#tar -xzvf jdk-7u79-linux-x64.gz
#配置环境变量 //vi编辑
#i //进入插入模式
export JAVA_HOME=/usr/java/jdk1.7.0_79  
export  CLASSPATH=.:%JAVA_HOME%/lib/dt.jar:%JAVA_HOME%/lib/tools.jar  
export PATH=$PATH:$JAVA_HOME/bin
#esc  //进入命令模式
:wq! //按冒号，默认进入最后一行  输入wq!  按enter保存退出
#重新加载profile：立即生效
#source /etc/profile 
#查看
#java -version

```

三、tomcat安装

```
#cd usr
#下载
#wget http://mirrors.hust.edu.cn/apache/tomcat/tomcat-7/v7.0.68/bin/apache-tomcat-7.0.68.tar.gz
#mv apache-tomcat-7.0.68.tar.gz tomcat7.0.68.tar.gz //可以不用做
#tar -xzvf apache-tomcat-7.0.68.tar.gz
#ls
#切换到tomcat的bin目录下运行 ./startup.sh 启动
#cd /usr/apache-tomcat-7.0.68/bin
#ls
#./startup.sh

##note:浏览器中输入 用ip:8080访问,如果不出现 检查端口是否开启 ，或者查看tomcat的配置文件是80还是8080
###更改端口
#cd /usr/apache-tomcat-7.0.68/conf
#sudo vi server.xml   //使用管理员权限编辑
## cat server.xml 

###查看日志
#cd ../logs
#ls
# cat localhost_access_log.2016-03-04.txt 
# cat host-manager.2016-03-04.log 
# cat catalina.2016-03-04.log 

####查看tomcat开启的端口
# /etc/init.d/iptables status

```

四、MySQL安装

```
a.本地安装MySQL
1.把安装文件拷贝到 /usr下
2.解压文件 ，重命名
#tar -zxvf mysql5.1.3.4.tar.gz
#mv mysql5.1.3.4. mysql5.1
3.
#groupadd mysql  //创建组
#useradd -g mysql mysql  //创建MySQL用户，并添加到MySQL组
#cd mysql  //进入到MySQL文件夹
#scripts/mysql_install_db  —user=mysql  //初始化数据库
#chown -R root .  //修改文件所有者为root
#chown -R mysql data //修改data文件夹的所有者为mysql
#chgrp -R mysql .  //修改用户组为mysql
#cd bin       //启动mysql 
#mysqld_safe —user=mysql &
#./mysql -u root -p
#password
 
####在任何目录下  使用mysql -u root -p
#env
#修改 .bash_profile 的path，添加MySQL路径
#env   //即可看到新的环境变量
 
b.通过阿里云安装MySQL
1、安装客户端和服务器端
确认mysql是否已安装：
yum list installed mysql*
rpm -qa | grep mysql*
查看是否有安装包：
yum list mysql*
安装mysql客户端：
yum install mysql
安装mysql 服务器端：
yum install mysql-server
yum install mysql-devel
2、启动、停止设置
数据库字符集设置
mysql配置文件/etc/my.cnf中加入default-character-set=utf8
启动mysql服务：
service mysqld start
或者/etc/init.d/mysqld start
设置开机启动：
chkconfig -add mysqld
查看开机启动设置是否成功
chkconfig --list | grep mysql*
mysqld 0:关闭 1:关闭 2:启用 3:启用 4:启用 5:启用 6:关闭
停止mysql服务：
service mysqld stop
3、登录及忘记修改密码
创建root管理员：
mysqladmin -u root password 666666
登录：
mysql -u root -p
如果忘记密码，则执行以下代码
service mysqld stop
mysqld_safe --user=root --skip-grant-tables
mysql -u root
use mysql
update user set password=password("666666") where user="root";
flush privileges;
4、允许远程访问设置

开放防火墙的端口号
mysql增加权限：mysql库中的user表新增一条记录host为“%”，user为“root”。
use mysql;
UPDATE user SET `Host` = '%' WHERE `User` = 'root' LIMIT 1;
%表示允许所有的ip访问

5、mysql的几个重要目录

(a)数据库目录
/var/lib/mysql/
(b)配置文件
/usr/share /mysql（mysql.server命令及配置文件）
(c)相关命令
/usr/bin（mysqladmin mysqldump等命令）
(d)启动脚本
/etc/rc.d/init.d/（启动脚本文件mysql的目录）
```

四、MySQL的安装二

1.卸载掉原有mysql

```
# rpm -qa | grep mysql　　// 这个命令就会查看该操作系统上是否已经安装了mysql数据库
# rpm -e mysql　　// 普通删除模式
# rpm -e --nodeps mysql　　// 强力删除模式，如果使用上面命令删除时，提示有依赖的其它文
##在删除完以后我们可以通过 rpm -qa | grep mysql 命令来查看mysql是否已经卸载成功！！
```

2.通过yum来进行mysql的安装

```
#yum list | grep mysql //稍等片刻 就可以得到yum服务器上mysql数据库的可下载版本信息

#yum install -y mysql-server mysql mysql-devel  //命令将mysql mysql-server mysql-devel都安装好
###注意:安装mysql时我们并不是安装了mysql客户端就相当于安装好了mysql数据库了，我们还需要安装mysql-server服务端才行

#rpm -qi mysql-server  //查看刚安装好的mysql-server的版本
```

3.mysql数据库的初始化及相关配置

```
#service mysqld start //初始化 数据多
#service mysqld start //再次启动  数据少

###查看mysql服务是不是开机自动启动
#chkconfig --list | grep mysqld

###我们发现mysqld服务并没有开机自动启动，我们当然可以通过 chkconfig mysqld on 命令来将其设置成开机启动，这样就不用每次都去手动启动了

#chkconfig mysqld on //设置成开机启动，这样就不用每次都去手动启动了
#chkconfig --list | grep mysql

### 设置账号密码
#mysqladmin -u root password 'aiyuxxx'
#此时我们就可以通过 mysql -u root -p 命令来登录我们的mysql数据库了
```

4.mysql数据库的主要配置文件 //http://www.centoscn.com/mysql/2014/1211/4290.html

5.创建数据库

```
[root@iZ28507paaeZ /]# cd /
[root@iZ28507paaeZ /]# mysql -u root -p
mysql> create database kunyujie;
mysql> show databases;
```

6.配置 MySQL 远程连接

(1)开启3306端口

```
#iptables -I INPUT 4 -p tcp -m state --state NEW -m tcp --dport 3306 -j ACCEPT
#service iptables save  //保存 iptables 规则
```

(2)数据库授权

```
#mysql -u root -p 
mysql> grant all privileges on kunyujie.* to root@'%' identified by ‘ai***’; //授权语句
mysql> flush privileges;
mysql> exit;
```

五、安装 nginx

想在 CentOS 系统上安装 Nginx ，你得先去添加一个资源库，像这样：

vim /etc/yum.repos.d/nginx.repo
使用 vim 命令去打开 /etc/yum.repos.d/nginx.repo ，如果 nginx.repo 不存在，就会去创建一个这样的文件，打开以后按一下小 i 键，进入编辑模式，然后复制粘贴下面这几行代码，完成以后按 esc 键退出，再输入 :wq （保存并退出）

[nginx]
name=nginx repo
baseurl=http://nginx.org/packages/centos/$releasever/$basearch/
gpgcheck=0
enabled=1
完成以后，我们就可以使用 yum 命令去安装 nginx 了，像这样：

yum install nginx
安装好以后测试一下 nginx 服务：

service nginx status
应该会返回：

nginx is stopped （nginx 已停止）
再测试一下 nginx 的配置文件：

nginx -t
应该会返回：

nginx: the configuration file /etc/nginx/nginx.conf syntax is ok
nginx: configuration file /etc/nginx/nginx.conf test is successful
... syntax is ok，... test is successful，说明配置文件没问题，同时这个结果里你可以找到 nginx 的配置文件 nginx.conf 所在的位置。

操纵 nginx 服务

操纵服务，可以使用使用 service 命令，它可以启动（start），重启（restart），或停止服务（stop），比如要启动 nginx 服务：

service nginx start
服务启动以后，你就可以在浏览器上使用服务器的 IP 地址，或者指向这个地址的域名访问服务器指定的目录了。你会看到类似下面的这些文字。

Welcome to nginx! If you see this page, the nginx web server is successfully installed and working. Further configuration is required. For online documentation and support please refer to nginx.org. Commercial support is available at nginx.com. Thank you for using nginx.

配置 nginx 虚拟主机

安装完 nginx 以后，第一件想到的事应该就是去创建虚拟主机，虚拟主机允许我们在同一台服务器上运行多个网站，我们可以为不同的域名绑定不同的目录，访问这个域名的时候，会打开对应目录里面的东西。下面来看一下为 nginx 配置虚拟主机。先进入到 nginx 配置文件目录：

cd /etc/nginx/conf.d
复制这个目录里的 default.conf ，复制以后的名字可以使用你的虚拟主机名字。比如创建一个 nginx.ninghao.net 的虚拟主机。复制文件可以使用 cp 命令，像这样：

cp default.conf nginx.ninghao.net.conf
再去编辑一下这个复制以后的配置文件，可以使用 vim 命令：

vim nginx.ninghao.net.conf
你会看到像这样的代码：

server {
 listen 80;
 server_name localhost;
 #charset koi8-r;
 #access_log   /var/log/nginx/log/host.access.log main;
 location / {
 root /usr/share/nginx/html;
 index index.html index.htm;
}
...
}
server_name 就是主机名，也就是跟这个虚拟主机绑定在一块儿的域名，我事先把 nginx.ninghao.net 指向了服务器，这个虚拟主机就是为它准备的，所以，server_name 后面的东西就是 nginx.ninghao.net 。紧接着 server_name 下面可以是一个 root，就是这个虚拟主机的根目录，也就是网站所在的目录。比如我们要把 nginx.ninghao.net 这个网站的文件放在 /home/www/nginx.ninghao.net 下面，那么这个 root 就是这个路径。

然后去掉 location / 里面的 root 这行代码。再在 index 后面加上一种索引文件名，也就是默认打开的文件，这里要加上一个 index.php ，这样访问 nginx.ninghao.net 就可以直接打开 root 目录下面的 index.php 了。稍后我们再去安装 php 。修改之后，看起来像这样：

server {
 listen 80;
 server_name nginx.ninghao.net;
 root /home/www/nginx.ninghao.net;
 #charset koi8-r;
 #access_log /var/log/nginx/log/host.access.log main;

 location / {
 index index.php index.html index.htm;
 }
...
}
这个配置文件先修改到这，稍后，我们再回来继续修改一下它。保存一下，按 esc ，输入 :wp（保存并退出）。现在虚拟主机应该就可以使用了。主机的域名是nginx.ninghao.net，访问它的时候，打开的是 /home/www/nginx.ninghao.net 这个目录里面的东西，你可以在这个目录下放点东西。

重启 nginx 或者重新加载 nginx 可以让配置文件生效。

service nginx reload
现在，打开浏览器，输入你为虚拟主机设置的域名，看看是否能打开你指定的目录里的东西。
如果ecs上只放一个网站就直接修改default.conf文件，server_name不变其他修改方法同上。


https://yq.aliyun.com/articles/41755

https://yq.aliyun.com/articles/59870
