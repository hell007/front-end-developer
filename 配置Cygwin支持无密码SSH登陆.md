## 配置Cygwin支持无密码SSH登陆

```
1、安装SSH

默认的Cygwin没有安装ssh，所以重新运行http://www.cygwin.com/setup-x86_64.exe

在Select Packages的时候，在search输入ssh，选择openssh:The OpenSSH server and client programs

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
