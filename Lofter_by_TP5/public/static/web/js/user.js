///Lofter_by_TP5/public/web/user/login/
window.user = {
        uid : 0, 
        formData : [],
        doAjax : function(action){
             $.ajax({
                type : "post",
                url : '/Lofter_by_TP5/public/web/user/'+action,
                data : this.formData,
                processData : false,
                contentType : false,
                success : function(data){  
                    if( action == 'logout'){
                        this.uid = 0;
                        sessionStorage.removeItem("user_info");
                        location.href = "/Lofter_by_TP5/public/web/index/login";
                    }else{
                    //    data = JSON.parse(data);
                        if(data.status == 1){
                            let user_info = JSON.stringify( {
                                "user_id" : data.data['user_id'],
                                "user_name" : data.data['user_name'],
                                "user_head" : data.data['user_head']
                            });
                            this.uid = data.data['user_id'];
                            sessionStorage.setItem('user_info' ,user_info);
                            if( action == 'login'){
                                // alert("登录成功");
                            }else{
                                alert("注册成功");                                
                            }
                            location.href = "/Lofter_by_TP5/public/web/index"; 
                        }else{
                            alert('请求失败');
                        }  
                    }
                    //   
                }
            });
        },
        doLogin : function(btn){
             let form = $("#R_L").get(0);
            //  填入表单数据
            this.formData = new FormData( form );
            this.doAjax("login");
        },
        doReg : function(){
            let form = $("#R_L").get(0);
            // 填入表单数
            this.formData = new FormData( form );
            
            this.doAjax("register");
        },
        doLogout : function(){
           this.doAjax("logout");
        },
        doCheck : function(obj){
            let user_name = obj.value;
            console.log(user_name);
            $.post('/Lofter_by_TP5/public/web/user/queryUser' 
                    ,{user_name} 
                    ,function(data){
                        if(data.status){
                            alert("该昵称可用");
                        }else{
                            alert("该用户已注册");
                        }
            }); 
        },
        // 跳转个人页面
        goUserHome: function (obj) {
            var uid = $(obj).data("uid");
            location.href = "/Lofter_by_TP5/public/web/user/goUserHome?uid="+uid;
        },
        //关注他人
        doSave: function(obj){
            let uid = $(obj).attr("data-uid");
            $.post("/lofter_by_tp5/public/web/concern/save?concern_user_id="+uid,function(res){
                if(res.status == 1){
                    // alert("关注成功");
                    return true;
                }
                    // alert("关注失败");
                    return false;
            })
        },
        //取消关注
        doDelete: function(obj){
            let uid = $(obj).attr("data-uid");
            $.post("/lofter_by_tp5/public/web/concern/delete?concern_user_id="+uid,function(res){
                if(res.status == 1){
                    // alert("取消关注成功");
                    return true;
                }
                    // alert("取消关注失败");
                    return false;
            })
        }
    }

/********************触发*****************/
$(function(){
    // ///--------------------------------------------------------------------------
    //关注与取消关注
    $("#window_show").on("click", '.user-care', function () {
        $type = $(this).find('span').attr("data-type");
        // $uid = $(this).attr("data-uid");
        if ($type == "save") {
            user.doSave(this);
            $(this).html('<span data-type="delete">取消关注</span>');
            //关注数量+1
            $("#concern_num").text(parseInt($("#concern_num").text()) + 1);
        } else if ($type == "delete") {
            user.doDelete(this);
            $(this).html('<b>+</b><span data-type="save">关注</span>');
            //关注数量-1
            $("#concern_num").text(parseInt($("#concern_num").text()) - 1);
        }
    })

})