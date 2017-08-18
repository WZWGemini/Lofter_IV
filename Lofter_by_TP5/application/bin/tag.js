var cheerio = require("cheerio");
var superagent = require("superagent");
var charset = require('superagent-charset');
charset(superagent);
// var charset = require('superagent-charset');
// charset(superagent);
var fs = require("fs");

//定义文章内容
var article_title = "",
article_href = "",
atitle = "";
//定义用户信息
var user_id= 0,
user_name= "",
user_head= "",
user_pwd= 123456;


var tag = JSON.parse( fs.readFileSync(__dirname+"/tag.json",'utf8') );
var key = process.argv[2] || 0;//关键字
var tag_id_exit = 0;
var json = []; //保存爬去回来的数据 以json对象数组保存
var user = []; //保存用户数据
var url ="";//爬取的页面
for(var i=0;i<tag.length;i++){
    if(tag[i].tag_content == key){
      url = tag[i].tag_url;
      tag_id_exit = tag[i].tag_id_exit;
      break;
    }
}

spider1(url).then(function(){
    console.log("文章查询完毕");
    try{
        fs.writeFile(__dirname+"/blog/b"+tag_id_exit+".json",JSON.stringify( json ) );
        // fs.writeFile(__dirname+"/user/u"+tag[index].tag_id_exit+".json",JSON.stringify( user ) );
        console.log("第一次写入完成");
    }catch(err){
        reject("第一次写入失败");
    }
    
}).then(function(){
    return new Promise(function(resolve, reject){
        var i = 0;
        var url = "http://photo.poco.cn/module_common/mypoco/user/usercard.php?uid=";
        // s_user = fs.readFileSync(url2,"utf8") ;
        spider2(url,i,resolve);
    });
}).then(function(data){
    console.log("用户头像查询完成");
    try{
        fs.writeFile(__dirname+"/user/u"+tag_id_exit+".json",JSON.stringify( user ) );
        console.log("第二次写入完毕"); 
    }catch(err){
        reject("写入失败");
    }
}).catch(function(err){
    console.log(err);
});


function spider1(url){//一层查询
    var promise = new Promise(function(resolve,reject){
    superagent.get(url).charset('gbk').end( function(err,res){
        var $ = cheerio.load(res.text, { decodeEntities: false }); //cheerio.load 解析html
        $(".mod-txtimg230-list").not(".photo-quan").find("ul li").each((index, item) => {
           if( index<10 ){
               // 文章
               article_content = $(item).find(".txt-box a span").html();
               article_img = $(item).find(".img-box img").attr("src").replace(/_230/,"_640").replace(/-c/,"");
               article_img = JSON.stringify([article_img]);
               // 用户
               user_id = $(item).find(".txt-box a[role='usercard']").data("usercard-uid");
               user_name= $(item).find(".txt-box a[role='usercard']").html();
               //插入数据
                user.push( {user_id, user_name, user_head,user_pwd} );
                json.push({ user_id, article_title,  article_content, article_img});
           }else{
               resolve();
           }
        });
        if(err){
          reject(err);
         }else{
           resolve();
        }
    });
  });
  return promise ;
}

function spider2(url,index,resolve){//二层查询
    superagent.get(url+user[index].user_id)
    .end(function(err, res) {
            let data = res.body.data;
            user[index].user_head = data.avatar.replace(/_32/,"").replace(/-c/,"");
            console.log( user[index].user_head );
            if(index < 9){
                console.log(index);
                spider2(url,++index,resolve);
            }else{
                console.log("over");
                resolve();
            }

    });
}