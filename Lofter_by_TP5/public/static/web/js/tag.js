$(function () {
	//存储插入的标签
	window.tag_save = [];

	//标签插入操作
	$(".tag-add").keyup(function (e) {
		e.preventDefault();//禁止按钮默认行为
		let $that = $(this);//点击的对象
		let $tags_area = $that.parent();
		// 获取tag的值
		let this_val = $that.val();
		//判断用户输入的标签长度是否超过5
		if (this_val.length >= 5) {
			$that.css('border', '1px solid red');
		} else {
			$that.css('border', 'none');
		}
		// 当键盘事件是回车的时候，新增加
		if (e.keyCode == 13 && this_val != "") {
			// 回车添加
			$.post("/Lofter_by_TP5/public/web/tag/addTag", { tag_content: this_val }, function (rtnData) {
				if (rtnData.status) {//成功插入后才去做插入标签操作
					//清空输入框
					$that.val("");
					//如果标签已存在则不执行下面操作
					if ($.inArray(rtnData.data.tag_id, tag_save) != -1) {
						return;
					}
					$("#tags_area .tag_lists").append("<span data-id='" + rtnData.data.tag_id + "'>#" + this_val + "</span>");
					//存储标签
					tag_save.push(rtnData.data.tag_id);
				} else {//不成功则跳出行为
					return;
				}
			})
		} else if (e.keyCode == 8 && this_val == "") {//按下 回退 键和输入框为空的时候才执行
			//获取最近的一个span标签、
			let remove_el = $(".tag_lists").children().eq(-1);
			var tag_id = parseInt(remove_el.attr("data-id"));
			$tag_index = $.inArray(tag_id, tag_save);
			tag_save.splice($tag_index,1);
			remove_el.remove();
		}
	})

})