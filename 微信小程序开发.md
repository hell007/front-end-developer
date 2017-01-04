# 微信小程序开发

## 基础篇

[在线文档](https://mp.weixin.qq.com/debug/wxadoc/dev/?t=20161107)
### 1.项目结构

	images文件夹 
	pages文件夹 
	utils文件夹 
	主体部分
	app.js
	app.json
	app.wxss
	其中pages文件夹里面是各个小程序页面，每个小程序页面由四个文件
	js,
	wxml,
	wxss,
	json组成


### 2.各个文件用途
#### 主体部分：
	app.js	是	小程序逻辑 
	app.json	是	小程序公共设置 
	app.wxss	否	小程序公共样式表 

#### 页面：
	js	是	页面逻辑
	wxml	是	页面结构 
	wxss	否	页面样式表 
	json	否	页面配置 

<p style="color:red">注意：为了方便开发者减少配置项，微信规定描述页面的这四个文件必须具有相同的路径与文件名。</p>

### 3.配置
	app.json文件来对微信小程序进行全局配置，
	决定页面文件的路径、
	窗口表现、（比如状态栏的文字颜色背景等）
	设置网络超时时间、
	设置多 tab <比如底部的tabBar>等

### 4.逻辑层
#### 4.1 注册程序<br/>
* App() 函数用来注册一个小程序。接受一个 object 参数，其指定小程序的生命周期函数等<br/>
* App() 必须在 app.js 中注册，且不能注册多个<br/>
* 页面通过  var app = getApp() 来获取实例

#### 4.2 注册页面<br/>
* Page() 函数用来注册一个页面。接受一个 object 参数，其指定页面的初始数据、生命周期函数、事件处理函数等


#### 4.3 模块化<br/>
* 将一些公共的代码抽离成为一个单独的 js 文件，作为一个模块。模块只有通过 module.exports 或者 exports 才能对外暴露接口
* 参看 util/api


### 5.视图层

#### 5.1 WXML(WeiXin Markup language)用于描述页面的结构 
支持数据绑定、条件渲染、列表渲染、模板、事件、引用

##### 5.1.1  数据绑定
	<view> {{ message }} </view>

##### 5.1.2  条件渲染
	<view wx:if="{{length > 5}}"> 1 </view>
	<view wx:elif="{{length > 2}}"> 2 </view>
	<view wx:else> 3 </view>

##### 5.1.3  列表渲染
	<view wx:for="{{list}}" wx:for-index="index" wx:for-item="item">
		{{index}}: {{item.name}}
	</view>

##### 5.1.4  模板  注意：is  vs name
	<template is="isList" data="{{list}}"/>

	<template name="isList">
		<view wx:for="{{list}}" wx:for-index="index" wx:for-item="item">
			{{index}}: {{item.name}}
		</view>
	</template>

##### 5.1.5  事件 
###### 事件分为冒泡事件和非冒泡事件：
冒泡事件：当一个组件上的事件被触发后，该事件会向父节点传递。如touch* 事件、tap事件 <br/>
非冒泡事件：当一个组件上的事件被触发后，该事件不会向父节点传递。如form的submit事件，input的input事件，scroll-view的scroll事件 <br/>


##### 注意：bind事件绑定不会阻止冒泡事件向上冒泡，catch事件绑定可以阻止冒泡事件向上冒泡 <br/>

	<view id="middle" catchtap="handleTap2">
		middle view
		<view id="inner" bindtap="handleTap3">
			inner view
		</view>
	</view>

##### 5.1.6  引用
`<import src="template/list.wxml"/>`




#### 5.2 WXSS(WeiXin Style Sheets)是一套样式语言，用于描述 WXML 的组件样式

##### 5.2.1 WXSS 具有 CSS 大部分特性 

##### 5.2.2 background-img 只能使用网络图片

##### 5.2.3 尺寸单位 rpx（responsive pixel）: 可以根据屏幕宽度进行自适应。规定屏幕宽为750rpx。如在 iPhone6 上，屏幕宽度为375px，共有750个物理像素，则750rpx = 375px = 750物理像素，1rpx = 0.5px = 1物理像素

<p style="color:red;">注意：开发微信小程序时设计师可以用 iPhone6 作为视觉稿的标准，那么我们就可以 1px = 2rpx </p>


#### 6.组件
##### 6.1 试图容器
	view 视图容器 === div 
	scroll-view 可滚动视图区域  用于下拉加载布局 galleryn画廊布局 
	swiper 滑块视图容器  用于bannnar布局  

##### 6.2 基础内容
	icon 图标 
	text 文本  
	progress 进度条 

##### 6.2 表单组件
	button 
	checkbox 
	form 
	input 
	picker 
	label 
	radio 
	slider 
	switch 
	textarea 
	操作反馈 === 即将废弃
	导航 
	地图 
	画布 
	媒体组件 image audio video 
	
##### image mode有12种模式，其中3种是缩放模式，9种是裁剪模式 <br/>
	scaleToFill	不保持纵横比缩放图片，使图片的宽高完全拉伸至填满 image 元素 
	aspectFit	保持纵横比缩放图片，使图片的长边能完全显示出来。也就是说，可以完整地将图片显示出来 
	aspectFill	保持纵横比缩放图片，只保证图片的短边能完全显示出来。也就是说，图片通常只在水平或垂直方向是完整的，另一个方向将会发生截取 




#### 7.api 和 其他



## 实战篇

### 1.app.json配置详解

### 2.app.js引入工具类，设置全局对象或全局模块

### 3.swiper组件

	<swiper indicator-dots="{{indicatorDots}}"
	  autoplay="{{autoplay}}" interval="{{interval}}" duration="{{duration}}">
	  <block wx:for="{{imgUrls}}">
	    <swiper-item>
	      <image src="{{item}}" class="slide-image" />
	    </swiper-item>
	  </block>
	</swiper>

### 滑块视图容器
	属性名	类型	默认值	说明
	indicator-dots	Boolean	false	是否显示面板指示点 
	autoplay	Boolean	false	是否自动切换 
	current	Number	0	当前所在页面的 index 
	interval	Number	5000	自动切换时间间隔 
	duration	Number	1000	滑动动画时长 
	bindchange	EventHandle		current 改变时会触发 change 事件，event.detail = {current: current} 

#### 用途：banner布局, splash页面布局 

### 4.scroll-view组件

	<scroll-view class="scroll-view" scroll-x="true" >
		<view class="box">
			<navigator url="../news/news?id={{vo.id}}&image={{vo.images}}">
			    <view class="item">
				    <image src="{{vo.images}}" mode="aspectFill"/>
				    <text>{{vo.title}}</text>
			    </view>
			</navigator>
		</view>
	</scroll-view>

### 可滚动视图区域
	属性名	类型	默认值	说明
	scroll-x	Boolean	false	允许横向滚动
	scroll-y	Boolean	false	允许纵向滚动
	upper-threshold	Number	50	距顶部/左边多远时（单位px），触发 scrolltoupper 事件
	lower-threshold	Number	50	距底部/右边多远时（单位px），触发 scrolltolower 事件
	scroll-top	Number		设置竖向滚动条位置
	scroll-left	Number		设置横向滚动条位置
	scroll-into-view	String		值应为某子元素id，则滚动到该元素，元素顶部对齐滚动区域顶部
	bindscrolltoupper	EventHandle		滚动到顶部/左边，会触发 scrolltoupper 事件
	bindscrolltolower	EventHandle		滚动到底部/右边，会触发 scrolltolower 事件
	bindscroll	EventHandle		滚动时触发，event.detail = {scrollLeft, scrollTop, scrollHeight, scrollWidth, deltaX, deltaY}

#### 用途：下拉加载布局 galleryn画廊布局


### 5.页面跳转

#### 5.1 通过bindtap事件跳转
	<view class="section">
		<view class="section-header" bindtap="bindMoreTap">
		  <text class="fl title">今日头条</text>
		  <text class="fr more"> >> </text>
		</view>
		<scroll-view class="scroll-view" scroll-x="true" >
		  <view class="box">
		    <template is="header-list" data="{{headerList}}" />
		  </view>
		</scroll-view>
	</view>
	
##### 说明
	1.wxml视图层中绑定事件 bindtap="bindMoreTap"
	2.js逻辑中调用导航api
	//查看更多
	bindMoreTap: function(){
		wx.navigateTo({
			url:'../waterfall/waterfall'
		})
	}
	
	或者：
	wx.redirectTo({
	  url:'../waterfall/waterfall'
	})
	
#####  wx.navigateTo vs  wx.redirectTo 区别
	wx.navigateTo(OBJECT)
	保留当前页面，跳转到应用内的某个页面，使用wx.navigateBack可以返回到原页面
	wx.redirectTo(OBJECT)
	关闭当前页面，跳转到应用内的某个页面
	
	注意：为了不让用户在使用小程序时造成困扰，我们规定页面路径只能是五层，请尽量避免多层级的交互方式
	
	
#### 5.2 通过navigator url链接跳转
	
	<scroll-view class="scroll-view" scroll-x="true" >
		<view class="box">
			<navigator url="../news/news?id={{vo.id}}&image={{vo.images}}">
			    <view class="item">
				    <image src="{{vo.images}}" mode="aspectFill"/>
				    <text>{{vo.title}}</text>
			    </view>
			</navigator>
		</view>
	</scroll-view>
	
	
#### 6 传参、接收参数

##### 6.1 传参
	
	<navigator url="../news/news?id={{vo.id}}&image={{vo.images}}">
	    <view class="item">
		    <image src="{{vo.images}}" mode="aspectFill"/>
		    <text>{{vo.title}}</text>
	    </view>
	</navigator>

##### 6.2 接收参数
	js逻辑层的onLoad方法
	
	onLoad:function(options){
		//获取参数
	    console.log(options.id)
	    console.log(options. image)
	 }

##### 6.3 表单参数

##### 6.3.1 提交参数
	<form bindsubmit="formSubmit" bindreset="formReset" report-submit="true">
        <view class="item">
            <view class="user">用户：</view>
            <input type="text" name="name" placeholder-class="color" placeholder="请输入用户名称" value="admin" />
        </view>
        <view class="item">
            <view class="pwd">密码：</view>
            <input password name="passwd" placeholder-class="color" placeholder="请输入密码" value="admin" />
        </view>
        <view class="item">
            <view class="remeber">记住密码:</view>
            <switch checked name="remeber"/>
        </view>
        <view class="item-btn">
            <button formType="submit">登录</button>
            <button formType="reset">重置</button>
        </view>
    </form>
    
##### 6.3.2 接收参数
	//表单提交  e.detail.value是一个对象{}
	  formSubmit: function(e) {
	    //console.log('form发生了submit事件，携带数据为：', e.detail.value)
	    var u = e.detail.value;
	  },
	  
	  
#### 7.网络请求 
	wx.request({
	  url: 'test.php', //仅为示例，并非真实的接口地址
	  data: {
	     name: 'admin' ,
	     pwd : '123456'
	  },
	  header: {
	      'Content-Type': 'application/json'
	  },
	  success: function(res) {
	  	//请求成功操作
	    console.log(res.data)
	  }
	})
	

##### wx.request发起的是https请求。一个微信小程序，同时只能有5个网络请求连接。
	
	参数名	类型	必填	说明
	url	String	是	开发者服务器接口地址
	data	Object、String	否	请求的参数
	header	Object	否	设置请求的 header , header 中不能设置 Referer
	method	String	否	默认为 GET，有效值：OPTIONS, GET, HEAD, POST, PUT, DELETE, TRACE, CONNECT
	success	Function	否	收到开发者服务成功返回的回调函数，res = {data: '开发者服务器返回的内容'}
	fail	Function	否	接口调用失败的回调函数
	complete	Function	否	接口调用结束的回调函数（调用成功、失败都会执行）


















