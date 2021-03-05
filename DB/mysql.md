## mysql

1、卸载

```
sudo rm /usr/local/mysql
sudo rm -rf /usr/local/mysql*
sudo rm -rf /Library/StartupItems/MySQLCOM
sudo rm -rf /Library/PreferencePanes/My*
rm -rf ~/Library/PreferencePanes/My*
sudo rm -rf /Library/Receipts/mysql*
sudo rm -rf /Library/Receipts/MySQL*
sudo rm -rf /var/db/receipts/com.mysql.*
```

[Mac下干净彻底地卸载 MySQL](https://www.jianshu.com/p/276c1271ae14)



2、brew安装 / dmg手动安装

```
# 先搜索可安装版本
brew search mysql
# 安装mysql
brew install mysql@5.7
# 安装 brew 服务
brew tap homebrew/services
# 加载和启动mysql服务
brew services start mysql@5.7
# 检查mysql服务是否已加载
brew services list 
# 强制链接5.7版本
brew link mysql@5.7 --force
# 验证安装mysql 是否成功
mysql -V
# 初始化密码 更改你自己密码 
mysqladmin -u root password 'admin123'
```

[Mac中使用brew安装mysql](https://www.cnblogs.com/georgeleoo/p/11478416.html)



3、Navicat 连接 mysql



```

找到安装目录：cd /usr/local/mysql/bin/

 登录：./mysql -u root -p

1、use mysql;

2、alter user 'root'@'localhost' identified with mysql_native_password by 'admin123';

3、flush privileges;

然后连接;
```



[Mac Navicat连接Mysql8.0版本报错解决方案](https://blog.csdn.net/u014205434/article/details/113743631)



