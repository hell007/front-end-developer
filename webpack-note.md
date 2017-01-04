## webpack入门教程  

[webpack 入门](http://html-js.com/article/3113)

### 1. 安装
	npm install -g webpack
	
### 2. 基本使用
	假设项目文件结构如下：
	/app  
	  |--index.html
	  |--js
	  	|--main.js
	  	|--mod.js
	  |--css
	  	|--style.css
	  	|--index.css
 
#### index.html代码如下：

	<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <title>Document</title>
	</head>
	<body>
	    <script src="./js/out/app.js"></script>
	</body>
	</html>


#### main.js和mod.js代码如下：

	// main.js
	require('./js/mod.js')();

	// mod.js
	module.exports = function() {
	    document.write('hello webpack');
	};

然后执行命令：

<pre>webpack main.js app.js</pre>
会打包生成app.js文件。

### 3. 配置文件

每次手动输入源文件名和输出文件名比较麻烦，可以使用配置文件来进行管理。在app目录下新建webpack.config.js文件，内容如下：
<pre>
	module.exports = {
	    entry: './js/main.js',
	    output: {
	        filename: 'app.js'
	    }
	};
</pre>
然后执行

<pre>
	webpack
</pre>
就会自动生成打包好的文件了。

但是这样每次改了源文件之后都需要手动执行命令，可以通过添加watch来自动检测文件变化并重新打包。配置文件修改如下：
<pre>
module.exports = {
    entry: './js/main.js',
    output: {
        filename: 'app.js'
    },
    watch: true
};
</pre>
配置文件中可以进行其它各种功能的相关配置，详情可以参看[官方文档](http://webpack.github.io/docs/configuration.html)。

### 4. 使用loader

很多模块打包工具只是针对js文件，而webpack的强大之处在于将模块的概念进行了扩展，认为一切静态文件都是模块，包括css、html模板、字体、CoffeeScript等等。虽然webpack本身依然是只能够处理js文件，但是通过一系列的loader，就可以处理其它文件了。

下面以css-loader和style-loader为例，演示如何打包样式文件。首先执行如下命令安装依赖模块：
<pre>
	npm install css-loader style-loader --save-dev
</pre>
然后在app目录下新建style.css文件，内容如下：
<pre>
body {
    background: red;
}
</pre>
然后修改main.js如下：
<pre>
	require('./js/mod.js')();
	require('style!css!./style.css');
</pre>

因为webpack不能够直接处理css文件，因此在require语句中需要指明需要的loader，一个文件可以经由多个loader依次处理，loader与loader之间，以及loader与文件名之间用!分隔。在这个例子中，也可以看出，如果使用了多个loader的话，数据流向是从右向左的，也就是从style.css开始，依次经过css-loader和style-loader。

但是假如有多个css文件的话，每个require语句都需要加上loader说明，很不方便，因此可以在webpack.config.js文件中进行配置，配置如下：

<pre>
loaders: [{
    test: /\.css$/,
    loader: 'style!css'
}]

// or

loaders: [{
    test: /\.css$/,
    loaders: ['style', 'css']
}]
</pre>
关于loader的更多信息，可以参考：

[Using Loaders](http://webpack.github.io/docs/using-loaders.html)
[Loaders](http://webpack.github.io/docs/loaders.html)
[How to write a loader](http://webpack.github.io/docs/how-to-write-a-loader.html)</br>

### 5. 外部依赖
现在假如该例子中需要用到angular，首先在index.html中通过`<script>`标签引入angular库，然后修改mymodule.js如下：

	var angular = require('angular');
	angular.module('MyModule', []);

	此时如果执行webpack命令会报如下错误：
	
	ERROR in ./mod.js
	Module not found: Error: Cannot resolve module 'angular' in /xxx/xxx/app
	 @ ./mymodule.js 1:14-32
	
	这是因为webpack无法解析angular依赖模块，此时需要在配置文件中对外部依赖进行配置：
	
	externals: {
	    'angular': true
	}

更多信息参考[configuration#externals](http://webpack.github.io/docs/configuration.html#externals)


### 6. 输出类型

现在假如我们希望打包后的文件作为一个单独的库，并且遵循AMD规范可以被被requirejs来使用，可以修改配置文件如下：
<pre>
output: {
    filename: 'app.js',
    library: 'app',
    libraryTarget: 'amd'
}
</pre>
此时输出的app.js结构如下：
<pre>
define("app", ["angular"], function( /* ... */ ) {
    /* ... */
});
</pre>
通过配置output.libraryTarget，可以自定义输出的模块类型，包括AMD，CommonJS，变量等多种输出类型。具体可以参考configuration#output。


### 7. 多文件

现在假如项目目录结构如下：
<pre>
	/app
	  |--components.js
	  |--index.html
	  |--js
		  |--main.js
		  |--mod.js
		  |--components.js
</pre>
其中mod.js被main.js和components.js所使用。假如我们希望main.js输出为app.js，而components输出为app.components.js，则可以修改配置文件如下：
<pre>
entry: {
    app: './main.js',
    'app.components': './components.js'
},
output: {
    filename: '[name].js'
}