# React Native之React速学教程(中) 


## 概述

本篇为《React Native之React速学教程》的第二篇。本篇将从组件(Component)的详细说明、组件的生命周期(Component Lifecycle)、isMounted是个反模式等方面进行讲解，让大家对组件(Component)有个更系统以及更深入的认识。  



## 组件的详细说明  
当通过调用 React.createClass() 来创建组件的时候，每个组件必须提供render方法，并且也可以包含其它的在这里描述的生命周期方法。  

### render
`ReactComponent render()`   
`render()` 方法是必须的。  
当该方法被回调的时候，会检测 `this.props` 和 `this.state`，并返回一个单子级组件。该子级组件可以是虚拟的本地 DOM 组件（比如 \<div /> 或者 `React.DOM.div()`），也可以是自定义的复合组件。  
你也可以返回 `null` 或者 `false` 来表明不需要渲染任何东西。实际上，React 渲染一个`<noscript> `标签来处理当前的差异检查逻辑。当返回 `null` 或者 `false` 的时候，`this.getDOMNode()` 将返回 `null`。   

**注意：**  

`render() `函数应该是纯粹的，也就是说该函数不修改组件的 `state`，每次调用都返回相同的结果，不读写 DOM 信息，也不和浏览器交互（例如通过使用 `setTimeout`）。如果需要和浏览器交互，在 `componentDidMount()` 中或者其它生命周期方法中做这件事。保持 `render()` 纯粹，可以使服务器端渲染更加切实可行，也使组件更容易被理解。  


>心得：不要在`render()`函数中做复杂的操作，更不要进行网络请求，数据库读写，I/O等操作。


### getInitialState
`object getInitialState()`
初始化组件状态，在组件挂载之前调用一次。返回值将会作为 `this.state `的初始值。  

>心得：通常在该方法中对组件的状态进行初始化。  


### getDefaultProps
`object getDefaultProps()`  
设置组件属性的默认值，在组件类创建的时候调用一次，然后返回值被缓存下来。如果父组件没有指定 `props` 中的某个键，则此处返回的对象中的相应属性将会合并到 `this.props` （使用 in 检测属性）。     
**Usage:**  

```
getDefaultProps() {
    return {
      title: '',
      popEnabled:true
    };
  },
```
**注意**  
该方法在任何实例创建之前调用，因此不能依赖于 `this.props`。另外，`getDefaultProps()` 返回的任何复杂对象将会在实例间共享，而不是每个实例拥有一份拷贝。  

>心得：该方法在你封装一个自定义组件的时候经常用到，通常用于为组件初始化默认属性。   



