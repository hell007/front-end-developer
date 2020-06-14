## mac下maven的安装配置

本机OS X：10.9

#### 一、将解压后的apache-maven-3.2.1文件夹移到/Users/wzh/Documents/workconfig/maven目录（不存在则新建）下，并重命名为maven3.2.1 
	即：/Users/wzh/Documents/workconfig/maven/maven3.2.1
	参考maven官网的安装指导 http://maven.apache.org/download.cgi#Installation， 并结合其他网友贡献的资料，做以下工作：


#### 二、控制台操作
	1、打开terminal(终端)
	
	2、cd ~ ( 进入当前用户的home目录)
	
	3、open .bash_profile (打开.bash_profile文件，如果文件不存在就  创建文件：touch .bash_profile  编辑文件：open -e bash_profile)
	
	4、直接更改弹出的.bash_profile文件内容
	
	export M2_HOME=/Users/wzh/Documents/workconfig/maven/maven3.2.1
	export PATH=$M2_HOME/bin:$PATH
	
	5、command + s 保存文件，然后关闭
	
	6、在terminal(终端)中输入 source .bash_profile (使用刚才更新之后的内容)
	
	
	新打开一个终端窗口 通过 echo $M3_HOME echo $PATH 可查看刚设置的环境变量


	同时，输入  mvn -version 可以看到maven的版本信息了
	
	7.source .bash_profile


#### 三、重新设置本地Repository的位置 在maven安装目录的conf目录下，vi settings.xml 第54行左右有这么一段：

	  <!-- localRepository
	
	   | The path to the local repository maven will use to store artifacts.
	
	   |
	
	   | Default: ${user.home}/.m2/repository
	
	  <localRepository>/Library/MyConfig/maven/mvnRespo</localRepository>
	
	  -->
	在这段之后依样画葫芦加一行 <localRepository>具体的绝对路径</localRepository> 即可 保存退出


#### 四、maven构建项目

#### 五、maven生成实体类

	项目 右键--》run as --》 maven bulid --》弹出对话框 --》在goals中输入mybatis-generator:generate 或者 点击select --》选择你的mybatis插件 --》apply --》run

#### 六、报错解决

	eclipse中使用maven插件的时候，运行run as maven build的时候报错
	-Dmaven.multiModuleProjectDirectory system propery is not set. Check $M2_HOME environment variable and mvn script match.
	 
	直接的解决方法：使用低版本的maven
	 
	可以设一个环境变量M2_HOME指向你的maven安装目录
	M2_HOME=D:\Apps\apache-maven-3.3.1
	然后在Window->Preference->Java->Installed JREs->Edit
	在Default VM arguments中设置
	-Dmaven.multiModuleProjectDirectory=$M2_HOME

#### 七、mac下maven build时候报错，由于jar包下载出问题原因，可以将windows下maven仓库里的jar包替换mac下maven仓库 OK

#### 八、maven生成实体、mapper、mapper.xml
	1、 借助tk.common.mapper生成 (参照昆花网项目)
	2、生成example(参看freelancework项目)
	

##### 资料

[maven入门教程](http://www.cnblogs.com/jingmoxukong/p/5591368.html)
