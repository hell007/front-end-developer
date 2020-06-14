# mac下使用github


## git使用前准备工作

### 1.安装git 
	
### 2.注册git账号  //hell007  aiyu****
	
### 3.创建ssh
	
### 4.在github中添加ssh（如图示）：

### 5.检测本地是否可以连接github




## github在线创建远程仓库
	1.首先，登陆GitHub，然后，在右上角找到“Create a new repo”按钮（点击右侧头部 + 号， ），创建一个新的仓库


## 本地创建仓库
### 1.创建空目录
	$ mkdir mynotes
	$ cd my notes
	$ pwd
	/Users/git/mynotes
	pwd命令用于显示当前目录。在我的Mac上，这个仓库位于/Users/git/mynotes

### 2.通过git init命令把这个目录变成Git可以管理的仓库：
	$ git init
	Initialized empty Git repository in /Users/michael/learngit/.git/
	
	瞬间Git就把仓库建好了，而且告诉你是一个空的仓库（empty Git repository），细心的读者可以发现当前目录下多了一个.git的目录，这个目录是Git来跟踪管理版本库的，没事千万不要手动修改这个目录里面的文件，不然改乱了，就把Git仓库给破坏了。
	如果你没有看到.git目录，那是因为这个目录默认是隐藏的，用ls -ah命令就可以看见。

### 3. 编写一个readme.txt文件，内容如下：
	//常规操作
	Git is a version control system.
	Git is free software.
	一定要放到learngit目录下（子目录也行），因为这是一个Git仓库，放到其他地方Git再厉害也找不到这个文件。
	
	注意：使用命令创建文件方法如下
	$ touch readme.txt
	$ vi read.txt
	i    //insert
	输入内容
	esc  //退出编辑
	:wq  //保存
	enter //执行


### 4.用命令git add命令告诉Git，把文件添加到仓库：
	$ git add readme.txt

### 5.用命令git commit告诉Git，把文件提交到仓库：
	$ git commit -m “submit”

	注意：为什么Git添加文件需要add，commit一共两步呢？因为commit可以一次提交很多文件，所以你可以多次add不同的文件，比如：
	$ git add file1.txt
	$ git add file2.txt file3.txt
	$ git commit -m "add 3 files."

### 6.连接远程github项目，将本地项目更新到github项目上去
	$ git remote add origin https://github.com/hell007/mynotes.git     //连接远程github项目  
	$ git push -u origin master     //将本地项目更新到github项目上去
	
	注意：
	(1) # git remote add origin https://github.com/hell007/myApp.git
		#fatal: remote origin already exists.
	git remote add origin https://github.com/hell007/mynotes.git 如果出错，请参看疑难问题分析和解决
	
	（2）git push -u origin master 第一次更新项目命令需要 -u ,
		以后更新只需要 git push origin master 即可，不要 -u


## 克隆远程仓库到本地

### 1.git clone //克隆
	$ cd git //切换到git目录
	$ ls 
	$ cd mynotes
	$ git clone  https://github.com/hell007/mynotes.git

### 2.修改文件

	$ vi readme.txt 
	命令修改文件或者常规文件操作
	
	注意：
	$ git diff readme.txt //查看提交的文件是否有变化
	$ git status

### 3.提交
	$ git add readme.txt 
	git commit -m “submit”  //每次提交都要先add filename ,然后commit -m “描述"

### 4.更新
	git push origin master //不用-u


## 其他命令

### 1.git status
	$ git status 命令可以让我们时刻掌握仓库当前的状态
	任何命名操作之后都可以输入该命令查看动态

### 2.git diff
	$ git diff 命令可以查看文件的不同，可以看出是否有更改

### 3.版本回退
	git log 查看提交日志详细信息  //q 键退出
	git log —pretty=online 查看提交日志简单信息（可以看到commit id）
	
	git reset —hard HEAD^ //回退到当前版本
	git reset —hard 253453 //253453是commit id ,可以由git log看到
	cat read.txt

注意：版本回退值影响本地文件，不影响远程仓库

### 4.撤销修改 
	git checkout — read.txt  //让文件回到最近一次git commit或git add时的状态

### 5.删除文件

	a.一是确实要从版本库中删除该文件，那就用命令git rm删掉，并且git commit：
	$ git rm readme.txt   // git rm -r build/  //删除文件夹
	rm 'readme.txt'
	$ git commit -m "remove readme.txt"
	
	b.另一种情况是删错了，因为版本库里还有呢，所以可以很轻松地把误删的文件恢复到最新版本：
	$ git checkout -- readme.txt
	//git checkout其实是用版本库里的版本替换工作区的版本，无论工作区是修改还是删除，都可以“一键还原”


