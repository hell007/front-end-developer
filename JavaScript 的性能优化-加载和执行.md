# js的性能优化：加载和执行总结

[来源](https://www.ibm.com/developerworks/cn/web/1308_caiys_jsload/index.html)


### 问题描述：


	<html>
	<head>
	    <title>Source Example</title>
	    <script type="text/javascript" src="script1.js"></script>
	    <script type="text/javascript" src="script2.js"></script>
	    <script type="text/javascript" src="script3.js"></script>
	    <link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
	    <p>Hello world!</p>
	</body>
	</html>


>当浏览器解析到 script 标签（第 4 行）时，浏览器会停止解析其后的内容，而优先下载脚本文件，并执行其中的代码，这意味着，其后的 styles.css 样式文件和<body>标签都无法被加载，由于body标签无法被加载，那么页面自然就无法渲染了。因此在该 JavaScript 代码完全执行完之前，页面都是一片空白。图 1 描述了页面加载过程中脚本和样式文件的下载过程:

![](./js-load.jpg)

从 IE 8、Firefox 3.5、Safari 4 和 Chrome 2 开始都允许并行下载 JavaScript 文件。这是个好消息，因为script标签在下载外部资源时不会阻塞其他script标签。遗憾的是，JavaScript 下载过程仍然会阻塞其他资源的下载，比如样式文件和图片

>分析：

考虑到 HTTP 请求会带来额外的性能开销，因此下载单个 100Kb 的文件将比下载 5 个 20Kb 的文件更快。也就是说，减少页面中外链脚本的数量将会改善性能

通常一个大型网站或应用需要依赖数个 JavaScript 文件。您可以把多个文件合并成一个，这样只需要引用一个script标签，就可以减少性能消耗

尽管下载单个较大的 JavaScript 文件只产生一次 HTTP 请求，却会锁死浏览器的一大段时间。为避免这种情况，需要通过一些特定的技术向页面中逐步加载 JavaScript 文件，这样做在某种程度上来说不会阻塞浏览器

>结论：  位置？ 加载js数量和单个js大小？ 怎么加载js?



### 减少 JavaScript 对性能的影响有以下几种方法：

1.将所有的script标签放到页面底部，也就是/body闭合标签之前，这能确保在脚本执行前页面已经完成了渲染

2.尽可能地合并脚本。页面中的script标签越少，加载也就越快，响应也越迅速。无论是外链脚本还是内嵌脚本都是如此

3.采用无阻塞下载 JavaScript 脚本的方法：

3.1使用script标签的 defer 属性（仅适用于 IE 和 Firefox 3.5 以上版本）
缺点：不适用与当前互联网发展情景

3.2使用动态创建的script元素来下载并执行代码

>代码简单案例

	<!DOCTYPE html>
	<html>
	<head>
	<meta charset="UTF-8">
	<title>js性能优化</title>
	</head>
	<body>
	<script type="text/javascript">
	//function loadScript(url, callback){
	//  var script = document.createElement ("script")
	//  script.type = "text/javascript";
	//  if (script.readyState){ //IE
	//      script.onreadystatechange = function(){
	//          if (script.readyState == "loaded" || script.readyState == "complete"){
	//              script.onreadystatechange = null;
	//              if(typeof callback ==='function') callback();
	//          }
	//      };
	//  } else { //Others
	//      script.onload = function(){
	//          if(typeof callback ==='function') callback();
	//      };
	//  }
	//  script.src = url;
	//  document.getElementsByTagName("body")[0].appendChild(script);
	//}

	//loadScript("alert1.js", function(){
	//  loadScript("alert2.js", function(){
	//      loadScript("alert3.js", function(){
	//          alert("All files are loaded!");
	//      });
	//  });
	//});
	
	/**
	 * 动态加载
	 * @param {Number} n
	 */
	function handleLoadScript(n){
	    var script = document.createElement ("script");
	    script.type = "text/javascript";	
	    if(n>scripts.length-1) return;
	    if (script.readyState){ //IE
		script.onreadystatechange = function(){
		    if (script.readyState == "loaded" || script.readyState == "complete"){
			script.onreadystatechange = null;
			//if(typeof callback ==='function') callback();
			return handleLoadScript(n+1);
		    }
		};
	    } else { //Others
		script.onload = function(){
		    //if(typeof callback ==='function') callback();
		    return handleLoadScript(n+1);
		};
	    }
	    script.src = scripts[n];
	    document.getElementsByTagName("body")[0].appendChild(script);
	}

	//调用
	var scripts = [
	"http://img01.netvan.cn/mall/userfiles/resfiles/resources/frame/js/jquery.min.1.8.3.js",
	"alert2.js",
	"http://img01.netvan.cn/mall/userfiles/resfiles/resources/frame/js/frame.js",
	"http://img01.netvan.cn/mall/userfiles/resfiles/resources/mallweb/v1611/js/mallweb.public.js",
	"alert3.js"
	];
	handleLoadScript(0);
	/*
	 按顺序加载，
	 如果某一个js请求失败，后续的将不会在加载
	 */
	</script>
	</body>
	</html>


3.3使用 XHR 对象下载 JavaScript 代码并注入页面中

优点:您可以下载不立即执行的 JavaScript 代码。由于代码返回在script标签之外，它下载后不会自动执行，这使得您可以推迟执行，直到一切都准备好了；同样的代码在所有现代浏览器中都不会引发异常。

缺点：JavaScript 文件必须与页面放置在同一个域内，不能从 CDN 下载（CDN 指"内容投递网络（Content Delivery Network）"，所以大型网页通常不采用 XHR 脚本注入技术
		
	

>通过以上策略，可以在很大程度上提高那些需要使用大量 JavaScript 的 Web 网站和应用的实际性能。
