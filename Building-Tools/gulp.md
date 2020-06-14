## nodejs and gulp for mac 使用

#### 1.安装  傻瓜式安装，默认安装的路径为 /usr/local/bin/node

#### 2.终端输入  node -v    npm -v  可以查看版本  新版本node默认集成了npm模块

#### 3. 终端输入 which node 命令可以查看node的安装路径  cmd+shift+g 打开路径目录

#### 4.设置终端默认数据源为淘宝镜像(换镜像)
终端输入 npm config set registry https://registry.npm.taobao.org
命令

#### 5.终端输入 npm config ls 命令查看设置信息列表

	wzhdeMacBook-Air:~ wzh$ npm config ls
	; cli configs
	user-agent = "npm/3.3.12 node/v5.3.0 darwin x64"
	
	; userconfig /Users/wzh/.npmrc
	registry = "https://registry.npm.taobao.org/"
	
	; node bin location = /usr/local/bin/node
	; cwd = /Users/wzh
	; HOME = /Users/wzh
	; "npm config ls -l" to show all defaults


#### 6.npm版本升级
githup仓库上下载稳定发布的版本后，将本地npm里面的全部文件替换，即升级ok

#### 7.安装gulp 命令行工具
终端输入 npm install -g gulp 命令
-g 指的是在全局作用域中安装
gulp -v 测试版本号

错误一：在安装过程中会报没有读写权限的错
1. cd 你的文件夹路径的上一级目录。
2. sudo chmod -R 777 你的文件夹名。
3. 输入密码。
4.成功。
错误二：Please try running this command again as root/Administrator
是因为在mac下运行此命令需要以管理员身份
终端输入 sudo npm install -g gulp 命令解决问题，安装成功

sudo vi /etc/hosts
即可   sudo  ＝  super user do

#### 8.gulp使用
新建项目code目录文件夹
将该文件夹在终端窗口中打开（让目录路径显示在终端）
输入 npm init 命令  操作如下：

wzhdeMacBook-Air:node wzh$ npm init
This utility will walk you through creating a package.json file.
It only covers the most common items, and tries to guess sensible defaults.

See `npm help json` for definitive documentation on these fields
and exactly what they do.

Use `npm install <pkg> --save` afterwards to install a package and
save it as a dependency in the package.json file.

Press ^C at any time to quit.
name: (code)
version: (1.0.0)
description: gulp demo
entry point: (index.js)
test command:
git repository:
keywords: gulp,demo,study
author: wzh
license: (ISC)
About to write to /Users/wzh/Documents/node/package.json:

{
  "name": "code",
  "version": "1.0.0",
  "description": "gulp demo",
  "main": "index.js",
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1"
  },
  "keywords": [
    "gulp",
    "demo",
    "study"
  ],
  "author": "wzh",
  "license": "ISC"
}


Is this ok? (yes) yes

然后在node文件夹下产生package.json文件

#### 9.在node文件夹目录下安装gulp
终端输入 sudo npm install gulp —-save 命令
 注意：第一次目录叫node，然后命令是失败，不知道？？？

#### 10.gulp的使用

新建 gulpfile.js  ,进行下列代码测试 （windows系统下运行的代码）

var gulp = require('gulp');

//1.默认的default任务
gulp.task('default',function(){
	console.log('gulp任务开始了');
});

//2.文件的复制拷贝  gulp.src  gulp.dest
//string array
//复制一个目录下文件
//gulp.src('m_app/js/**/*.js')
	//.pipe(minify()) //需要安装插件
	//.pipe(gulp.dest('one/js/'));
	
//用array复制多个目录下文件
//gulp.src(['m_app/js/**/*.js','m_app/css/**/*.css'])
	//.pipe(gulp.dest('many/'));
	
//复制整个项目下文件
//gulp.src('m_app/**/*')
	//.pipe(gulp.dest('dev/'));
	
//3.创建任务 gulp.task
//调用任务命令 gulp some
gulp.task('some',function(){
	gulp.src('m_app/**/*')
		.pipe(gulp.dest('taskdev'));
});

//测试任务
gulp.task('print',function(){
	console.log('print 1111');
});

//在完成依赖任务 some print之后才执行mytask
gulp.task('mytask', ['some','print'], function() {
  console.log('2222');
});


//4.监视  gulp.watch
//watch的书写一
//var watcher = gulp.watch('m_app/js/**/*.js');
//watcher.on('change', function(event) {
 // console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
//});

//以任务方式执行watch
gulp.task('watcher',function(){
	gulp.watch('m_app/js/**/*.js')
		.on('change', function(event) {
			console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
		});
});


//5.案列演示
//gulp本身不提供js压缩合并等功能，需要使用gulp的相关插件。目前只需要完成js压缩合并和css文件压缩的功能，先安装相应的插件：

