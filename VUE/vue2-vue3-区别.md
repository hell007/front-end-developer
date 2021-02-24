## VUE2 vs VUE3 的区别

- 1、双向绑定原理变化

vue2 的双向数据绑定是利用ES5 的一个 API `Object.definePropert()`对数据进行劫持 结合 发布订阅模式的方式来实现的。

vue3中使用了 es6 的 `Proxy`API 对数据代理。

```
Proxy 相对于 Object.defineProperty 的优势：
代码的执行效果更快
Proxy 可以直接监听对象而非属性
Proxy 可以直接监听数组的变化
Proxy 有多达 13 种拦截方法,不限于 apply、ownKeys、deleteProperty、has 等等是 Object.defineProperty 不具备的
Proxy 返回的是一个新对象,我们可以只操作新的对象达到目的,而 Object.defineProperty 只能遍历对象属性直接修改
Proxy 不需要初始化的时候遍历所有属性，另外有多层属性嵌套的话，只有访问某个属性的时候，才会递归处理下一级的属性
```


- 2、片段(碎片Fragments)

2.x版本中，只能有一个根节点。

3.x版本中，支持片段，即一个组件可以拥有多个根节点。


- 3、生命周期钩子函数的变化

3.x版本中， 生周期钩子不是全局可调用的了，需要另外从vue中引入

2.x -> 3.0

```
beforeCreate -> use setup()
created -> use setup()
beforeMount -> onBeforeMount
mounted -> onMounted
beforeUpdate -> onBeforeUpdate
updated -> onUpdated
activate -> onActivated
deactivated -> onDeactivated
beforeDestroy -> onBeforeUnmount
destroyed -> onUnmounted
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


- 4、自定义指令钩子函数的变更

2.x -> 3.0

```
bind → beforeMount
inserted → mounted
beforeUpdate：新的！这是在元素本身更新之前调用的，很像组件生命周期钩子。
update → 移除！有太多的相似之处要更新，所以这是多余的，请改用 updated。
componentUpdated → updated
beforeUnmount：新的！与组件生命周期钩子类似，它将在卸载元素之前调用。
unbind -> unmounted
```

- 5、过滤器

2.x版本中，开发者可以使用过滤器来处理通用文本格式。

3.x版本中，过滤器已删除，不再支持。建议用计算属性或方法代替过滤器，而不是使用过滤器。


- 6、api的不同

a. Options API - Composition API

2.x版本中，使用选项式API（Options API）

3.x版本中，使用组合式API（Composition API）

Vue 3.0 所采用的 Composition Api 与 Vue 2.x 使用的 Options Api 区别：
```
Vue2 中,我们会在一个vue文件的 data，methods，computed，watch 中定义属性和方法，共同处理页面逻辑 。一个功能的实现，代码过于分散。
vue3 中,代码是根据逻辑功能来组织的，一个功能的所有 api 会放在一起（高内聚，低耦合），提高可读性和可维护性,
基于函数组合的 API 更好的重用逻辑代码，利于维护和封装。
```

b.渲染函数 API

2.x版本中，h函数 (createElement的常规别名) 作为render函数的参数。

3.x版本中，h函数 是全局导入的，而不是作为参数自动传递。

render 函数不再接收任何参数，它将主要用于 setup() 函数内部

c.事件 API

2.x版本中，Vue 实例可用于触发通过事件触发 API 强制附加的处理程序 ($on，$off 和 $once)，
用于创建 event hub，以创建在整个应用程序中使用的全局事件侦听器:

```
const install = function (Vue) {
  const Bus = new Vue({
    methods: {
      emit (event, ...args) {
        this.$emit(event, ...args)
      },
      on (event, callback) {
        this.$on(event, callback)
      },
      off (event, callback) {
        this.$off(event, callback)
      }
    }
  })
  Vue.prototype.$bus = Bus
}
export default install
```

3.x版本中，$on，$off 和 $once 实例方法已被移除，应用实例不再实现事件触发接口


- 7、prop 默认函数中访问this的不同

2.x版本中，this代表的是当前组件，可以直接使用this访问prop属性值。

3.x版本中，this无法直接访问props属性，emit events（触发事件）和组件内的其他属性，但是setup()方法可以接收两个参数：

```
props - 不可变的组件参数
context - Vue3 暴露出来的属性（emit，slots，attrs）
```

- 8、v-if 与 v-for 的优先级对比

2.x版本中在一个元素上同时使用 v-if 和 v-for 时，v-for 会优先作用。

3.x版本中中 v-if 总是优先于 v-for 生效


- 9、变更通知不同

2.x 版本中，使用 Vue.set 来给对象新增一个属性时，这个对象的所有 watcher 都会重新运行；

3.x 版本中，只有依赖那个属性的 watcher 才会重新运行。



