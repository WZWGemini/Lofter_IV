const fs = require('fs');

const superagent = require("superagent");
const cheerio = require("cheerio");


if(process.argv[2]==null){
	console.log("没有传参url");
	return;
}

var url = process.argv[2];
console.log(url);

// 漫画URL http://www.kuaikanmanhua.com/?tag=19#type
// 摄影URL http://photo.poco.cn/like/index-upi-tpl_type-hot-channel_id-4.html#list
// 摄图网  http://699pic.com/people.html

// 创建存储的数组
var data = [];
superagent.get(url)
		  .end(function  (err,res) {
			// 获取返回的网页html
			// const $ = cheerio.load(res.text);
				var $ = cheerio.load(res.text);//cheerio.load 解析html
				// console.log(res);
				$("li.items").each(function(index, ele){
					const img = $(ele).find(".kk-img").data("kksrc");
					data.push({
						"article_title" :$(ele).find('.topic-tit a').html(),
						"article_img" :"["+img+"]",
						"user_head" : $(ele).find('.w-img img').attr("src"),
						"user_name" : $(ele).find('.topic-title').html()
					});
					console.log(ele.innerHTML);
				});
			// console.log(data);
			//存储数据
			// var pic_arr = [];
			// $lis.each(function(index,item){
			// 	var pic_title = $(item).find(">a").attr("title");
			// 	var pic_img = $(item).find(".lazy").attr('data-original');
			// 	console.log($(item).find(".lazy").attr('data-original'));
			// 	pic_arr.push({pic_title,pic_img});
			// });
			//把数据存储到文件中
			// fs.writeFile(__dirname+"/pic.json",JSON.stringify(pic_arr));
			fs.writeFile(__dirname+"/my.html",res.text);
			console.log("数据已存储到pic.json文件中");
			
		})
