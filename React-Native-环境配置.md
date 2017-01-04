# React Native 环境配置


## mac环境配置

React Native项目github地址:https://github.com/facebook/react-native
	
React Native项目官网文档:http://facebook.github.io/react-native/docs/getting-started.html


	
	
#### 1. Homebrew安装
##### Homebrew是OS X不可获取的套件管理器，我们可以通过它获取并且安装很多组件,安装方式如下:
	ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"
##### 然后通过命令行执行brew -v进行检查brew是否已经安装成功

	wzhdeMacBook-Air:~ wzh$ brev -v
	Homebrew 0.9.9 (git revision b8e5; last commit 2016-05-19)
	
	
	
#### 2. 安装nvm，查看项目官网官方推送curl或者wget方式安装或者更新nvm:
	第一种:curl方式:
	$ curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.31.0/install.sh | bash
	第二种:wget方式:
	$ wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.31.0/install.sh | bash
	
##### 不过在使用这两种方式之前，我们可以采用brew install curl或者brew install wget来确保已经安装curl或者wget。我这边采用了第一种方式安装

##### 最终我们通过命令行执行nvm  --version检查一下nvm是否已经安装成
	$ nvm --version  //或者 nvm current
一般会在环境变量.bash_profile生成环境配置



### 3. 安装node.js
	$ nvm install node && nvm alias default node
	
##### 会进行安装Node.js最新版本，并且会给我们打个别名，方便使用。通过nvm我们可以安装多个版本的Node.js，并且可以非常轻松的选择不同的版本进行切换使用。

#####【注意】如果现在采用是Node5.0版本的版本，官网是推荐安装npm 2，该版本比npm 3速度更加快。在安装完Node之后，命令行运行npm install  -g npm@2安装即可。




### 4. 安装watchmam，该用于监控bug文件，并且可以触发指定的操作，安装方式如下

	$ brew install  watchman
	
	
### 5. 安装flow,flow是一个 JavaScript 的静态类型检查器，建议安装它，以方便找出代码中可能存在的类型错误，官网:http://www.flowtype.org
	$ brew install flow
	
### 5. react native 安装
	$ npm install -g react-native-cli
	
### 总结：经过以上的5个大步骤我们基本完成React Native从基本环境的搭建工作，下面我们来进行一个实例演示React Native项目的效果





<br/>
## 快速案列

	wzhdeMacBook-Air:RN wzh$ react-native init test
	
### 1. 运行iOS 应用:

	①.命令行执行cd test,路径切换到项目主目录
	②.点击ios/test.xcodeproj进行运行Xocde
	③.使用编辑器进行打开index.ios.js进行相关修改，然后运行应用即可

### 2. 运行Android应用:

	①.命令行执行cd test,路径切换到项目主目录
	②.命令行执行react-native run-android进行加载运行android 应用
	③.同样可以使用编辑器进行打开和修改index.android.js文件，接着通过菜单按钮选择Reload JS来进行刷新修改
	
	
	
### 3. 已存在React Native项目添加Android版本

因为React Native的Android版本的发布要晚于iOS版本，所以有很多接触React Native比较早的应用可能只有iOS版本，我们可以进行如下的操作，给添加Android版本:
	
	①.修改package.json文件来更新react-native到最新版本
	②.运行npm install命令
	③.最后执行以下react-native android命令即可


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	



















