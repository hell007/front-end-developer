## VUE2 vs VUE3 的区别

1、vue2和vue3双向数据绑定原理不同

vue2 的双向数据绑定是利用ES5 的一个 API `Object.definePropert()`对数据进行劫持 结合 发布订阅模式的方式来实现的。

vue3中使用了 es6 的 `Proxy`API 对数据代理。

> Proxy 相对于 Object.defineProperty 的优势：
代码的执行效果更快
Proxy 可以直接监听对象而非属性
Proxy 可以直接监听数组的变化
Proxy 有多达 13 种拦截方法,不限于 apply、ownKeys、deleteProperty、has 等等是 Object.defineProperty 不具备的
Proxy 返回的是一个新对象,我们可以只操作新的对象达到目的,而 Object.defineProperty 只能遍历对象属性直接修改
Proxy 不需要初始化的时候遍历所有属性，另外有多层属性嵌套的话，只有访问某个属性的时候，才会递归处理下一级的属性


2、template的不同

2.x版本中，只能有一个根节点。

3.x版本中，支持碎片(Fragments)，即一个组件可以拥有多个根节点。

vue3 中标记和提升所有的静态根节点，diff 的时候只需要对比动态节点内容。

3、api的不同

2.x版本中，使用选项式API（Options API）

3.x版本中，使用组合式API（Composition API）

Vue 3.0 所采用的 Composition Api 与 Vue 2.x 使用的 Options Api 区别：
```
Vue2 中,我们会在一个vue文件的 data，methods，computed，watch 中定义属性和方法，共同处理页面逻辑 。一个功能的实现，代码过于分散。
vue3 中,代码是根据逻辑功能来组织的，一个功能的所有 api 会放在一起（高内聚，低耦合），提高可读性和可维护性,
基于函数组合的 API 更好的重用逻辑代码，利于维护和封装。
```

4、生命周期钩子不同

3.x版本中， 生周期钩子不是全局可调用的了，需要另外从vue中引入

```
beforeCreate -> use setup()
created -> use setup()
beforeMount -> onBeforeMount
mounted -> onMounted
beforeUpdate -> onBeforeUpdate
updated -> onUpdated
beforeDestroy -> onBeforeUnmount
destroyed -> onUnmounted
activate -> onActivated
deactivated -> onDeactivated
errorCaptured -> onErrorCaptured
```
Vue3中使用两个全新的钩子函数来进行调试。他们是：

```
onRenderTracked
onRenderTriggered
```
这两个事件都带有一个DebuggerEvent，它使我们能够知道是什么导致了Vue实例中的重新渲染。

```
export default {
  onRenderTriggered(e) {
    debugger
    // 检查哪个依赖项导致组件重新呈现
  }
}
```


5、this的不同

2.x版本中，this代表的是当前组件，可以直接使用this访问prop属性值。

3.x版本中，this无法直接访问props属性，emit events（触发事件）和组件内的其他属性，但是setup()方法可以接收两个参数：

```
props - 不可变的组件参数
context - Vue3 暴露出来的属性（emit，slots，attrs）
```


6、 懒观察（lazy observation）不同

在 2.x 版本里，不管数据多大，都会在一开始就为其创建观察者。当数据很大时，这可能会在页面载入时造成明显的性能压力。

3.x 版本，只会对「被用于渲染初始可见部分的数据」创建观察者，而且 3.x 的观察者更高效。


7、 变更通知不同

2.x 版本中，使用 Vue.set 来给对象新增一个属性时，这个对象的所有 watcher 都会重新运行；

3.x 版本中，只有依赖那个属性的 watcher 才会重新运行。


