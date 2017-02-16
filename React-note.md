## React学习总结

### 一、出现背景

```
React 起源于 Facebook 的内部项目，因为该公司对市场上所有 JavaScript MVC 框架，都不满意，就决定自己写一套，用来架设 Instagram 的网站。做出来以后，发现这套东西很好用，就在2013年5月开源了
	
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
```
组件的生命周期包含三个主要部分：
挂载：  组件被插入到DOM中 (componentWillMount)
更新：  组件被重新渲染，查明DOM是否应该刷新。
移除：  组件从DOM中移除
组件生命周期方法

挂载方法
componentWillMount 	
在初始化渲染执行之前 立刻调用。

如果在这个方法内调用

setState ， render()

将会感知到更新后的 state，

将会执行仅一次，尽管 state 改变了。

componentDidMount  

在初始化渲染执行之后 立刻调用一次，

仅客户端有效（服务器端不会调用）。

在生命周期中的这个时间点，组件拥有一个 DOM 展现，

你可以通过  this.getDOMNode()  来获取相应 DOM 节点。

如果想和其它 JavaScript 框架集成，

使用  setTimeout  

或者  setInterval  来设置定时器，或者发送 AJAX 请求，

可以在该方法中执行这些操作。

更新方法
componentWillReceiveProps 

在组件接收到新的  props  的时候调用 。

在初始化渲染的时候，该方法不会调用。

用此函数可以作为 react 在 prop 传入之后， 

render()  渲染之前更新 state 的机会。

老的 props 可以通过  this.props  获取到。

在该函数中调用  this.setState()  

将不会引起第二次渲染。

componentWillReceiveProps: function(nextProps) {
this.setState(
{
likesIncreasing: nextProps.likeCount > this.props.likeCount
});
    }
注意：

对于 state，没有相似的方法 ：  componentWillReceiveState 。将要传进来的 prop 可能会引起 state 改变，反之则不然。

如果需要在 state 改变的时候执行一些操作，请使用 componentWillUpdate 。

 
shouldComponentUpdate 

在接收到新的 props 或者 state，将要渲染之前调用 。

该方法在初始化渲染的时候不会调用，

在使用  forceUpdate  方法的时候也不会。

如果确定新的 props 和 state 不会导致组件更新，

则此处应该  返回 false 。

shouldComponentUpdate: function(nextProps, nextState) 
{return nextProps.id !== this.props.id;}
如果  shouldComponentUpdate  返回 false，

则  render()  将不会执行，直到下一次 state 改变。（另外， componentWillUpdate  和  componentDidUpdate  也不会被调用。）

默认情况下， shouldComponentUpdate  

总会返回 true，

在  state  改变的时候避免细微的 bug，

但是如果总是小心地把  state  当做不可变的，

在  render()  中只从  props  和  state  读取值，

此时你可以覆盖  shouldComponentUpdate  方法，

实现新老 props 和 state 的比对逻辑。

如果性能是个瓶颈，尤其是有几十个甚至上百个组件的时候，

使用  shouldComponentUpdate  可以提升应用的性能。

 
componentWillUpdate 

在接收到新的 props 或者 state 之前立刻调用 。

在初始化渲染的时候该方法不会被调用 。

使用该方法做一些更新之前的准备工作。

注意：

你 不能 在该方法中使用  this.setState() 。

如果需要更新 state 来响应某个 prop 的改变，请使用 componentWillReceiveProps 。

componentDidUpdate 

在组件的更新已经同步到 DOM 中之后立刻被调用 。

该方法不会在初始化渲染的时候调用。

使用该方法可以在组件更新之后操作 DOM 元素。

删除方法	
componentWillUnmount 

在组件从 DOM 中移除的时候立刻被调用 。

在该方法中执行任何必要的清理，

比如无效的定时器，或者清除在 

componentDidMount  中创建的 DOM 元素。

```

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


