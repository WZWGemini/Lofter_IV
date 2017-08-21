
// function p(data=1){
//     console.log("-----------------------");
//     console.log("这是第"+data+"层");
//     console.log("******************");  
//      var pm = new Promise(function(resolve,reject){
//         setTimeout(function() {
//           console.log("异步调用执行完成："+data);
//           resolve("我要传值给"+(data+1)+"层");
//         }, 1000*(4-data));
//      });
//      return pm;
//   }
  
  // p(1).then(function(msg){
  //    console.log(msg);
  //    return p(2);
  // }).then( msg=>{
  //   console.log(msg);
  //   return p(3);
  // } )
  // Promise.all( [p(1),p(2),p(3)])
  //        .then(function(msg){
  //          console.log(msg);
  //        })
  // function delay(times){
  //   setTimeout(function(){
  //      if(times<=6){
  //        console.log("这是第"+times+"次执行");
  //        delay(++times);
  //      }
  //   },1000);
  // }
  // new Promise(function(resolve, reject){
  //   delay(1);
  //   resolve();      
  // }).then(function(){
  //   console.log("ddddd");
  // })

  // if(process.argv[2]==null){
  //   console.log("选择第几篇文章");
  //   return;
  // }
let url = "/vision.htx&index_type=new&tid=-1&gid=2#list";
let url2 = "http://myicon211-c.poco.cn/17435/174358063_32.jpg";
// a = url.match(/\w+=(\d)/ig).join(" ").match(/\d/ig)[0];
// b = a[0].match(/(\d)/ig)
url2 = url2.replace(/_32/,"");
console.log(url2);