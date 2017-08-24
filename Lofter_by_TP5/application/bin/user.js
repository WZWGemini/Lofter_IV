var cheerio = require("cheerio");
var superagent = require("superagent");
var charset = require('superagent-charset');
charset(superagent);
// var charset = require('superagent-charset');
// charset(superagent);
var fs = require("fs");



function spider2(url,index,resolve){//二层查询
    superagent.get(url+user[index].user_id)
    .end(function(err, res) {
            let data = res.body.data;
            user[index].user_head = data.avatar;
            console.log( user[index].user_head );
            if(index < user.length-1){
                console.log(index);
                spider2(url,++index,resolve);
            }else{
                console.log("over");
                resolve();
            }

    });
}
var user = JSON.parse( fs.readFileSync(__dirname+"/user.json",'utf8') );
var index = 0;
var url = "http://photo.poco.cn/module_common/mypoco/user/usercard.php?uid=";
 var p = new Promise(function(resolve, reject){
        // new Promise(){}
        spider2(url,index,resolve);
 }).then(function(){
    console.log("查询完毕");
    fs.writeFile(__dirname+"/user.json",JSON.stringify( user ) )
    console.log("写入完毕");
  }).catch(function(err){
      console.log(err);
  })
//   spider2("http://photo.poco.cn/module_common/mypoco/user/usercard.php?uid=",index).then(function(){
//     console.log("查询完毕");
//     fs.writeFile(__dirname+"/user.json",JSON.stringify( user ) )
//     console.log("写入完毕");
//   }).catch(function(err){
//       console.log(err);
//   })