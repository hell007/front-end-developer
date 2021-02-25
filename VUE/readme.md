
## VUE 知识体系

1、mvvm

[剖析Vue2实现原理](./vue2.md)

[剖析Vue3实现原理](./vue3.md)

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



7、Vue2和Vue3的区别

[区别](./vue2-vue3-区别.md)

## 面试 

[Vue32问](https://mp.weixin.qq.com/mp/appmsgalbum?__biz=MzU1OTgxNDQ1Nw==&action=getalbum&album_id=1711105826272116736&scene=173&from_msgid=2247484654&from_itemidx=1&count=3#wechat_redirect)

[面试官：什么是虚拟DOM？如何实现一个虚拟DOM？](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw==&mid=2247484516&idx=1&sn=965a4ce32bf93adb9ed112922c5cb8f5&chksm=fc10c632cb674f2484fdf914d76fba55afcefca3b5adcbe6cf4b0c7fd36e29d0292e8cefceb5&scene=21#wechat_redirect)

[面试官：你是怎么处理vue项目中的错误的？](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw%3D%3D&chksm=fc10c742cb674e54188a8325db726e04cabbc87613bb90605a55f0dcc1aa32bde1cf5c845788&idx=2&mid=2247484692&scene=21&sn=71ad09fc1ab2338d132e2289d5a26ed3#wechat_redirect)

[面试官：说说你对keep-alive的理解是什么？怎么缓存当前的组件？缓存后怎么更新？](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw==&mid=2247484446&idx=1&sn=80d5a4a15c88f4d6fd878095101601e8&chksm=fc10c648cb674f5efbdad8222de6cd607870e44d5870480a229bfeefd6a78c3ba3b9d372ab37&scene=178&cur_album_id=1711105826272116736#rd)

[面试官：Vue组件间通信方式都有哪些?](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw==&mid=2247484224&idx=1&sn=3043891f60d99afcf74dffd6b9b51ff7&chksm=fc10c116cb674800b2757be9eb27fe20709de0e511b834d8bb6b23171218fa4a1cfd5f87596c&scene=178&cur_album_id=1711105826272116736#rd)

[面试官：说说你对slot的理解？slot使用场景有哪些？](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw==&mid=2247484401&idx=1&sn=ca97df335499c6b930ee2b5172524234&chksm=fc10c1a7cb6748b1b4b1df7782e30301e55b9d4d5331e4b39124cdc869d47db5a28d5194b162&scene=178&cur_album_id=1711105826272116736#rd)

[面试官：Vue中给对象添加新属性界面不刷新?](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw==&mid=2247484323&idx=1&sn=c2b5b9dd96fe17e62d9facc95cd1b534&chksm=fc10c1f5cb6748e39b862cb3f3327676a4502c2f2f658a28cf949a5f19bae62ea347559d23fb&scene=178&cur_album_id=1711105826272116736#rd)

[面试官：Vue要做权限管理该怎么做？控制到按钮级别的权限怎么做？](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw%3D%3D&chksm=fc10c6b4cb674fa2c30d5640b0328d6a9fc5392d8246683508fab849ab2802e22998d6de0db5&idx=1&mid=2247484642&scene=21&sn=f38d2fdd9c89526dd415f15fa3289380#wechat_redirect)

[面试官：了解过vue中的diff算法吗？说说看](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw==&mid=2247484533&idx=1&sn=0b21d608fa46145c5118e22fc33a5bcf&chksm=fc10c623cb674f35ef6e46d8a2aa70d524ee3a4ae005bf6e77008c3ce2510dcdb4d7bbde2667&scene=21#wechat_redirect)

[面试官：vue项目如何部署？有遇到布署服务器后刷新404问题吗？](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw%3D%3D&chksm=fc10c6aacb674fbc3f5013974644a7f62d8d97883aece9861207d2c9cd5c9e25c70eb2045c21&idx=1&mid=2247484668&scene=21&sn=927a6ccee00378a491f99234134d7253#wechat_redirect)

[面试官：跨域是什么？Vue项目中你是如何解决跨域的呢？](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw%3D%3D&chksm=fc10c6b8cb674faed209c152d1934b0ac9c6ec653ae4ae78ec4bd6ac254644a4c54d3bf9cabd&idx=1&mid=2247484654&scene=21&sn=2305434f7e8d165a33e9f0d0e4ac0cb1#wechat_redirect)

[面试官：SSR解决了什么问题？有做过SSR吗？你是怎么做的？](https://mp.weixin.qq.com/s?__biz=MzU1OTgxNDQ1Nw%3D%3D&chksm=fc10c6ebcb674ffd46b20d29b32f156e7cb8acb2c54ade0ed206b7ed887f6474a55849858ad4&idx=1&mid=2247484605&scene=21&sn=92e2e45cbba021fe685f0f8252ffe8b4#wechat_redirect)


