## Linux 主要命令操作笔记

######命令简介
a. 用户组 用户
1.组操作
#groupadd  webfront //组名  添加前端组
#vi /etc/group //查看linux中所有组的信息
#cat /etc/group 
#gropmod -n web webfront //修改组名为web (-g -n -o 代表的意思)
#groupdel //删除组
2.用户操作
#useradd test001  //添加用户
#useradd -g web test001
#vi /etc/passwd //查看linux中所有用户信息
#cat /etc/passwd
#passwd wzh //给用户设置密码
#usermod //修改用户
#userdel //删除用户
 
b.分区
#fdisk -l  //查看系统分区具体情况
#df   //查看磁盘使用情况
#df -h //查看已经使用的磁盘信息
#mount  //挂载
#umount  //取消挂载
 
ls #列出目标目录中所有的子目录和文件
 
1.创建目录
#cd /usr
#mkdir java //(1)
 
#mkdir /tomcat/tomcat7 //(2)
 
2.复制目录
#cd /root/oneinstack/src/
#ls
#cp -rf mysql-5.5.46.tar.gz /usr/local/src //(1)
 
#cp -rf /root/oneinstack/src/* /usr/local/src  //(2)
 
3.解压文件
#tar -zxvf mysql-5.5.46.tar.gz
 
4.更改目录名称 
#mv mysql-5.5.46 mysql
 
5.移动目录
#mv mysql /usr/local
 
6.删除目录
#rm -rf mysql-5.5.46.tar.gz    //删除文件
#rm -rf /root/oneinstack/src/  //删除文件夹及文件下文件
 
7.更改文件内容
(1)cat 
#cat 接普通文件名，会把文件内容打印到屏幕
#cat ./profile
#cat > file，这个可以向文件"file"写入内容，最后按 Ctrl + D 结束输入，会将你输入的数据保存到文件
 
(2)vi 
#vi web.xml
 
(3)vim
#vim /etc/prue_ftpd
i
#esc 
:wq! enter  //退出
 
8.卸载命令  （以php为列）
#rpm -qa | grep php
php-cli-5.3.3-46.el6_7.1.x86_64
php-odbc-5.3.3-46.el6_7.1.x86_64
php-gd-5.3.3-46.el6_7.1.x86_64
php-pear-1.9.4-4.el6.noarch
php-common-5.3.3-46.el6_7.1.x86_64
php-5.3.3-46.el6_7.1.x86_64
php-mcrypt-5.3.3-4.el6.x86_64
php-mysql-5.3.3-46.el6_7.1.x86_64
php-mbstring-5.3.3-46.el6_7.1.x86_64
php-xml-5.3.3-46.el6_7.1.x86_64
php-ldap-5.3.3-46.el6_7.1.x86_64
php-pdo-5.3.3-46.el6_7.1.x86_64
php-imap-5.3.3-46.el6_7.1.x86_64
php-bcmath-5.3.3-46.el6_7.1.x86_64
php-xmlrpc-5.3.3-46.el6_7.1.x86_64

#rpm -e rpm -e php-gd-5.3.3-46.el6_7.1.x86_64 //按依赖关系卸载
 
9.文件权限查看命令
#cd /data/wwwroot/www.kunyujie.com/
#cat index.jsp
#ll
www www 
 
#echo ssmext > index.jsp
#ll
(如果ssmext是通过ftp上传的那么他的权限是www  www；
如果是ssmwxt.war下载的，那么他的权限是 root  root ,需要更改)

10.利用chmod修改权限
对Document/目录下的所有子文件与子目录执行相同的权限变更：
# chmod -R 700 Document/
-R参数是递归 处理目录下的所有文件以及子文件夹
700是变更后的权限表示（只有所有者有读和写以及执行的权限）
Document/ 是需要执行的目录

11、利用chown改变所有者：
对Document/ 目录下的所有文件与子目录执行相同的所有者变更，修改所有者为users用户组的username用户
#chown -R username:users Document/
username:users users用户组的username，用户组参数不是必须有 
网站根目录权限遵循：
文件 644， 文件夹 755 ，权限用户和用户组 www
如出现文件权限问题时，请执行下面 3 条命令：
chown -R www.www /data/wwwroot
find /data/wwwroot/ -type d -exec chmod 755 {} \;
find /data/wwwroot/ -type f -exec chmod 644 {} \;

12、查找文件或者文件夹
查找目录：find /（查找范围） -name '查找关键字' -type d 查找文件：find /（查找范围） -name 查找关键字 -print

#  find ./ -name ".gradle"   //查找.gradle文件夹所在位置

 
