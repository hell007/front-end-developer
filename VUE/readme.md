
## VUE 知识体系

1、mvvm

[剖析Vue实现原理](./mvvm.md)

2、生命周期 

[Vue 生命周期源码剖析 ](https://ustbhuangyi.github.io/vue-analysis/v2/components/lifecycle.html)

3、数据绑定 

[深入响应式原理](https://ustbhuangyi.github.io/vue-analysis/v2/reactive/)

[实现双向绑定Proxy比defineproperty优劣如何?](https://juejin.im/post/5acd0c8a6fb9a028da7cdfaf)

[为什么Vue3.0不再使用defineProperty实现数据监听？](https://mp.weixin.qq.com/s/O8iL4o8oPpqTm4URRveOIA)

4、状态管理

[Vuex、Flux、Redux、Redux-saga、Dva、MobX](https://zhuanlan.zhihu.com/p/53599723)

5、组件通信

常见使用场景可以分为三类：

- 父子通信：

  父向子传递数据是通过 props，子向父是通过 events（$emit）;
  通过父链 / 子链也可以通信（$parent / $children）;
  ref 也可以访问组件实例;
  provide / inject API;
  $attrs/$listeners
  
- 兄弟通信：

  Bus
  Vuex
  
- 跨级通信：

  Bus
  Vuex

## 参考地址

[](https://juejin.im/post/5e8b163ff265da47ee3f54a6)
