var cheerio = require("cheerio");
var superagent = require("superagent");
var charset = require('superagent-charset');
charset(superagent);
// var charset = require('superagent-charset');
// charset(superagent);
var fs = require("fs");

var json = []; //保存爬去回来的数据 以json对象数组保存
var user = []; //保存用户数据
var tag =  [];  //保存标签
//定义文章内容
var article_title = "",
    article_href = "",
    atitle = "";
//定义用户信息
 var user_id= 0,
  user_name= "",
 user_head= "",
 user_pwd= 123456

var tag_id_exit =0,
    tag_content = "",
    tag_url = "";

    
function spider1(url){//一层查询
     var promise = new Promise(function(resolve,reject){
     superagent.get(url).charset('gbk').end( function(err,res){
         var $ = cheerio.load(res.text, { decodeEntities: false }); //cheerio.load 解析html
        //  $(".mod-txtimg230-list").not(".photo-quan").find("ul li").each((index, item) => {
        //     // 文章
        //     article_content = $(item).find(".txt-box a span").html();
        //     article_img = $(item).find(".img-box img").attr("src");
        //     // 用户
        //     user_id = $(item).find(".txt-box a[role='usercard']").data("usercard-uid");
        //     user_name= $(item).find(".txt-box a[role='usercard']").html();
            
        //     // 插入数据
        //      user.push( {user_id, user_name, user_head,user_pwd} );
        //      json.push({ user_id, article_title,  article_content, article_img});
        //   });
          
          $(".select-box-con li").not('.cur').each( (index, item)=>{
            //标签
            // console.log(itme);
            let url =$(item).find("a").attr("href");
            // console.log(url.match(/\w+=(\d)/ig) );
            let id = url.match(/\w+=(\d+)/ig).join(" ").match(/\d+/)[0];
            console.log(id);
            tag_id_exithan = id;
            tag_content = $(item).find("a").html();
            tag_url = "http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid="+tag_id_exit+"#list";            
            tag.push( {tag_id_exit,tag_content,tag_url} );
         });
         resolve();
     });
   });
   return promise ;
}
//                      /vision.htx&p=2&index_type=new&tid=-1&gid=6#list
// http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=5#list
// http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=-1#list
// http://photo.poco.cn/vision.htx&index_type=new&gid=-1#list 主页
//
spider1("http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=-1#list").then(function(){
  // fs.writeFile(__dirname+"/article.json",JSON.stringify( json ) );
  // fs.writeFile(__dirname+"/user.json",JSON.stringify( user ) );

  fs.writeFile(__dirname+"/tag.json",JSON.stringify( tag ) );
  console.log("写入完毕");
}).catch(function(err){
})
