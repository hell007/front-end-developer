
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
  
6、 Virtual DOM
 
- 虚拟DOM到底是什么？
 
其实VNode，是对真实DOM的一种抽象描述，就是一个普通的JavaScript对象，包含了 属性（props）、标签名（tag）、数据(data)、子节点(children)、键值等，其它属性都是用来扩展 VNode 的灵活性以及实现一些特殊特征的。

由于 VNode 只是用来映射到真实DOM的渲染，不需要包含操作DOM的方法，因此它是非常轻量和简单的。

Virtual DOM 除了它的数据结构的定义，映射到真实的 DOM 实际上要经历 VNode 的 create、diff、patch 等过程。


[虚拟 DOM 到底是什么？(长文建议收藏)](https://mp.weixin.qq.com/s/oAlVmZ4Hbt2VhOwFEkNEhw)

## 参考地址

[](https://juejin.im/post/5e8b163ff265da47ee3f54a6)
