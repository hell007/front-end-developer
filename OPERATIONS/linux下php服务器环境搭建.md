## linux下 php服务器环境搭建
centos7 安装 apache + mysql + php

准备篇：
1、配置防火墙，开启80端口、3306端口
vi /etc/sysconfig/iptables
-A INPUT -m state --state NEW -m tcp -p tcp --dport 80 -j ACCEPT   #允许80端口通过防火墙
-A INPUT -m state --state NEW -m tcp -p tcp --dport 3306 -j ACCEPT   #允许3306端口通过防火墙

备注：很多网友把这两条规则添加到防火墙配置的最后一行，导致防火墙启动失败，

正确的应该是添加到默认的22端口这条规则的下面

如下所示：
############################## 添加好之后防火墙规则如下所示 ##############################
# Firewall configuration written by system-config-firewall
# Manual customization of this file is not recommended.
*filter
:INPUT ACCEPT [0:0]
:FORWARD ACCEPT [0:0]
:OUTPUT ACCEPT [0:0]
-A INPUT -m state --state ESTABLISHED,RELATED -j ACCEPT
-A INPUT -p icmp -j ACCEPT
-A INPUT -i lo -j ACCEPT
-A INPUT -m state --state NEW -m tcp -p tcp --dport 22 -j ACCEPT
-A INPUT -m state --state NEW -m tcp -p tcp --dport 80 -j ACCEPT
-A INPUT -m state --state NEW -m tcp -p tcp --dport 3306 -j ACCEPT
-A INPUT -j REJECT --reject-with icmp-host-prohibited
-A FORWARD -j REJECT --reject-with icmp-host-prohibited
COMMIT
##################################################################################################

/etc/init.d/iptables restart  #最后重启防火墙使配置生效

2、关闭SELINUX
vi /etc/selinux/config
#SELINUX=enforcing       #注释掉
#SELINUXTYPE=targeted    #注释掉
SELINUX=disabled         #增加
:wq!  #保存，关闭
shutdown -r now   #重启系统


安装篇：

一、安装Apache
yum install httpd    #根据提示，输入Y安装即可成功安装
/etc/init.d/httpd start  #启动Apache

备注：Apache启动之后会提示错误：
正在启动 httpd:httpd: Could not reliably determine the server's fully qualif domain name, using ::1 for ServerName
解决办法：
vi /etc/httpd/conf/httpd.conf   #编辑
找到  #ServerName www.example.com:80
修改为 ServerName www.osyunwei.com:80  #这里设置为你自己的域名，如果没有域名，可以设置为localhost
:wq!    #保存退出
chkconfig httpd on   #设为开机启动
/etc/init.d/httpd restart  #重启Apache

二、安装MySQL

1、安装MySQL
yum install mysql mysql-server   #询问是否要安装，输入Y即可自动安装,直到安装完成
/etc/init.d/mysqld start   #启动MySQL
chkconfig mysqld on   #设为开机启动
cp /usr/share/mysql/my-medium.cnf   /etc/my.cnf  #拷贝配置文件（注意：如果/etc目录下面默认有一个my.cnf，直接覆盖即可）

2、为root账户设置密码
mysql_secure_installation
回车，根据提示输入Y
输入2次密码，回车
根据提示一路输入Y
最后出现：Thanks for using MySQL!
MySql密码设置完成，重新启动 MySQL：
/etc/init.d/mysqld restart #重启
/etc/init.d/mysqld stop   #停止
/etc/init.d/mysqld start #启动

三、安装PHP5

1、安装PHP5
yum install php
根据提示输入Y直到安装完成

2、安装PHP组件，使 PHP5 支持 MySQL
yum install php-mysql php-gd libjpeg* php-imap php-ldap php-odbc php-pear php-xml php-xmlrpc php-mbstring php-mcrypt php-bcmath php-mhash libmcrypt
这里选择以上安装包进行安装
根据提示输入Y回车
/etc/init.d/mysqld restart  #重启MySql
/etc/init.d/httpd restart  #重启Apche

二、php配置
vi  /etc/php.ini   #编辑
date.timezone = PRC     #在946行 把前面的分号去掉，改为date.timezone = PRC
disable_functions = passthru,exec,system,chroot,scandir,chgrp,chown,shell_exec,proc_open,proc_get_status,ini_alter,ini_alter,ini_restore,dl,openlog,syslog,readlink,symlink,popepassthru,stream_socket_server,escapeshellcmd,dll,popen,disk_free_space,checkdnsrr,checkdnsrr,getservbyname,getservbyport,disk_total_space,posix_ctermid,posix_get_last_error,posix_getcwd, posix_getegid,posix_geteuid,posix_getgid, posix_getgrgid,posix_getgrnam,posix_getgroups,posix_getlogin,posix_getpgid,posix_getpgrp,posix_getpid, posix_getppid,posix_getpwnam,posix_getpwuid, posix_getrlimit, posix_getsid,posix_getuid,posix_isatty, posix_kill,posix_mkfifo,posix_setegid,posix_seteuid,posix_setgid, posix_setpgid,posix_setsid,posix_setuid,posix_strerror,posix_times,posix_ttyname,posix_uname

#在386行 列出PHP可以禁用的函数，如果某些程序需要用到这个函数，可以删除，取消禁用。
expose_php = Off        #在432行 禁止显示php版本的信息
magic_quotes_gpc = On   #在745行 打开magic_quotes_gpc来防止SQL注入
short_open_tag = ON     #在229行支持php短标签
open_basedir = .:/tmp/  #在380行 设置表示允许访问当前目录(即PHP脚本文件所在之目录)和/tmp/目录,可以防止php木马跨站,如果改了之后安装程序有问题(例如：织梦内容管理系统)，可以注销此行，或者直接写上程序的目录/data/www.osyunwei.com/:/tmp/
:wq!  #保存退出
/etc/init.d/mysqld restart  #重启MySql
/etc/init.d/httpd restart   #重启Apche

测试篇
cd  /var/www/html
vi index.php   #输入下面内容
<?php
phpinfo();
?>
:wq!  #保存退出
在客户端浏览器输入服务器IP地址，可以看到如下图所示相关的配置信息！



注意：apache默认的程序目录是/var/www/html

权限设置：chown apache.apache -R /var/www/html

至此，CentOS 6.4安装配置LAMP服务器(Apache+PHP5+MySQL)教程完成！