## 分支管理

	Git鼓励大量使用分支：

	查看分支：git branch
	创建分支：git branch dev
	切换分支：git checkout dev
	创建+切换分支：git checkout -b dev
	合并某分支到当前分支：git merge dev
	删除分支：git branch -d dev



### 1.实战练习
	//首先，我们创建dev分支，然后切换到dev分支：
	$ git checkout -b dev
	Switched to a new branch 'dev'
	git checkout命令加上-b参数表示创建并切换，相当于以下两条命令：
	
	$ git branch dev
	$ git checkout dev
	Switched to branch 'dev'
	//然后，用git branch命令查看当前分支：
	
	$ git branch
	* dev
	  master
	//git branch命令会列出所有分支，当前分支前面会标一个*号。
	//然后，我们就可以在dev分支上正常提交，比如对readme.txt做个修改，加上一行：
	//Creating a new branch is quick.
	//然后提交：
	
	$ git add readme.txt 
	$ git commit -m "branch test"
	[dev fec145a] branch test
	 1 file changed, 1 insertion(+)
	//现在，dev分支的工作完成，我们就可以切换回master分支：
	
	$ git checkout master
	Switched to branch 'master'
	
	//现在，我们把dev分支的工作成果合并到master分支上：
	
	$ git merge dev
	Updating d17efd8..fec145a
	Fast-forward
	 readme.txt |    1 +
	 1 file changed, 1 insertion(+)
	//git merge命令用于合并指定分支到当前分支。合并后，再查看readme.txt的内容，就可以看到，和dev分支的最新提交是完全一样的。
	//注意到上面的Fast-forward信息，Git告诉我们，这次合并是“快进模式”，也就是直接把master指向dev的当前提交，所以合并速度非常快。
	//当然，也不是每次合并都能Fast-forward，我们后面会讲其他方式的合并。
	//合并完成后，就可以放心地删除dev分支了：
	
	$ git branch -d dev
	Deleted branch dev (was fec145a).
	//删除后，查看branch，就只剩下master分支了：
	
	$ git branch
	* master
	//因为创建、合并和删除分支非常快，所以Git鼓励你使用分支完成某个任务，合并后再删掉分支，这和直接在master分支上工作效果是一样的，但过程更安全。




## 疑难问题分析和解决
  	如果输入$ git remote add origin git@github.com:djqiang（github帐号名）/gitdemo（项目名）.git 
    提示出错信息：fatal: remote origin already exists.
    解决办法如下：
    1、先输入$ git remote rm origin
    2、再输入$ git remote add origin git@github.com:djqiang/gitdemo.git 就不会报错了！
    3、如果输入$ git remote rm origin 还是报错的话，error: Could not remove config section 'remote.origin'. 我们需要修改gitconfig文件的内容
    4、找到你的github的安装路径，我的是C:\Users\ASUS\AppData\Local\GitHub\PortableGit_ca477551eeb4aea0e4ae9fcd3358bd96720bb5c8\etc
    5、找到一个名为gitconfig的文件，打开它把里面的[remote "origin"]那一行删掉就好了！
 
 
    如果输入$ ssh -T git@github.com     出现错误提示：Permission denied (publickey).因为新生成的key不能加入ssh就会导致连接不上github。
    解决办法如下：
    1、先输入$ ssh-agent，再输入$ ssh-add ~/.ssh/id_key，这样就可以了。
    2、如果还是不行的话，输入$ ssh-add ~/.ssh/id_key 命令后出现报错Could not open a connection to your authentication agent.解决方法是key用Git Gui的ssh工具生成，这样生成的时候key就直接保存在ssh中了，不需要再ssh-add命令加入了，其它的user，token等配置都用命令行来做。
    3、最好检查一下在你复制id_rsa.pub文件的内容时有没有产生多余的空格或空行，有些编辑器会帮你添加这些的。
 
 
    如果输入$ git push origin master
    提示出错信息：error:failed to push som refs to .......
    解决办法如下：
    1、先输入$ git pull origin master //先把远程服务器github上面的文件拉下来
    2、再输入$ git push origin master
    3、如果出现报错 fatal: Couldn't find remote ref master或者fatal: 'origin' does not appear to be a git repository以及fatal: Could not read from remote repository.
    4、则需要重新输入$ git remote add origingit@github.com:djqiang/gitdemo.git 
 
 
 
 


 
 
 
 
 
 
 
 
 
 
 
 
