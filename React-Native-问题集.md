## React Native 问题收集


####  1. React native配置后，一直'Installing react-native package from npm...'

	关于楼主的问题，建议先设置npm镜像，在命令行下输入以下两条命令（很多人漏了第二条）：
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



















<br/><br/><br/><br/><br/><br/><br/><br/>
	
#### ?. Team && Code signing（推荐方法）

![](http://upload-images.jianshu.io/upload_images/1512008-e29be14ea8c54865.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 选择Team： General--Signing--Team--选择一个可用的Team
注：我在这里选择的是Automatically manage singing，如果你手动配置的话，保证Provisioning Profile可用并匹配即可

![](http://upload-images.jianshu.io/upload_images/1512008-ae319c80a8927e27.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)

##### 运行后还是显示这个错误，需要注意，Targets有两个，两个都要设置Team

![](http://upload-images.jianshu.io/upload_images/1512008-597f25cd9915a7d7.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240)










	
	
#### 五、运行项目
	不管是 iOS 还是 Android，在开发调试阶段，都需要在 Mac 上启动一个 HTTP 服务，称为“Debug Server”，默认运行在 8081 端口，APP 通 Debug Server 加载 js。
	iOS 和 Android 的模拟器，连接 Mac 本机的服务都很方便。但是通过 USB 或者 WiFi 连接调试，就稍微麻烦一些了。
	iOS
	还是非常简单，XCode 打开项目，点击运行就好。修改 index.ios.js, 在模拟器中 ⌘ + R 重新载入 js 即可看到相应的变化。
	iOS 真机调试也简单，修改HTTP地址即可。
	
	jsCodeLocation = [NSURL URLWithString:@"http://localhost:8081/index.ios.bundle"];
	
	Android
	按照官方文档，需要一个模拟器（Genymotion模拟器也可以）。但是不像 iOS，Android 开发平时更多是直接用真机进行开发和调试，如何运行部署到真机，下面会提到。
	运行命令：
	
	react-native run-android
	
	然后就会部署到模拟器，修改 index.android.js ，调出模拟器菜单键，选择重新载入 js 即可看到变化。
	
	Android 真机调试
	示例 App 直接部署到真机，红色界面报错，无法连接到 Debug Server。
	如果是 5.0 或者以上机型，可通过 adb 反向代理端口，将 Mac 端口反向代理到测试机上。
	
	adb reverse tcp:8081 tcp:8081
	
	如果 5.0 以下机器，应用安装到测试机上之后，摇动设备，在弹出菜单中选择 Dev Setting > Debug Server host for device，然后填入 Mac 的 IP 地址（ifconfig 命令可查看本机 IP）
	关于修改 DevHelper 来进行和 iOS 一样的开发调试，后续关于热部署时，我会介绍到。 
	
	在 Android Studio 中调试开发
	我们可能希望在 Android Studio 打开项目，然后编译部署到真机。
	这个时候，在命令行启动 Debug Server 即可：

	react-native start