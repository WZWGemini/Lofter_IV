$(document).ready(function(){
    var lock = true;
    var cur_tr = 8;
    console.log(cur_tr);
    var cur_span = 0    ;//点击的是哪个元素
    let $column = $("#data-show").find("th");//获取字段名
    $("#data-show").on("click", "td>span", function (e) {
        e.stopPropagation();
        let index = $(this).parent().index();//得知当前点击的是第几个元素
        cur_span = index;
        if(lock){
            let $tr = $(this).parents('tr');//获取当前行
            cur_tr = $tr.index();
            // console.log(cur_tr);
            let length = $tr.find('td').length;//
            let $newTr = $("<tr></tr>");//新建一个tr
            $tr .addClass('check');//添加选中样式
            //添加修改行
            $tr .clone()
                .find('td')
                .html(" ")
                .eq(index)
                .html("<input type='text'>")
                .end()
                .end()
                .insertAfter($tr); 
            showBtn(true);
            // lock = false;
        }else{
            $("#data-show tbody").find("tr").eq(cur_tr)
                                 .next()
                                 .find('td').eq(index)
                                 .html("<input type='text'>");
            // console.log($my);
            // console.log(cur_span);
        }
    })

   $("#save").on('click',function(){
       let $tr = $("#data-show tbody").find("tr").eq(cur_tr);//被点中的
       let formdata = getdata();
       let $edit = $tr.next().find('input');//获取所有input
       $.ajax({
           type   : 'POST',
           url    : 'edit',
           data   : formdata,
           processData: false,
           contentType: false,
           success:function(data){
               if(data.status){
                   $tr.removeClass("check");                   
                   $tr.next().remove();
                   addData(data.data, $tr);
                   showBtn(false);
                   cur_tr = $("#data-show tbody").find("tr").length;
               }else{
                   alert(data.msg);
               }     
           }
       });
       
       
   });

   $("#delete").on('click',function(){
        let $tr = $("#data-show").find("tr").eq(cur_tr+1);//被点中的
        let id = $tr.find('span').first().html();
        $.get("delete", {"user_id":id}, function(data){
            if(data.status){
                $tr.removeClass("check");
                $tr.next().remove();
                addData(data.data, $tr);
                showBtn(false);
            }else{
                alert("删除失败");
            }
        });
   });
   $("#add").on('click',function(){
        // showBtn(false);
        let $tr = $("<tr></tr>");
        $column.each((index, val)=>{
            if( val.innerHTML.indexOf("_id")>0 || val.innerHTML.indexOf("_time")>0 ){
                
                 $tr.append("<td><span style='width:100%;height:100%;'>"+val.innerHTML+"</span></td>")                
            }else{
                $tr.append("<td><input type='text' val='2'></td>")
            }
        });
        $("#data-show tbody").append($tr);
        showBtn(true);
        
   });
    $("#cancel").on('click',function(){
        let $tr = $("#data-show").find("tr").eq(cur_tr+1);//被点中的
        $tr.removeClass("check");
        $tr.next().remove();
        showBtn(false);
   });

   function addData(data, $tr){//添加数据
       let $trn = $("<tr class=''></tr>")
        $.each(data, (index , val) =>{
            if(val!=null){
                $trn.append("<td><span>"+val+"</span></td>");
            }else{
                $trn.append("<td><span style='width:100%;height:100%;'></span></td>");                           
            }
        });
        $tr.replaceWith($trn);
   }


   function getdata(){//获取数据,打包数据
       let formdata = new FormData();//存放数据
       
       let $tr = $("#data-show tbody").find("tr").eq( cur_tr );//被点中的tr
    //    let values = {};
       $tr.next().find('input').each(function(index, item){
            let col =$column.eq($(item).parent().index()).html()
            // values[col]  = item.value;
            formdata.append( col, item.value );
       });
        let $id = $tr.find("span").html();
        formdata.append($column.eq(0).html(),$id);//添加userId
        return formdata;//返回一个formdata对象
   }


    function showBtn(status){
        if(status){
            $("#cancel").show();//取消
            $("#save").show();//保存
            $("#delete").show();//删除
            $("#add").hide();//添加
            lock = false;
        }else{
            $("#cancel").hide();
            $("#save").hide();
            $("#delete").hide();
            $("#add").show();
            lock = true;
        }
    }

    
});