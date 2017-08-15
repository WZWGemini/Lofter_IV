$(function(){
	
	let obj=$('#page_center').children('div'),
	$nav_obj=$('.bro-tab-ul li'),
	$waterfall=$('.waterfall-col'),	
	flag=true,
	$doc=$(document);

	// tab选项卡
	$nav_obj.on('click',function(){
		let index = $($nav_obj).index(this);
		$nav_obj.eq(index).children().addClass('tab-border')
				.end().siblings().children()
				.removeClass('tab-border');
		obj.eq(index).stop().show(300).siblings().hide(300);
	})

	// 滚动事件
	$doc.scroll(function(e) {
		let page_h=$doc.height();			//文档高度（总高度）
		let screen_h=$(window).height();	//浏览器窗口高度
		let scroll_h=$doc.scrollTop();		//滚动条高度
		let height=page_h - screen_h;		
		if(page_h - screen_h - scroll_h <= 200){			
			if (flag) {
				flag=false;
				// 调用接口，获取数据数组
				$.post("/Lofter_by_TP5/public/web/blog/selectBlog",function(rtnData){
					console.log(rtnData.html);
					if (rtnData.status==1) {
						// 如果有数据,添加到最小索引的列
						flag=true;						
						rtnData.data.forEach(function(val,item){							
							setTimeout(function(){
								let index = min_index();
								let obj=rtnString(val);
								$waterfall.eq(index).append(obj);
							},item*500)
						});
					}else if(rtnData.status==0){
						// 如果返回一个空数据数组,flag=false,永远关闭，不会再请求接口
						flag=false;
					}				
				})
			}else{
				return;
			}
		}
	});

	// 获取每列高度返回最小索引
	function min_index(){
		let height_arr=[];
		$waterfall.each(function(index, el) {
			height_arr[height_arr.length]=$(el).height();					
		});
		let result_index = compare(height_arr);
		return result_index;
	}

	// 比较返回最小索引
	function compare(height_arr){
		let result=height_arr[0];
		let result_index=0;
		$.each(height_arr,function(index, arr) {			
			if(result>arr){
				result=arr;
				result_index=index;
			}
		});
		height_arr=[];
		return result_index;
	}

	function rtnString(water){
		let img = JSON.parse(water.article_img);
		// console.log(img);
		let str='<div class="waterfall-box">'+
					'<div class="waterfall-user">'+
						'<a class="span-img float-left">'+
							'<img src="'+water.user_head+'" class="img">'+
						'</a>'+
						'<a>'+
							'<span class="txt bro-txt">'+water.user_name+'</span>'+
						'</a>'+
						'<a href="" class="bro-follow">关注</a>'+
					'</div>'+
					'<div class="waterfall-img">'+
						'<img src="'+img[0]+'" class="img">'+
					'</div>'+
					'<div class="waterfall-content">'+
						'<div class="content-txt">'+
							'<p>'+water.article_content+'</p>'+
						'</div>'+
					'</div>'+
					'<div class="waterfall-likeIt">'+
						'<a class="bro-likeIt"></a>'+
						'<span>58人喜欢</span>'+
					'</div>'+
				'</div>'
		return str;
	}

	//点击返回标签模板页
	$(".bq").on('click',function(){
		$.post("/Lofter_by_TP5/public/web/browse/browseTags",function(res){
			if(res.status == 1){
				$("#random-tags").html(res.html);
			}
		})
	})
	//点击返回达人模板页
	$(".dr").on('click',function(){
		$.post("/Lofter_by_TP5/public/web/browse/browseMaster",function(res){
			if(res.status == 1){
				$("#master").html(res.html);
			}
		})
	})
})