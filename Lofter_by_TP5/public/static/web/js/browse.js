$(function(){
	
	let $obj=$('#page_center').children('div'),
	$nav_obj=$('.bro-tab-ul li'),
	flag=true,//是否能滚动
	$doc=$(document),//文档
	cur_tab = 0;//当前的tab
	let page = 1;//瀑布流当前的页数
	// // tab选项卡
	// $(".bro-tab-ul").on('click',"li",function(){
	// 	let index = $(this).index();
	// 	// console.log($obj.eq(index));
	// 	// $obj.eq(index).show(200);
	// 	$nav_obj.eq(index).children().addClass('tab-border')
	// 			.end().siblings().children()
	// 			.removeClass('tab-border');
	// 	$obj.eq(index).stop().show(300).siblings().hide(300);//切换显示
	// 	if( $(".bro-tab .qs").hasClass("tab-border") ){
	// 		flag = true ;
	// 	}else{
	// 		flag = false;
	// 	}
	// });
	
	qsScroll(page);
	waterfall();

	if(flag){
		$doc.scroll(function(e) {
			let page_h=$doc.height();			//文档高度（总高度）
			let screen_h=$(window).height();	//浏览器窗口高度
			let scroll_h=$doc.scrollTop();		//滚动条高度
			let height=page_h - screen_h;
			if(page_h - screen_h - scroll_h <= 200){			
				if (flag) {
					flag=false;
					// 调用接口，获取数据数组
					page++;
					qsScroll(page);
				}else{
					return;
				}
			}
	});	 
	}
	function qsScroll(page = 1){
		// 加载文章数据
		$.post("/Lofter_by_TP5/public/web/blog/selectBlog",{"page":page},function(rtnData){
			if (rtnData.status==1){
				// 如果有数据,添加到最小索引的列
				flag=true;						
				rtnData.data.forEach(function(val,item){							
					setTimeout(function(){
						let obj=rtnString(val);
						$("#waterfall").append(obj);
						waterfall();
					},item*300)
				});
			}else if(rtnData.status==0){
				// 如果返回一个空数据数组,flag=false,永远关闭，不会再请求接口
				flag=false;
			}				
		});
	}
	//瀑布流的方法
	function waterfall(){
		let $water_box  = $(".waterfall-box");
		let water_box_w = $water_box.eq(0).outerWidth();
		let cols = Math.floor($(window).width() / water_box_w);
		// 设置大盒子的位置
		$("#waterfall").width(water_box_w*cols).css("margin","0 auto");

		let water_box_h_arr = [];//存放每列高度的数组
		$water_box.each((index ,val)=>{
			let h = $water_box.eq(index).outerHeight();//每个盒子的高度
			if(index<cols){
				water_box_h_arr.push(h);
			}else{
				let min_h = Math.min.apply(null, water_box_h_arr);//返回数组中最小的值
				let min_h_index = $.inArray(min_h, water_box_h_arr);//获取最小高度在数组中的索引
				$(val).css({
					"position" :"absolute",
					"top"      : min_h + "px",
					"left"	   : min_h_index*water_box_w+"px"
				});
				// 动态更改高度数组的每列的值
				water_box_h_arr[min_h_index] +=h;
			}
		});
	}
	function rtnString(water){
		let img = JSON.parse(water.article_img);
		// console.log(img);
		let is_follow = "";
		if(water.isFollow){
			is_follow = '<span data-type="delete">取消关注</span>';
		}else{
			is_follow = '<span data-type="save">关注</span>';
		}
		let str = `<div class="waterfall-box">
		<div class="waterfall-innerbox"  data-aid="${water.article_id}">
			<div class="waterfall-user" data-uid="${water.user_id}">
				<a class="span-img float-left">
					<img src="${water.user_head}" class="img">
				</a>
				<a>
					<span class="txt bro-txt">${water.user_name}</span>
				</a>
				<a href="javascript:void(0);" class="bro-follow data-uid="${water.user_id}">
					${is_follow}
				</a>
			</div>
			<div class="waterfall-img">
				<img src="${img[0]}" class="img">
			</div>
			<div class="waterfall-content">
				<div class="content-txt">
					<p>${water.article_content}</p>
				</div>
			</div>
			<div class="waterfall-likeIt">
				<a class="bro-likeIt ${(water.isLove?"bro-islove":"")}" onclick="hot.hotLove_water(this)"></a>
				<span><span id="hot_count">${water.num}</span>人喜欢</span>
			</div>
		</div>
	</div>`;
		return str;
	}

	//瀑布流的关注与取消关注
	$("#waterfall").on("click", '.bro-follow', function () {
		$type = $(this).find('span').attr("data-type");
		let obj = $(this).parents(".waterfall-user").get(0);
		if ($type == "save") {
			user.doSave(obj);
			$(this).html('<span data-type="delete">取消关注</span>');

		} else if ($type == "delete") {
			user.doDelete(obj);
			$(this).html('<span data-type="save">关注</span>');
		}
	})
	// 达人选项卡
	// 取消关注
	$("#daren").on("click",'.lost-follow', function () {
		// $type = $(this).find('span').attr("data-type");
		let obj = $(this).parents("li").get(0);
		user.doDelete(obj);
		alert("取消关注成功");
		$(this).attr("class","follow");
	})
	// 关注
	$("#daren").on("click",'.follow', function () {
		// $type = $(this).find('span').attr("data-type");
		let obj = $(this).parents("li").get(0);
		user.doSave(obj);
		alert("关注成功");
		$(this).attr("class","lost-follow");
	})

	// 推荐的关注
	$("#daren").on("click",'.followbtn', function () {
		// $type = $(this).find('span').attr("data-type");
		let obj = $(this).parents(".recomItem").get(0);
		user.doSave(obj);
		alert("关注成功");
		$(this).attr("class","icon2-8 btn lostFollowbtn");
	})
	//推荐关准取消
	$("#daren").on("click",'.lostFollowbtn', function () {
		// $type = $(this).find('span').attr("data-type");
		let obj = $(this).parents(".recomItem").get(0);
		user.doDelete(obj);
		alert("取消关注成功");
		$(this).attr("class","icon2-8 btn followbtn");
	})

})