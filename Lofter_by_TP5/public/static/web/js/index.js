$(function(){
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
	$("#information").on('click','.options .comment',function(e){
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
	$("#information").on('click','#comment-push',function(e){
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
		//清空输入框
		$(this).prev().val("");
	});	

	//获取微博id
	$("#information").on('click',".options",blog.getArticleId);


	$("#information").on("click",'.list_box a',function(e){info_list_click(e)});

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
	$("#information").on("mouseenter",".labels>a",function(){
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
	$("#information").on("mouseleave",".labels>a",function(){
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


	
// 鼠标滑过显示弹窗 me
	// eleHover();
	// let obj2=$("#window_show");
	// function eleHover(){
	// 	let obj=$(".head-portrait-box");
	// 	obj.on("mouseenter",function(e){
	// 		eleEvent(e,obj2,'picture');
	// 		// 显示并请求
	// 		var user_id = $(this).data("uid");
	// 		console.log(user_id);
	// 		$.get("/Lofter_by_TP5/public/web/user/hoverShow",
	// 			  {user_id},
	// 			  function(data){
	// 				// 需要一个预加载
	// 				obj2.html(data.html);
	// 			  }
	// 		);
	// 	}).on("mouseleave",function(){
	// 		objHide();
	// 	})
	// }	
	// // 弹窗显示位置调整
	// function eleEvent(e,obj,obj1){
	// 	let $curr=$(e.target);
	// 	if($curr.hasClass(obj1)){
	// 		//获取鼠标经过的目标对象的高 
	// 		let	img_h=$curr.height(),
	// 		// 获取目标对象到顶部的距离
	// 			h=$curr.offset().top,
	// 		// 获取目标对象到左边的距离
	// 			w=$curr.offset().left,
	// 		// 弹窗对象本身的宽度
	// 			obj2_w=obj2.width();
			
	// 		obj.mousemove(function(ev){
	// 			let e=ev||event;
	// 			// 获取鼠标移动的坐标想x,y
	// 			let x=e.pageX;
	// 			let y=e.pageY;
	// 			// a：左右可以移动的范围（弹窗不会消失）
	// 			let a=(x < w + obj2_w) && (x > w);
	// 			// b：上下可以移动的范围（弹窗不会消失）
	// 			let b=(y > h) && (y < h + img_h +20);
				
	// 			if(a && b){
	// 				objShow();
	// 			} 
	// 		});
	// 		obj2.css({
	// 			left: w+'px',
	// 			top: h+img_h+20+'px'
	// 		}).stop().show(100);
	// 	}				
	// }
	// obj2.on('mouseover',function(){
	// 	objShow();
	// }).on('mouseout',function(){
	// 	objHide();
	// })
	// function objHide(){
	// 	obj2.stop().hide(100);
	// }
	// function objShow(){
	// 	obj2.stop().show(100);
	// }


})

window.blog={
	weibo_id : null,
	user_info : (function(){
		let user_info = sessionStorage.getItem('user_info');
		user_info = JSON.parse(user_info);
	})(),
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
//		location.reload();
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
		obj.modal('hide');
	}
};

