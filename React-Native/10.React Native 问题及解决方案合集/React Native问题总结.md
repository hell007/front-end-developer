## React Native 问题收集


####  1. React native配置后，一直'Installing react-native package from npm...'

>关于楼主的问题，建议先设置npm镜像，在命令行下输入以下两条命令（很多人漏了第二条）：
	npm config set registry https://registry.npm.taobao.org
	npm config set disturl https://npm.taobao.org/dist
	如果还不行的话，可以尝试手动安装，看看问题到底出在哪里
	
	
####  2. RCTSRWebSocket.m	

![](http://upload-images.jianshu.io/upload_images/1512008-9a9c4b0bed6b406f.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 将报错行修改成：

	  int result = SecRandomCopyBytes(kSecRandomDefault, keyBytes.length, keyBytes.mutableBytes);
	  assert(result == 0);
##### 上面是我对照Xcode8新建的可用项目代码做的修改，有人提供以下解决方法：
	
	(void)SecRandomCopyBytes(kSecRandomDefault, keyBytes.length, keyBytes.mutableBytes);



####  3. RCTScrollView.m

![](http://upload-images.jianshu.io/upload_images/1512008-675afddffc3fd6c2.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 打开RCTSCrollView.m Command+F 搜索@implementation RCTCustomScrollView 只会搜索到一个结果，然后修改：

	@implementation RCTCustomScrollView
	{
	      RCTRefreshControl *_refreshControl;//不管原来有什么，在原来的基础上加上这句
	}
	
	
#### 4. 在mac上  搭建 React Native  环境，运行 项目 若出现了如下情况。 

![](http://img.blog.csdn.net/20160216171743413?watermark/2/text/aHR0cDovL2Jsb2cuY3Nkbi5uZXQv/font/5a6L5L2T/fontsize/400/fill/I0JBQkFCMA==/dissolve/70/gravity/Center)

##### 请将项目中 AppDelegate.m 中的
	jsCodeLocation = [NSURL URLWithString:@"http://localhost:8081/index.ios.bundle?platform=ios&dev=true"];  

##### 替换为

	jsCodeLocation = [NSURL URLWithString:@"http://127.0.0.1:8081/index.ios.bundle?platform=ios&dev=true"];  
	
原因之一：做本地局域网开发环境，大部分都会做服务器映射处理，localhost 被指向特定的IP 而不是本机的127.0.0.1， 就会出现这样的问题

[react-native 创建新项目红屏解决方法](http://lib.csdn.net/article/reactnative/56113)

	
#### ?. Team && Code signing（推荐方法）

![](http://upload-images.jianshu.io/upload_images/1512008-e29be14ea8c54865.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 选择Team： General--Signing--Team--选择一个可用的Team
注：我在这里选择的是Automatically manage singing，如果你手动配置的话，保证Provisioning Profile可用并匹配即可

![](http://upload-images.jianshu.io/upload_images/1512008-ae319c80a8927e27.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 运行后还是显示这个错误，需要注意，Targets有两个，两个都要设置Team

![](http://upload-images.jianshu.io/upload_images/1512008-597f25cd9915a7d7.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

#### 5.react-native开发踩坑之 ios上react-native-vector-icons 的error：unRecognized font family 'FontAwesome'

>drag the folder Fonts to your project in Xcode

注意是drag，一定要drag吗，是的，必须要把目录通过拖拽的方式添加进去工程目录中，这时候会弹出一个选项弹框，会有Add to targets和Create groups这两项选择，然后点完成就是了（demo,demoTests两个都要勾选）
>android将字体Fonts文件夹复制到android/app/src/main/assets/目录下


#### 6.ios <Iamge /> source={{uri:image}} https:xx显示  、   http:xx不显示
	xcode打开，AllowsArbitraryLoads设置为 YES
	<key>NSAppTransportSecurity</key>
	<dict>
		<key>NSAllowsArbitraryLoads</key>
		<true/>
	</dict>





	

