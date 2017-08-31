$(function(){
	// 加载更多start
	let $document = $(document),
		index = 2,
		loadOff = true;
	$document.scroll(function(){
		let page_h = $document.height(),
			scroll_h = $document.scrollTop(),
			screen_h = $(window).height();
		if(page_h - scroll_h - screen_h <= 200 && loadOff){
			console.log(true);
			loadOff = false;
			loadMore();
			// console.log(index);
		} else {
			return;
		}
	})
	function loadMore () {
		$.get("/Lofter_by_TP5/public/web/index/loadMore", {page:index}, function (data) {
			if(data.status ==1){
				index++;
				loadOff = true;
				$("#information").append(data.html);
			}else{
				return;
			}
		})
	}
	// 加载更多end
})