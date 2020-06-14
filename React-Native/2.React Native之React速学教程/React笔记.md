## React学习总结

### 一、出现背景

```
React 起源于 Facebook 的内部项目 2013年5月开源了
	
```

## 二、解决问题

```
在Web开发中，我们总需要将变化的数据实时反应到UI上，这时就需要对DOM进行操作。而复杂或频繁的DOM操作通常是性能瓶颈产生的原因。
	React为此引入了虚拟DOM（Virtual DOM）的机制：在浏览器端用Javascript实现了一套DOM API
	
```
### 三、技术原理

```
1.基于React进行开发时所有的DOM构造都是通过虚拟DOM进行，每当数据变化时，React都会重新构建整个DOM树，然后React将当前整个DOM树和上一次的DOM树进行对比，得到DOM结构的区别，然后仅仅将需要变化的部分进行实际的浏览器DOM更新
2.React能够批处理虚拟DOM的刷新，在一个事件循环（Event Loop）内的两次数据变化会被合并，例如你连续的先将节点内容从A变成B，然后又从B变成A，React会认为UI不发生任何变化，而如果通过手动控制，这种逻辑通常是极其复杂的。尽管每一次都需要构造完整的虚拟DOM树，但是因为虚拟DOM是内存数据，性能是极高的，而对实际DOM进行操作的仅仅是Diff部分，因而能达到提高性能的目的。这样，在保证性能的同时，开发者将不再需要关注某个数据的变化如何更新到一个或多个具体的DOM元素，而只需要关心在任意一个数据状态下，整个界面是如何Render的
```

### 四、技术优点
```
虚拟DOM（Virtual DOM）
组件化
```

### 五、认识误区

```
1.React不是一个完整的MVC框架，最多可以认为是MVC中的V（View），甚至React并不非常认可MVC开发模式；
2.React的服务器端Render能力只能算是一个锦上添花的功能，并不是其核心出发点，事实上React官方站点几乎没有提及其在服务器端的应用；
3.有人拿React和Web Component相提并论，但两者并不是完全的竞争关系，你完全可以用React去开发一个真正的Web Component；
4.React不是一个新的模板语言，JSX只是一个表象，没有JSX的React也能工作
```

### 开发  
```
React放在flux、redux、dva
vue, angluar，adobe flex
```
#### 1.组件的生命周期

![component-lifecycle](images/component-lifecycle.jpg)


#### 2.事件机制 
	React采用的是顶层的事件代理机制，更高效。 
	React 标准化了事件对象，因此在不同的浏览器中都会有相同的属性 
	
### 3.JSX的陷阱 
	JSX的标签必须是闭合的 
	JXS中不能使用IF-Else 
	确保文件是 UTF-8 编码且网页也指定为 UTF-8 编码，因为 React 默认会转义所有字符串，为了防止各种 XSS 攻击。 
	如果往原生 HTML 元素里传入 HTML 规范里不存在的属性，React 不会显示它们。如果需要使用自定义属性，要加  data-  或者aria前缀
	

### 4.State 状态机

	State应该使用的场景 ：大部分组件的工作应该是从   props   里取数据并渲染出来。但是，有时需要对用户输入、服务器请求或者时间变化等作出响应，这时才需要使用 State。 
	State 应该包括的数据：那些可能被组件的事件处理器改变并触发用户界面更新的数据
	
	State不应该包括的数据 ： 计算所得数据， React 组件， 基于 props 的重复数据


### 5.React 组件之间交流的方式，可以分为以下 3 种：

	【父组件】向【子组件】传值: props , callback
	
	【子组件】向【父组件】传值: state , callback
	
	【没有任何嵌套关系的组件之间传值】（PS：比如：兄弟组件之间传值）:
	基本操作步骤：订阅（subscribe）/监听（listen）一个事件通知，并发送（send）/触发（trigger）/发布（publish）/发送（dispatch）一个事件通知给需要的组件