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
        }
    }