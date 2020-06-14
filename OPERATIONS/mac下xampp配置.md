## mac下xampp 配置

httpd.conf
第一步：注销，如下样式：
# DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs"
第二步：启动虚拟主机的配置，如下样式：
Include conf/extra/httpd-vhosts.conf
 
第三步：配置httpd-vhosts.conf，增加如下样式：
<VirtualHost *:80>
  ServerAdmin webmaster@demo.com
  DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs/apps/demo/"
  ServerName demo.com
  ServerAlias demo.com
  ErrorLog "logs/mysmarty.com-error_log"
  CustomLog "logs/mysmarty.com-access_log" common
</VirtualHost>

<VirtualHost *:80>
  ServerAdmin webmaster@jie.com
  DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs/apps/jie/"
  ServerName jie.com
  ServerAlias jie.com
  ErrorLog "logs/mysmarty.com-error_log"
  CustomLog "logs/mysmarty.com-access_log" common
</VirtualHost>

<VirtualHost *:80>
  DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs/"
  ServerName localhost
</VirtualHost>

第四步：重启Apache

第五步：问题解决
access forbidden!
You don’t have permission to access the requested object. It is either read-protected or not readable by the server.
If you think this is a server error, please contact the webmaster.


这是权限不够，解决办法：打开终端敲入以下信息：
1、cd /Applications/XAMPP/xamppfiles/htdocs 
2、chmod -R 777 *