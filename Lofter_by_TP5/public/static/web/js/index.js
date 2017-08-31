$(function(){

	let k = 0;
	blog.showBigImg($('.list_box'));


	// 搜索
	let search_obj = $("#search_peoAndTag"),
		box_obj = $("#index_subscribe");
	let delay=true;
	search_obj.on("focus", function () {
		// box_obj.stop().show(300);
		search_obj.on("keyup", function (e) {
			delay = e.timeStamp
			setTimeout(function() {
				if (delay - e.timeStamp == 0) {
					let val = search_obj.val();
					if (val && delay) {
						delay = !delay						
						// 调用接口						
						blog.search(val);
						// console.log("接口");
					}else{
						return;
					}
				}
			}, 500);			
		})
	}).on("blur", function () {
		box_obj.stop().hide(300);
		$("#peoAndTags").stop().fadeOut(300);
		search_obj.val("");
	})	
	//个人页面
	$("#menu").click(function(e){
		var curr=$(e.target);
		if(curr.hasClass("wz")){
			// 获取该用户的数据
			var user_info = JSON.parse( sessionStorage.getItem('user_info') ) || {};
			var user_id =user_info['user_id'];
			if( user_id ){//id不为空的时候才执行
				$.post("/Lofter_by_TP5/public/web/blog/personalBlog"
					  ,{user_id}
					  ,function(data){
							if(data.status){//判断返回状态
								$("#information").html(data.html);					
								$(".list_box").on("click",'a',function(evt){
									info_list_click(evt); 
								});
							}
				});
			}else{
				alert('你还没登录尼！');
			}
		}
	});
	
	// 音乐搜索
	let time;
	let $music_publish=$("#search_music");
	$music_publish.on("keyup",function(e){
		time=e.timeStamp;
		setTimeout(function(){
			if(time-e.timeStamp==0){
				let $music_list = $("#music_list");
				let article_music=$music_publish.val();
				if(article_music){
					blog.music_publish(article_music);
					$music_list.show(300);
				}else{
					$music_list.hide(300);
					return;
				}
			}
		},500);		
	});
	
	//评论显示
	var $information_obj = $("#information");
	$information_obj.on('click','.options .comment',function(e){
			let $comment_show = $(this).parents('.list_box').find('.comment_show');
			// 判断是否评论以显示
			if( $comment_show.is(":hidden") ){
				
				let article_id = $(this).parents('#info_list').data('article') ;
				let $that = $(this);
				$.post('/Lofter_by_TP5/public/web/comment/showComment',
					{article_id},
					function(data){
						if( data.status ){
							$comment_show.find(".comment-list-box").html(data.html);
						}
						$comment_show.slideDown();
				});
			}else{
				$comment_show.slideUp();
				$comment_show.find('.comment-list-box').html("");
			}
		// }
	});
	// 评论发布
	$information_obj.on('click','#comment-push',function(e){
		if(sessionStorage.user_info == null){
			alert("请先登录");
			return;
		}
		// 获取id
		let article_id = $(this).parents('.list_box').find('#info_list').data('article') ;
		//获取评论内容
		var comment_content = $(this).prev().val();
		//评论显示窗口
		let $comment_show = $(this).parent().next().find(".comment-list-box");
		$.post("/Lofter_by_TP5/public/web/comment/addComment"
			   ,{article_id ,comment_content}
			   ,function(data){   
					$comment_show.prepend(data.html);			
			   }
		);
		let $com_count = $(this).parents(".list_box").find("#com_count");
		// console.log(com_count);
		$com_count.html(+$com_count.html()+1); 
		//清空输入框
		$(this).prev().val("");
	});	

	//获取微博id
	$information_obj.on('click',".options", blog.getArticleId);

	$information_obj.on("click",'.list_box a',function(e){info_list_click(e)});

	function info_list_click(e){
		let curr=$(e.target);
		let article_id=curr.parents('.list_box').attr('data-index');
		// 删除
		if(curr.hasClass('del')){
			$('#del_blog_id').val(article_id);
		// 编辑
		}else if(curr.hasClass('edit')){
			$('#edit_blog_id').val(article_id);		
			let article_title = curr.parents('.tags').prev('div.list-text').children('div.article_title').find("p").text();
			let article_content = curr.parents('.tags').prev('div.list-text').children('div.article_content').html();
			let article_img = curr.parents('.tags').siblings('div.list-img').html();			
			let ue=UE.getEditor('container_edit');
			//清空存放的标签
			tag_save=[];
			//获取该微博标签
			$("#tags_area .tag_lists").html("");
			let arr_tag = $(e.target).parents(".options").prev('.labels').find('a');
			arr_tag.each(function(i,item){
				let tag_id = $(item).attr("data-id");
				$("#tags_area .tag_lists").append("<span data-id='" + tag_id + "'>" + $(item).text() + "</span>");
				tag_save.push(parseInt(tag_id));
			});
			article_content=article_img + article_content;
			ue.setContent(article_content);
			$("#blog_title_edit").val(article_title);
		}
	}
	//标签弹框
	var tag_en = false;
	var tag_show_en = false;
	$information_obj.on("mouseenter",".labels>a",function(){
		var $left = $(this).offset().left-$(this).width()/2-$("#tag_show").width()/2;
		$left = $left>10?$left:10;
		var $top = $(this).offset().top-$("#tag_show").height()-5;
		var $value = $(this).attr("data-tid");
		$("#tag_show").stop().show(200);
		$("#tag_show").offset({top:$top,left:$left});
		//获取信息
		$.get("/Lofter_by_TP5/public/web/index/tagShow?tag_id="+$value,function(res){
			if(res.status==1){
				$("#tag_show").html(res.html);
			}
		})
	})
	$information_obj.on("mouseleave",".labels>a",function(){
		$("#tag_show").hide(200);
	})
	$("#tag_show").on("mouseleave",function(){	
		$("#tag_show").hide(200);
	})
	$("#tag_show").on("mouseover",function(){
		$("#tag_show").stop().show();
	})

	// 鼠标滑过显示弹窗 头像弹窗
	eleHover();
	let obj2=$(".window_show");
	function eleHover(){
		let obj=$(".head-portrait-box");
		$("#information").on("mouseover",obj,function(e){
			eleEvent(e,obj,'picture',$("#window_show"));
		}).on("mouseout",function(){
			objHide();
		})
	}

	// 对悬浮框定位并且获取数据
	function eleEvent(e,obj,obj1,obj2){
		let $curr=$(e.target);
		if($curr.hasClass(obj1)){			
			let	img_h=$curr.height(),
				h=$curr.offset().top,
				w=$curr.offset().left,
				obj2_w=obj2.width();
			
			obj.mousemove(function(ev){
				let e=ev||event;
				let x=e.pageX;
				let y=e.pageY;
				
				let a=(x < w + obj2_w) && (x > w);
				let b=(y > h) && (y < h + img_h +20);

				if(a && b){
					objShow();
				} 
			})
			obj2.css({
				left: w+'px',
				top: h+img_h+20+'px'
			}).stop().show(100);

			let uid = $curr.attr("data-uid");
			//获取userShow html
			$.post("/Lofter_by_TP5/public/web/index/userShow",{uid:uid},function(res){
				if(res.status==1){
					$("#window_show").html(res.html);
				}
			})
		}				
	}

	obj2.on('mouseover',function(){
		objShow();
	}).on('mouseout',function(){
		objHide();
	})

	function objHide(){
		obj2.stop().hide(100);
	}

	function objShow(){
		obj2.stop().show(100);
	}
})

