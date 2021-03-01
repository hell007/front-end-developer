## REACT 

##### React 【生命周期】三个阶段生命周期函数、不同生命周期详解、图解生命周期

[详解](https://www.cnblogs.com/xiaoxuStudy/p/13369586.html?tt_from=copy_link&utm_source=copy_link&utm_medium=toutiao_ios&utm_campaign=client_share)


##### 状态组件（类组件） 和 无状态组件（函数组件）

有状态组件主要用来定义交互逻辑和业务数据，使用{this.state.xxx}的表达式把业务数据挂载到容器组件的实例上，
然后传递props到函数组件，函数组件接收到props，把props塞到模板里面。

无状态组件主要用来定义模板，接收来自父组件props传递过来的数据，使用{props.xxx}的表达式把props塞到模板里面。


##### 哪些生命周期中可以修改组件的state

  componentDidMount和componentDidUpdate

  constructor、componentWillMount中setState会发生错误：setState只能在mounted或mounting组件中执行

  componentWillUpdate中setState会导致死循环


##### react中component和pureComponent区别是什么？

PureComponent自带通过props和state的浅对比来实现 shouldComponentUpate()，
而Component没有比于Component，PureCompoent的性能表现将会更好


##### react hooks

[详解](https://blog.csdn.net/kellywong/article/details/106430977?tt_from=copy_link&utm_source=copy_link&utm_medium=toutiao_ios&utm_campaign=client_share)


##### React-render-props和高阶组件

[使用](https://www.cnblogs.com/xiaowzi/p/12368706.html)



- redux

　　redux 是一个应用数据流框架，主要是解决了组件间状态共享的问题，原理是集中式管理，主要有三个核心方法，action，store，reducer

　　三大原则：

  ```
　　1）唯一数据源(整个应用的 state 被储存在一棵 object tree 中，并且这个 object tree 只存在于唯一一个 store 中)

　　2）reducer必须是纯函数（输入必须对应着唯一的输出）

　　3）State 是只读的, 想要更改必须经过派发action
  ``` 

　　redux的工作流程：　
  
  ```

　　使用通过reducer创建出来的Store发起一个Action，reducer会执行相应的更新state的方法，当state更新之后，view会根据state做出相应的变化

　　1）提供getState()获取到state

　　2）通过dispatch(action)发起action更新state

　　3）通过subscribe()注册监听器　
  ```



## React 面试题

[React35问](https://www.toutiao.com/i6823544190870225421/?tt_from=copy_link&utm_campaign=client_share&timestamp=1614562114&app=news_article&utm_source=copy_link&utm_medium=toutiao_ios&use_new_style=1&req_id=202103010928340101511802311710B6CE&group_id=6823544190870225421)
