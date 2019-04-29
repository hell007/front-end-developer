# 配置Cygwin支持git和SSH的使用

## git的安装配置、使用

### git的安装

1、安装git

    apt-cgy install git

2、配置git

(1).由于在windows平台下，所以可以禁止Git对文件权限的跟踪

    git config --system core.fileMode false

(2).解决Git命令输出中文文件名的显示问题

    git config --system core.quotepath false

3.Git命令输出中开启颜色显示

    git config --system color.ui true

4.配置username和email

    git config --global user.name"github用户名"

    git config --global user.email"邮箱"

5.通过命令来查看Git设置

    git config -l


## git的使用

1、克隆
    
    git clone xxx

2、拉取服务器代码
    
    git pull
    
3、查看当前工作目录树的工作修改状态
    
    git status
    
- 状态：

      1：Untracked: 未跟踪, 此文件在文件夹中, 但并没有加入到git库, 不参与版本控制. 通过git add 状态变为Staged.
      2：Modified: 文件已修改, 仅仅是修改, 并没有进行其他的操作.
      3：deleted： 文件已删除，本地删除，服务器上还没有删除.
      4：renamed：

    
4、将状态改变的代码提交至缓存

    git add + 文件
    git add -u + 路径：将修改过的被跟踪代码提交缓存
    git add -A + 路径: 将修改过的未被跟踪的代码提交至缓存
    
- 例如：

      git add -u gulp-waterfall/project/pages
      
将 gulp-waterfall/project/pages 目录下被跟踪的已修改过的代码提交到缓存中

      git add -A gulp-waterfall/project/pages
      
将 gulp-waterfall/project/pages 目录下未被跟踪的已修改过的代码提交到缓存中

5、将代码提交到本地仓库中

    git commit -m "update pages"
    
6、将代码推送到服务器

    git push
    
### git的其他操作
    
1、误将代码提交到缓存中（利用 git add 命令误将代码提交的缓存中）

解决办法：利用 git reset 命令将撤回缓存中的代码。

2、误将代码提交到本地仓库（利用 git commit 命令误将代码提交到本地仓库）

解决办法：

    git reset —soft + 版本号
    
回退到某个版本，只回退了commit的信息，不会改变已经修改过的代码。

    git reset —hard + 版本号
    
彻底回退到某个版本，本地的代码也会改变上一个版本内容

3、删除本地文件后 Git从远程仓库重新获取

删除本地文件后，想从远程仓库中从新Pull最新版文件，Git提示：up-to-date，但未得到删除的文件。

原因：当前本地库处于另一个分支中，需将本分支发Head重置至master.

解决办法1：

    git checkout master 
    git reset --hard

解决办法2：git 强行pull并覆盖本地文件

    git fetch --all  
    git reset --hard origin/master 
    git pull


## ssh的安装配置、使用

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