### [PropTypes](https://facebook.github.io/react/docs/top-level-api.html#react.proptypes) 
`object propTypes`  
`propTypes` 对象用于验证传入到组件的 `props`。  可参考[可重用的组件](https://facebook.github.io/react/docs/reusable-components.html)。

**Usage:**   

```html
var NavigationBar=React.createClass({
  propTypes: {
    navigator:React.PropTypes.object,
    leftButtonTitle: React.PropTypes.string,
    leftButtonIcon: Image.propTypes.source,
    popEnabled:React.PropTypes.bool,
    onLeftButtonClick: React.PropTypes.func,
    title:React.PropTypes.string,
    rightButtonTitle: React.PropTypes.string,
    rightButtonIcon:Image.propTypes.source,
    onRightButtonClick:React.PropTypes.func
  },
```

>心得：在封装组件时，对组件的属性通常会有类型限制，如：组件的背景图片，需要`Image.propTypes.source`类型，propTypes便可以帮你完成你需要的属性类型的检查。

### mixins
`array mixins`  
`mixin` 数组允许使用混合来在多个组件之间共享行为。更多关于混合的信息，可参考[Reusable Components](https://facebook.github.io/react/docs/reusable-components.html#mixins)。  

>心得：由于ES6不再支持mixins，所以不建议在使用mixins，我们可以用另外一种方式来替代mixins，请参考：[React Native之React速学教程(下)-ES6不再支持Mixins]()。

### statics

`object statics`  
`statics` 对象允许你定义静态的方法，这些静态的方法可以在组件类上调用。例如：

```html
var MyComponent = React.createClass({
  statics: {
    customMethod: function(foo) {
      return foo === 'bar';
    }
  },
  render: function() {
  }
});
MyComponent.customMethod('bar');  // true
```

在这个块儿里面定义的方法都是静态的，你可以通过`ClassName.funcationName`的形式调用它。  
**注意**  
这些方法不能获取组件的 `props` 和 `state`。如果你想在静态方法中检查 `props` 的值，在调用处把 `props` 作为参数传入到静态方法。

### displayName
`string displayName`  
`displayName` 字符串用于输出调试信息。JSX 自动设置该值；可参考[JSX in Depth](https://facebook.github.io/react/docs/jsx-in-depth.html#the-transform)。

#### isMounted

`boolean isMounted()`，当组件被渲染到DOM，该方法返回true，否则返回false。该方法通常用于异步任务完成后修改state前的检查，以避免修改一个没有被渲染的组件的state。   

>心得：开发中不建议大家isMounted，大家可以使用另外一种更好的方式来避免修改没有被渲染的DOM，请下文的[isMounted 是个反模式]()。

## [组件的生命周期(Component Lifecycle)](https://facebook.github.io/react/docs/working-with-the-browser.html#component-lifecycle)

在iOS中`UIViewController`提供了`(void)viewWillAppear:(BOOL)animated`, `- (void)viewDidLoad`,`(void)viewWillDisappear:(BOOL)animated`等生命周期方法，在Android中`Activity`则提供了` onCreate()`,`onStart()`,`onResume()	`,`onPause()`,`onStop()`,`onDestroy()`等生命周期方法，这些生命周期方法展示了一个界面从创建到销毁的一生。  

那么在React 中组件(Component)也是有自己的生命周期方法的。  

![component-lifecycle](images/component-lifecycle.jpg)

### 组件的生命周期分成三个状态：  

- Mounting：已插入真实 DOM
- Updating：正在被重新渲染
- Unmounting：已移出真实 DOM

> 心得：你会发现这些React 中组件(Component)的生命周期方法从写法上和iOS中`UIViewController`的生命周期方法很像，React 为每个状态都提供了两种处理函数，will 函数在进入状态之前调用，did 函数在进入状态之后调用。  

### Mounting(装载)

- `getInitialState()`: 在组件挂载之前调用一次。返回值将会作为 this.state 的初始值。
- `componentWillMount()`：服务器端和客户端都只调用一次，在初始化渲染执行之前立刻调用。
- `componentDidMount()`：在初始化渲染执行之后立刻调用一次，仅客户端有效（服务器端不会调用）。

### Updating (更新)

- componentWillReceiveProps(object nextProps) 在组件接收到新的 props 的时候调用。在初始化渲染的时候，该方法不会调用。

用此函数可以作为 react 在 prop 传入之后， render() 渲染之前更新 state 的机会。老的 props 可以通过 this.props 获取到。在该函数中调用 this.setState() 将不会引起第二次渲染。

- shouldComponentUpdate(object nextProps, object nextState): 在接收到新的 props 或者 state，将要渲染之前调用。

该方法在初始化渲染的时候不会调用，在使用 forceUpdate 方法的时候也不会。如果确定新的 props 和 state 不会导致组件更新，则此处应该 返回 false。   

>心得：重写次方你可以根据实际情况，来灵活的控制组件当 props 和 state 发生变化时是否要重新渲染组件。   


- componentWillUpdate(object nextProps, object nextState)：在接收到新的 props 或者 state 之前立刻调用。

在初始化渲染的时候该方法不会被调用。使用该方法做一些更新之前的准备工作。   
>注意：你不能在该方法中使用 this.setState()。如果需要更新 state 来响应某个 prop 的改变，请使用 `componentWillReceiveProps`。

- componentDidUpdate(object prevProps, object prevState): 在组件的更新已经同步到 DOM 中之后立刻被调用。

该方法不会在初始化渲染的时候调用。使用该方法可以在组件更新之后操作 DOM 元素。

### Unmounting(移除) 

- componentWillUnmount：在组件从 DOM 中移除的时候立刻被调用。

在该方法中执行任何必要的清理，比如无效的定时器，或者清除在 componentDidMount 中创建的 DOM 元素。

## isMounted是个反模式

isMounted通常用于避免修改一个已经被卸载的组件的状态，因为调用一个没有被装载的组件的`setState()`方法，系统会抛出异常警告。  

```javascript
if(this.isMounted()) { //不推荐
  this.setState({...});
}
```

上面做法有点反模式，`isMounted()`起到作用的时候也就是组件被卸载之后还有异步操作在进行的时候，这就意味着一个被销毁的组件还持有着一些资源的引用，这会导致系统性能降低甚至内存溢出。      


React 在设计的时候通过`setState()`被调用时做了一些检查，来帮助开发者发现被卸载的组件还持有一些资源的引用的情况。如何你使用了`isMounted()`，也就是跳过的React的检查，也就无法发现被卸载的组件还持有资源的问题。       


既然isMounted()是反模式，那么有没有可替代方案呢？    
我们可以通过在设置一个变量来表示组件的装载和卸载的状态，当`componentDidMount`被调用时该变量为true，当
`componentWillUnmount`被调用时，该变量为false，这样该变量就可以当`isMounted()`来使用。但还不够，到目前为止，我们只是通过变量来替代`isMounted()`，还没有做任何的优化，接下来我们需要在`componentWillUnmount`被调用时取消所有的异步回调，主动释放所有资源，这样就能避免被卸载的组件还持有资源的引用的情况，从而减少了内存溢出等情况的发生。   

```javascript
class MyComponent extends React.Component {
  componentDidMount() {
    mydatastore.subscribe(this);
  }
  render() {
    ...
  }
  componentWillUnmount() {
    mydatastore.unsubscribe(this);
  }
}
```
使用可取消的Promise做异步操作。  


```javascript
const cancelablePromise = makeCancelable(
  new Promise(r => component.setState({...}}))
);
cancelablePromise
  .promise
  .then(() => console.log('resolved'))
  .catch((reason) => console.log('isCanceled', reason.isCanceled));
cancelablePromise.cancel(); // Cancel the promise
```

可取消的Promise。

```javascript
const makeCancelable = (promise) => {
  let hasCanceled_ = false;
  const wrappedPromise = new Promise((resolve, reject) => {
    promise.then((val) =>
      hasCanceled_ ? reject({isCanceled: true}) : resolve(val)
    );
    promise.catch((error) =>
      hasCanceled_ ? reject({isCanceled: true}) : reject(error)
    );
  });
  return {
    promise: wrappedPromise,
    cancel() {
      hasCanceled_ = true;
    },
  };
};
```

## React17.0生命周期调整

react团队对生命周期做了调整，将会移除 componentWillMount，componentWillReceiveProps，componentWillUpdate这三个生命周期，因为这些生命周期方法容易被误解和滥用。

1、组件数据初始化

一般我们为了提前 setState ，防止二次渲染（第一次是空state渲染，第二次外部数据渲染），经常在 componentWillMount 生命周期请求数据

```
// Before
class ExampleComponent extends React.Component {
  state = {
    externalData: null,
  };
 
  componentWillMount() {
    this._asyncRequest = asyncLoadData().then(
      externalData => {
        this._asyncRequest = null;
        this.setState({externalData});
      }
    );
  }
 
  componentWillUnmount() {
    if (this._asyncRequest) {
      this._asyncRequest.cancel();
    }
  }
 
  render() {
    if (this.state.externalData === null) {
      // Render loading state ...
    } else {
      // Render real UI ...
    }
  }
}
```

但是事实却不是这样的，异步获取外部数据不一定会在渲染之前返回，这也意味着组件也有可能会被渲染一次，为了后面新版本实现异步渲染，建议请求放在 componentDidMount 来调用

还有一个问题是，componentWillMount 在服务端渲染（nuxt.js）的时候会导致服务端和客户端各渲染一次，而 componentDidMount 只在客户端渲染一次

```
// After
class ExampleComponent extends React.Component {
  state = {
    externalData: null,
  };
 
  componentDidMount() {
    this._asyncRequest = loadMyAsyncData().then(
      externalData => {
        this._asyncRequest = null;
        this.setState({externalData});
      }
    );
  }
 
  componentWillUnmount() {
    if (this._asyncRequest) {
      this._asyncRequest.cancel();
    }
  }
 
  render() {
    if (this.state.externalData === null) {
      // Render loading state ...
    } else {
      // Render real UI ...
    }
  }
}
```

2、事件监听和解绑

事件的监听最好的实践是在 componentDidMount 来实现，因为只有在调用 componentDidMount 的时候，React才会确保 componentWillUnmount 回调能顺利执行，防止内存泄漏 

```

class ExampleComponent extends React.Component {
  state = {
    subscribedValue: this.props.dataSource.value,
  };
 
  componentDidMount() {
    // Event listeners are only safe to add after mount,
    // So they won't leak if mount is interrupted or errors.
    this.props.dataSource.subscribe(
      this.handleSubscriptionChange
    );
 
    // External values could change between render and mount,
    // In some cases it may be important to handle this case.
    if (
      this.state.subscribedValue !==
      this.props.dataSource.value
    ) {
      this.setState({
        subscribedValue: this.props.dataSource.value,
      });
    }
  }
 
  componentWillUnmount() {
    this.props.dataSource.unsubscribe(
      this.handleSubscriptionChange
    );
  }
 
  handleSubscriptionChange = dataSource => {
    this.setState({
      subscribedValue: dataSource.value,
    });
  };
}
```

3、基于props更新state

我们经常会在 componentWillReceiveProps 来做props比较，然后更新组件的state

```
class ExampleComponent extends React.Component {
  state = {
    isScrollingDown: false,
  };
 
  componentWillReceiveProps(nextProps) {
    if (this.props.currentRow !== nextProps.currentRow) {
      this.setState({
        isScrollingDown:
          nextProps.currentRow > this.props.currentRow,
      });
    }
  }
}
```

从版本16.3开始，更新state以响应props更改的推荐方法是使用新的静态 getDerivedStateFromProps生命周期。 （生命周期在组件创建时以及每次收到新的props时调用）

```
class ExampleComponent extends React.Component {
  // Initialize state in constructor,
  // Or with a property initializer.
  state = {
    isScrollingDown: false,
    lastRow: null,
  };
 
  static getDerivedStateFromProps(nextProps, prevState) {
    if (nextProps.currentRow !== prevState.lastRow) {
      return {
        isScrollingDown:
          nextProps.currentRow > prevState.lastRow,
        lastRow: nextProps.currentRow,
      };
    }
 
    // Return null to indicate no change to state.
    return null;
  }
}
```

getDerivedStateFromProps 有两个参数 nextProps，prevState，第一个是用来获取新的props，第二个参数可以获取组件的上一个state，

有可能有个疑问，为什么不把上一个 props 也传递过来，React团队在设计的时候考虑过这个问题，有两个原因

```
在第一次调用 getDerivedStateFromProps（实例化后）时，prevProps参数将为null，需要在访问 prevProps 时添加if-not-null检查
没有将以前的props传递给这个函数，可以把之前不需要用的props释放掉，避免内存占用
```

4、调用外部组件的回调函数

如果我们需要在一个在内部状态发生变化时，调用外部组件的函数做一些事情，我们可能会这样做

```
class ExampleComponent extends React.Component {
  componentWillUpdate(nextProps, nextState) {
    if (
      this.state.someStatefulValue !==
      nextState.someStatefulValue
    ) {
      nextProps.onChange(nextState.someStatefulValue);
    }
  }
}
```

但是问题是，在异步模式下使用 componentWillUpdate 都是不安全的，因为外部回调可能在组件的一次state更新下多次调用。
相反，应该使用 componentDidUpdate 生命周期，因为它保证每次更新只调用一次

```
class ExampleComponent extends React.Component {
  componentDidUpdate(prevProps, prevState) {
    if (
      this.state.someStatefulValue !==
      prevState.someStatefulValue
    ) {
      this.props.onChange(this.state.someStatefulValue);
    }
  }
}
```

5、基于props改变获取服务端数据

我们一般会在 componentWillReceiveProps 的回调里面判断，然后 _loadAsyncData 获取接口数据

```
class ExampleComponent extends React.Component {
  state = {
    externalData: null,
  };
 
  componentDidMount() {
    this._loadAsyncData(this.props.id);
  }
 
  componentWillReceiveProps(nextProps) {
    if (nextProps.id !== this.props.id) {
      this.setState({externalData: null});
      this._loadAsyncData(nextProps.id);
    }
  }
 
  componentWillUnmount() {
    if (this._asyncRequest) {
      this._asyncRequest.cancel();
    }
  }
 
  render() {
    if (this.state.externalData === null) {
      // Render loading state ...
    } else {
      // Render real UI ...
    }
  }
 
  _loadAsyncData(id) {
    this._asyncRequest = asyncLoadData(id).then(
      externalData => {
        this._asyncRequest = null;
        this.setState({externalData});
      }
    );
  }
}
```

这样虽然没毛病，但是为了兼容新的api，官方推荐的做法是在 getDerivedStateFromProps 回调里面处理传递过来的props，然后将异步获取数据放在 componentDidUpdate 中

```
class ExampleComponent extends React.Component {
  state = {
    externalData: null,
  };
 
  static getDerivedStateFromProps(nextProps, prevState) {
    // Store prevId in state so we can compare when props change.
    // Clear out previously-loaded data (so we don't render stale stuff).
    if (nextProps.id !== prevState.prevId) {
      return {
        externalData: null,
        prevId: nextProps.id,
      };
    }
 
    // No state update necessary
    return null;
  }
 
  componentDidMount() {
    this._loadAsyncData(this.props.id);
  }
 
  componentDidUpdate(prevProps, prevState) {
    if (this.state.externalData === null) {
      this._loadAsyncData(this.props.id);
    }
  }
 
  componentWillUnmount() {
    if (this._asyncRequest) {
      this._asyncRequest.cancel();
    }
  }
 
  render() {
    if (this.state.externalData === null) {
      // Render loading state ...
    } else {
      // Render real UI ...
    }
  }
 
  _loadAsyncData(id) {
    this._asyncRequest = asyncLoadData(id).then(
      externalData => {
        this._asyncRequest = null;
        this.setState({externalData});
      }
    );
  }
}
```

6、在更新之前读取dom的属性

在更新一个列表容器数据的时候，我们需要保持滚动条的位置，可以在 getSnapshotBeforeUpdate 新的生命周期里面去获取dom的属性，
例如offsetHeight，scrollHeight等属性，它可以将React的值作为参数传递给 componentDidUpdate ，在数据发生变化后立即调用它。

```
class ScrollingList extends React.Component {
  listRef = null;
 
  getSnapshotBeforeUpdate(prevProps, prevState) {
    // Are we adding new items to the list?
    // Capture the scroll position so we can adjust scroll later.
    if (prevProps.list.length < this.props.list.length) {
      return (
        this.listRef.scrollHeight - this.listRef.scrollTop
      );
    }
    return null;
  }
 
  componentDidUpdate(prevProps, prevState, snapshot) {
    // If we have a snapshot value, we've just added new items.
    // Adjust scroll so these new items don't push the old ones out of view.
    // (snapshot here is the value returned from getSnapshotBeforeUpdate)
    if (snapshot !== null) {
      this.listRef.scrollTop =
        this.listRef.scrollHeight - snapshot;
    }
  }
 
  render() {
    return (
      `<div>`
        {/* ...contents... */}
      `</div>`
    );
  }
 
  setListRef = ref => {
    this.listRef = ref;
  };
}
```

7、新版如何兼容旧的API

可以通过 react-lifecycles-compat 可以使新的 getDerivedStateFromProps 生命周期与旧版本的React一起使用。



## 参考  
[React17.0生命周期调整](https://blog.csdn.net/hsany330/article/details/105660559)
[React's official site](https://facebook.github.io/react/)  
[React on ES6+](https://babeljs.io/blog/2015/06/07/react-on-es6-plus)