// 博客对象
window.blog={
	weibo_id : null,
	user_info : (function(){
		let user_info = sessionStorage.getItem('user_info');
		user_info = JSON.parse(user_info);
	})(),
	showBigImg:function () {

	},	
	search:function(val){
		$.post("/Lofter_by_TP5/public/web/blog/getSearchInfo", {key:val}, function (data) {
			if (data.status == 1) {				
				if (data.data[tag] !=[] && data.data[user] != []) {
					console.log(data.data);
					let my_obj = $("#index_subscribe"),
						html_obj = $("#peoAndTags");
					my_obj.stop().fadeOut(150);
					html_obj.html(data.html);
					$("#tag_title").html(val);
					$("#user_title").html(val);
					html_obj.stop().fadeIn(300);
				}
			}else{
				console.log(data.msg);
				return;
			}
		})
	},
	music_publish:function(article_music){
		$.getJSON("http://s.music.163.com/search/get/?version=1&src=lofter&type=1&filterDj=false&s="+article_music+"&limit=8&offset=0&callback=?",function(data){
			let str="";
			let objUl=$("#music_list");
			let music_data=data.result.songs;

			music_data.forEach((item,i)=>{
				str+='<li class="'+i+'">'+
						'<span class="singer">'+item.name+'</span>'+
						'<span>——</span>'+
						'<span class="song-info">'+item.album.name+'</span>'+
					'</li>'
			});

			let audio=music_data[0].audio,
			music_pic=music_data[0].album.picUrl,
			music_id=music_data[0].id,
			album=music_data[0].artists[0].name;
			
			
			objUl.children('#music_list_ul').html(str);

			objUl.on("click","li",function() {
				let $music_text=$("#music_text"),
				$search_music=$("#search_music"),
				$confirm_music_box=$(".confirm-music-box"),
				$music=$("#music");
				
				let src=music_pic+"?param=150x150x1";

				$(".mimg>img").attr("src",src);

				$music.attr('src',audio);
				
				objUl.hide(300);
				$search_music.val('');
				$search_music.hide(300);
				$confirm_music_box.show(300);
				$music_text.show(300);

				$('.music-close').on('click',function(){
					$confirm_music_box.hide(300);
					$search_music.show(300);
					$music.attr("src","");
				});

			});
		});
	},
	music_public:function(){
		let ue=UE.getEditor('container_music');
		let data=$("#music_form_modal").get(0);
		let music_pic=$("#music_pic").attr('src');
		let article_music=$("#music").attr('src');
		// console.log(music_pic);
		let form=new FormData(data);
		form.append('article_img',JSON.stringify([music_pic]));
		form.append('article_music',article_music);
		form.append("tag_arr" ,tag_save);
		$.ajax({
			url:"/Lofter_by_TP5/public/web/blog/insertBlog",
			type:"POST",
			data:form,
			processData:false,
			contentType:false,
			success:function(data){
				$("#information").prepend(data.html);
				$("#music_modal").modal('hide');
			}
		})		
	},
	publish:function(){
		if(sessionStorage.user_info == null){
			alert("请先登录");
			return;
		}
		var ue=UE.getEditor('container');
		var obj=$("#text_form_modal").get(0);
		var objT=$("#text_modal");
		this.common(ue,'/Lofter_by_TP5/public/web/blog/insertBlog',obj,objT,this.callback);	
		// 为何没有执行？
		blog.showBigImg($("list_box"));
		//文章数+1
		let num = parseInt($("#article_allnum").text())+1;
		$("#article_allnum").text(num);
		//清空标签
		tag_save = [];		
	},
	deleted:function(){
		if(sessionStorage.user_info == null){
			alert("请先登录");
			return;
		}
		let article_id=blog.weibo_id;
		if(article_id !=''){
			$.post('/Lofter_by_TP5/public/web/blog/deleteBlog', {article_id}, function(data) {
				if(data.status == 1){				
					$("#delete").modal('hide');
					$('.list_box[data-index='+article_id+']').remove();
					//文章数-1
					let num = parseInt($("#article_allnum").text())-1;
					num = num<0?0:num;
					$("#article_allnum").text(num);
				}
			});
		}
	},
	edit:function(){
		if(sessionStorage.user_info == null){
			alert("请先登录");
			return;
		}
		let article_id=blog.weibo_id;

		let ue=UE.getEditor('container_edit');
		
		var obj=$('#edit_form_modal').get(0);

		var objT=$("#edit_modal");

		this.common(ue,'/Lofter_by_TP5/public/web/blog/updateBlog',obj,objT,this.callback,article_id);
		$("edit_modal").hide();
		//清空标签
		tag_save = [];	
	},
	getArticleId:function(){
		blog.weibo_id = $(this).parents(".list_box").attr("data-index");
	},
	common:function(ue,url,obj,objT,callback,article_id){
		// 获取文本
		// var article_content=ue.body.innerText;

		var img=ue.getContent();

		// 匹配编辑器中输入的所有图片标签
		var imgReg = /<img.*?(?:>|\/>)/gi;

		// 匹配图片路径
		var srcReg = /src=[\'\"]?([^\'\"]*)[\'\"]?/i;

		var arr = img.match(imgReg);
		//保存发布的图片数组
		var article_img=[];

		if(arr){
			// 遍历图片标签，获取每个图片路径
			for (var i = 0; i < arr.length; i++) {
				 var src = arr[i].match(srcReg);
				 //获取图片地址
				 article_img[article_img.length]=src[1];		 	
			}
		}
		//存放tag的标签
		var tag_arr = [];
		$("#text_modal .tag_lists").children().each(function(index ,val){
			tag_arr.push($(val).data("id"));
		});
		tag_arr = tag_arr.join(",");
		//提交用的form表单
		var form=new FormData(obj);		
		
		form.append('article_img',JSON.stringify(article_img));
		form.append('article_content',ue.body.innerText);
		form.append("tag_arr" ,tag_save);
		if(article_id){
			form.append('article_id',article_id);
		}

		$.ajax({
			url:url,
			type:"POST",
			data:form,
			processData: false,  
	        contentType: false,
			success:function(data){
				callback(data,objT);
			}
		})
	},
	callback:function(data,obj){
		$("#information").prepend(data.html);
		console.log($("#information").find(".list_box") );
		obj.modal('hide');

	},
	showBigImg: function($obj) {
		// this.$target = $obj;	
		let k =0;
		$obj.on('click', '.list-img', function (e) {
			e.stopPropagation();
			let $curr = $(e.target);			
			if ($curr.hasClass('img')) {
				let flag = $curr.siblings('span.img-number').css('display');
				if (flag == 'block') {
					blog.showImg($curr);					
					flag = $curr.siblings('span.img-number').css('display');
				} else if (flag == 'none') {
					blog.hideImg($curr);
					flag = $curr.siblings('span.img-number').css('display');
				}					
			} else if ($curr.hasClass('see-img')) {			
				// 轮播显示			
				blog.carouselShow($curr);			
				$('#full_screen').off('click', '.Carousel');
				$('#full_screen').on('click', '.Carousel', function (e) {
					e.stopPropagation();
	
					let obj = $('#full_screen div.widthAuto'),
						obj1 = $('#full_screen li');
	
					let $curr = $(e.target);
					if ($curr.get(0).tagName === 'LI') {
						$('#full_screen').stop().fadeOut(300);
					} else if ($curr.get(0).tagName === 'IMG' || $curr.hasClass('next')) {
						(++k) > (obj.length - 1) ? k = 0: k;
						blog.carouselAnimate(obj, obj1, k);
					} else if ($curr.hasClass('prev')) {
						(--k) < 0 ? k = (obj.length - 1) : k;
						console.log(k)
						blog.carouselAnimate(obj, obj1, k);
					}					
				})
			}	
		})
	},
	showImg: function (curr) {
		// 数量隐藏
		curr.siblings('span.img-number').hide()
			.parent().addClass('img-details');
		// 图片和查看大图显示
		curr.siblings('span.see-img').removeClass('hide')
			.siblings('img.img').removeClass('hide');			
	},
	hideImg :function (curr) {
		curr.siblings('span.see-img').addClass('hide')
			.parent().removeClass('img-details');
		curr.first().siblings('img.img').addClass('hide')
			.siblings('span.img-number').show();			
	},
	carouselShow:function  (curr) {
		let obj1 = 	$('#full_screen .Carousel-ul');
		// 创建li
		this.createEle(obj1, curr);
		
		let	obj = $('#full_screen div.widthAuto');
		obj1.css({
			width: (obj.length * 100)+'vw'
		})
		obj.each(function (index,item) {
			let that = $(this);
			let w = that.width();
			that.css({
				'margin-left': -(w/2)+'px'
			})					
		})			
	},
	carouselAnimate:function  (obj, obj1, k) {
		obj1.animate({
			left: (-100*k)+'vw',						
		},500)

		obj.animate({
			height: '43vh',
			top: '30vh'
		},500,function () {
			obj.css({
				height: '86vh',
				top: '7vh'
			})				
		})
	},
	createEle:function  (obj1, curr) {
		let imgSrc = curr.siblings('img.img'),
			str = '';
		imgSrc.each(function(index, item) {
			let src = $(this).attr('src');
			str += blog.imgStr(src);
		});			
		obj1.html(str);
		$('#full_screen').stop().fadeIn(300);
	},
	imgStr:function  (src) {
		let str = '<li>'+
					'<div class="widthAuto box-shadow">'+
						'<img src="'+src+'" class="img">'+
					'</div>'+
				'</li>';
		return str;
	}
};

// 热度对象
window.hot = {
	// 热度显示
	show :function(obj){
		let $hot_show = $(obj).parents('.list_box').find('.hot_show');
		// 判断是否热度显示
		if( $hot_show.is(":hidden") ){
			let article_id = $(obj).parents('#info_list').data('article') ;
			let $that = $(obj);
			$.post('/Lofter_by_TP5/public/web/hot/showhot',
				{article_id},
				function(data){
					if( data.status ){
						$hot_show.find(".hot-list-box").html(data.html);
						$hot_show.slideDown();//有内容才显示
					}
			});
		}else{
			$hot_show.slideUp();
			$hot_show.find('.hot-list-box').html("");
		}
	},
	// 点赞
	hotLove : function(obj){
		if(sessionStorage.user_info == null){
			alert("请先登录");
			return;
		}
		// 获取id
		let article_id = $(obj).parents('.list_box').find('#info_list').data('article') ;
		$.post("/Lofter_by_TP5/public/web/Hot/Love"
			   ,{article_id}
			   ,function(data){
					let $hot_count = $(obj).parents(".list_box").find("#hot_count");
				   if(data.status){
						$hot_count.html(+$hot_count.html()+1); 
						$(obj).addClass("love-sure");//更改样式
						
				   }else{
						$hot_count.html(+$hot_count.html()-1); 					
									
						$(obj).removeClass("love-sure");//更改样式
				   }	
			   }
		);
	},
	// 推荐
	hotRecommend : function(obj){
		if(sessionStorage.user_info == null){
			alert("请先登录");
			return;
		}
		// 获取id
		let article_id = $(obj).parents('.list_box').find('#info_list').data('article') ;
		$.post("/Lofter_by_TP5/public/web/Hot/Recommend"
			   ,{article_id}
			   ,function(data){
				   let $hot_count = $(obj).parents(".list_box").find("#hot_count");
				   let recommend_allnum = $("#recommend_allnum").find(".count_article").html();
				   if(data.status){
						$hot_count.html(+$hot_count.html()+1); 
						$(obj).html("已推荐");
						$("#recommend_allnum").find(".count_article").html(++recommend_allnum);
				   }else{
						$hot_count.html(+$hot_count.html()-1); 					
						$(obj).html("推荐");
						$("#recommend_allnum").find(".count_article").html(--recommend_allnum);						
				   }
			   }
		);
	},
	// 瀑布流的点赞
	hotLove_water : function(obj){
		if(sessionStorage.user_info == null){
			alert("请先登录");
			return;
		}
		// 获取id
		let article_id = $(obj).parents('.waterfall-innerbox').data('aid') ;
		$.post("/Lofter_by_TP5/public/web/Hot/Love"
			   ,{article_id}
			   ,function(data){
					let $hot_count = $(obj).parents('.waterfall-innerbox').find("#hot_count");
				   if(data.status){
						$hot_count.html(+$hot_count.html()+1); 
						$(obj).addClass("bro-islove");
				   }else{
						$hot_count.html(+$hot_count.html()-1); 					
						$(obj).removeClass("bro-islove");					
				   }	
			   }
		);
	},
}

// $('.list_box').on('click', '.list-img', function (e) {


	// 首页图片放大以及轮播start
	// 首页图片放大以及轮播end
