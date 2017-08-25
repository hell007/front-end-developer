//柯里化
    function test(m){
        return function(n){
            return m+n;
        }
    }
    var n = test(2)(3);
    console.log(n)
