//柯里化
`
function test(m){
    return function(n){
        return m+n;
    }
}
var n = test(2)(3);
console.log(n)
`


//js 链式调用
`
function add(n) {
  var fn = function(m) {
    return add(n + m);
  };

  fn.valueOf = function() {
    return n;
  };

  fn.toString = function() {
    return '' + n;
  };

  return fn;
}
`

>因为是链式调用，所以返回值肯定是一个函数，这个函数我们记为fn。
这个fn就是下一次调用的函数，当然它还是会返回一个函数，显然这个函数跟fn的结构是完全一样的。但是如果这样一直写下去，你要写无数次。所以呢，直接返回add就可以了，有点类似递归。
而且，第二次调用add时需要把之前的结果累加进去，所以是add(m + n)，“加法”就是在这一步实现的。
既然每次都返回一个函数，那么怎样把计算结果取出来呢？我们把返回值函数的toString和valueOf方法重写了，让它们返回和。这是因为对象(函数也是一种对象)在转为原始类型时，会调用自身的toString和(或)valueOf方法。这样以来，就可以把结果用在表达式中了，例如：

`
+add(1) // 结果 1
+add(1)(2) // 结果 3
+add(1)(2)(3) // 结果 6
+add(1)(2)(3)(4) // 结果 10
'' + add(1)(2)(3)(4) // 结果 "10"
`
