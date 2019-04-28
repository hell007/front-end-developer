## 配置Cygwin 支持git和SSH

### git

```
1、安装git

apt-cgy install git

2、配置git

1.由于在windows平台下，所以可以禁止Git对文件权限的跟踪

git config --system core.fileMode false

2.解决Git命令输出中文文件名的显示问题

git config --system core.quotepath false

3.Git命令输出中开启颜色显示

git config --system color.ui true

4.配置username和email

git config --global user.name"github用户名"

git config --global user.email"邮箱"

5.通过命令来查看Git设置

git config -l

```



### ssh

```
1、安装SSH

默认的Cygwin没有安装ssh，所以重新运行http://www.cygwin.com/setup-x86_64.exe

在Select Packages的时候，在search输入ssh，选择openssh:The OpenSSH server and client programs

apt-cyg install openssh

2、配置SSH服务（以管理员身份运行cygwin）

执行：ssh-host-config

Should privilege separation be used?   yes

Do you want to install sshd as a service?  yes

默认确认

Do you want to use a different name?  no

Create new privileged user account 'cyg_server'?  yes

输入密码

启动SSH服务：cygrunsrv  -S  sshd

3、生成SSH Key

ssh-keygen  -t  rsa（密码为空，路径默认）

cp  .ssh/id_rsa.pub  .ssh/authorized_keys

4、登陆测试

ssh  localhost
```