1.css压缩 　　gulp-minify-css
2.js压缩　　　gulp-uglify
3.js合并　　　gulp-concat　　
由于压缩之前需要对js代码进行代码检测，压缩完成之后需要加上min的后缀，我们还需要安装另外两个插件：
4.重命名　　   gulp-rename
5.js代码检测　 gulp-jshint　(或gulp-jslint)
(更多插件可以查看 http://gulpjs.com/plugins/ )
在项目根目录下执行以下命令：
npm install gulp-minify-css gulp-uglify gulp-concat gulp-rename gulp-jshint --save-dev
//mac终端输入指令 sudo npm install gulp-minify-css gulp-uglify gulp-concat gulp-rename gulp-jshint --save-dev

//注意：mac下运行上面插件安装后，gulp-jshint安装错误 
//可能与其他有关  node -v  5.3   npm -v  3.3.12   gulp -v  3.9
//出错安装： sudo npm install jshint gulp-jshint --save-dev
正确安装方式为：sudo npm install --save-dev jshint gulp-jshint (******)

安装好的插件会出现在上面提到的node_modules文件夹中


//6.压缩css gulp-minify-css

var gulp = require('gulp'),
	minifycss = require('gulp-minify-css');

//默认的default任务
gulp.task('default',function(){
	console.log('css压缩任务开始了');
});

//文件的复制拷贝  gulp.src  gulp.dest
//string array
//复制一个目录下文件
gulp.src('m_app/css/**/*.css')
	.pipe(minifycss()) //css压缩
	.pipe(gulp.dest('one/css/'));


//7.压缩js gulp-uglify

var gulp = require('gulp'),
	uglify = require('gulp-uglify');

//默认的default任务
gulp.task('default',function(){
	console.log('js压缩任务开始了');
});

//文件的复制拷贝  gulp.src  gulp.dest
//string array
//复制一个目录下文件
gulp.src('m_app/js/**/*.js')
	.pipe(uglify()) //压缩
	.pipe(gulp.dest('one/js/'));


//8.合并 js gulp-concat

var gulp = require('gulp'),
	concat = require('gulp-concat');

//默认的default任务
gulp.task('default',function(){
	console.log('js合并任务开始了');
});

//文件的复制拷贝  gulp.src  gulp.dest
//string array
//复制一个目录下文件
gulp.src('m_app/js/**/*.js')
	.pipe(concat('main.js')) //合并
	.pipe(gulp.dest('one/js/'));


//9.合并压缩 js  gulp-concat gulp-uglify

var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify');

//默认的default任务
gulp.task('default',function(){
	console.log('js合并压缩任务开始了');
});

//文件的复制拷贝  gulp.src  gulp.dest
//string array
//复制一个目录下文件
gulp.src('m_app/js/**/*.js')
	.pipe(concat('main.js')) //合并
	.pipe(uglify())//压缩
	.pipe(gulp.dest('one/js/'));


//10.重命名js gulp-rename

var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	rename = require('gulp-rename');

//默认的default任务
gulp.task('default',function(){
	console.log('js合并压缩任务开始了');
});

//文件的复制拷贝  gulp.src  gulp.dest
//string array
//复制一个目录下文件
gulp.src('m_app/js/**/*.js')
	.pipe(concat('main.js')) //合并
	.pipe(rename({suffix:'.min'}))//重命名
	.pipe(uglify())//压缩
	.pipe(gulp.dest('one/js/'));


//11.检测js  gulp-jshint

var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	rename = require('gulp-rename'),
	jshint = require('gulp-jshint');

//js检测
gulp.task('jshint',function(){
	return gulp.src('m_app/js/**/*.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'));
});

//合并压缩js
gulp.task('minifyjs',function(){
	return gulp.src('m_app/js/**/*.js')
		.pipe(concat('main.js')) //合并
		.pipe(rename({suffix:'.min'}))//重命名
		.pipe(uglify())//压缩
		.pipe(gulp.dest('one/js/'));//输出
});

//默认的default任务
gulp.task('default',['jshint'],function(){
	console.log('js检查合并压缩任务开始了');
	gulp.start('minifyjs');
});

//12.css js检测 合并压缩案列

var gulp = require('gulp'),
	minifycss = require('gulp-minify-css'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	rename = require('gulp-rename'),
	jshint = require('gulp-jshint');

//js检测
gulp.task('jshint',function(){
	return gulp.src('m_app/js/**/*.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'));
});

//压缩css
gulp.task('minifycss',function() {
    return gulp.src('m_app/**/*.css')
        .pipe(rename({suffix:'.min'}))//重命名
        .pipe(minifycss())   //压缩
        .pipe(gulp.dest('dev/')); 
        //dev/css/  不必在后面添加css/，因为会默认把m_app下面的含有.css样式表的目录名称创建在dev目录下面，
        //并且名字与m_app中css目录名称一致
        //dev/css  如果m_app中含有多个css样式文件夹，可以用dev/css/把他们都放在dev的css文件下
});
    
//合并压缩js
gulp.task('minifyjs',function(){
	return gulp.src('m_app/js/**/*.js')
		.pipe(concat('main.js')) //合并
		.pipe(rename('app.min.js'))//重命名
		.pipe(uglify())//压缩
		.pipe(gulp.dest('dev/js/'));//输出
});

//默认的default任务
gulp.task('default',['jshint'],function(){
	console.log('js检查合并压缩任务开始了');
	gulp.start('minifycss','minifyjs');
});












