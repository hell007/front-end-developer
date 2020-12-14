## JavaScript 中 call()、apply()、bind() 的用法

### 案列

例 1

```
  var name = '李四', age = 18;
  var obj = {
    name: '张三',
    oAge: this.age,
    desc: function(){
      console.log('姓名：'+this.name+';年龄：'this.age)
    }
  }
  obj.objAge;  // 18
  obj.myFun()  // 姓名：张三;年龄：undefined

```

例 2

```
  var p = '张三'
  function show() {
    console.log(this.p)
  }
  shows()  // 张三
```

比较一下这两者 this 的差别，第一个打印里面的 this 指向 obj，第二个全局声明的 shows() 函数 this 是 window ；

### 1、 call()、apply()、bind() 都是用来重定义 this 这个对象的

```
  var name = '李四', age = 18;
  var obj = {
    name: '张三',
    oAge: this.age,
    desc: function(){
      console.log('姓名：'+this.name+';年龄：'this.age)
    }
  }
  
  var a = {
    name: '曹操',
    age: 100
  }
  
  obj.test.call(a);//姓名：曹操;年龄：100
  obj.test.apply(a);//姓名：曹操;年龄：100
  obj.test.bind(a)();//姓名：曹操;年龄：100
  
```

以上出了 bind 方法后面多了个 () 外 ，结果返回都一致！
由此得出结论，bind 返回的是一个新的函数，你必须调用它才会被执行。

### 2、 call 、bind 、 apply 传参情况不同

```
  var name = '李四', age = 18;
  var obj = {
    name: '张三',
    oAge: this.age,
    desc: function(){
      console.log('姓名：'+this.name+';年龄：'this.age+';来自'+from+';去往:'+to)
    }
  }
  
  var a = {
    name: '曹操',
    age: 100
  }
  
  obj.test.call(a,'成都','上海')；　　　　  // 姓名：曹操;年龄：100;来自:成都;去往上海
  obj.test.apply(a,['成都','上海']);      // 姓名：曹操;年龄：100;来自:成都;去往上海
  obj.test.bind(a,'成都','上海')();       // 姓名：曹操;年龄：100;来自:成都;去往上海
  obj.test.bind(a,['成都','上海'])();　　 // 姓名：曹操;年龄：100;来自:成都, 上海;去往 undefined
  
```

从上面四个结果不难看出:

call 、bind 、 apply 这三个函数的第一个参数都是 this 的指向对象，第二个参数差别就来了：

call 的参数是直接放进去的，第二第三第 n 个参数全都用逗号分隔，直接放到后面 obj.test.call(a,'成都', ... ,'string' );

apply 的所有参数都必须放在一个数组里面传进去 obj.test.apply(a,['成都', ..., 'string' ]);

bind 除了返回是函数以外，它 的参数和 call 一样。

当然，三者的参数不限定是 string 类型，允许是各种类型，包括函数 、 object 等等！





