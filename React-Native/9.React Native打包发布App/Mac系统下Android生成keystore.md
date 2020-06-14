## Mac系统下Android生成keystore

##### 1.首先打开终端,输入  cd /Library/Java/Home/bin/

##### 2.然后这步很关键，由于我们用的是当前用户，所以没有最高权限，不能在Library文件夹下生成任何文件，所以照抄网上的方法是无法创建成功的，复制粘贴步骤4的内容

	keytool -genkey -v -keystore test.keystore -alias test -keyalg RSA -validity 20000 -keystore /Users/wzh/test.keystore

	test : keystore的alias 
	20000 : keystore的有效天数 
	test.keystore： keystore的名称
	
##### 3.填写密钥口令和基本信息
	输入密钥库口令:  
	再次输入新口令: 
	您的名字与姓氏是什么?
	  [Unknown]:  wzh
	您的组织单位名称是什么?
	  [Unknown]:  myself
	您的组织名称是什么?
	  [Unknown]:  myself
	您所在的城市或区域名称是什么?
	  [Unknown]:  kunming
	您所在的省/市/自治区名称是什么?
	  [Unknown]:  yunan
	该单位的双字母国家/地区代码是什么?
	  [Unknown]:  china
	CN=wzh, OU=myself, O=myself, L=kunming, ST=yunan, C=china是否正确?
	  [否]:  Y
	
	正在为以下对象生成 2,048 位RSA密钥对和自签名证书 (SHA256withRSA) (有效期为 20,000 天):
		 CN=wzh, OU=myself, O=myself, L=kunming, ST=yunan, C=china
	输入 <testapp> 的密钥口令
		(如果和密钥库口令相同, 按回车):  
	[正在存储/Users/wzh/test.keystore]


	第一次输入的密钥口令是test.keystore的密码 
	设置完信息以后再次输入的密钥口令是alias的密码 
	问你是否正确的时候选y/n，分别代表yes/no，如果选no，重新来过
	
##### 4.查看已生成的keystore

	keytool -list -v -keystore /Users/wzh/test.keystore -storepass wzhtest
	
	/Users/wzh/test.keystore： keystore的绝对路径 
	wzhtest ： keystore的密钥，注意不是alias
	MD5后面的一串去掉：，然后小写就是你需要的keystore签名


