<template>
    <div class="desert">
        <div class="my-desert">
            <dl>
                <dt>我的订阅</dt>
                <dd>
                     <ul>
                           <li class="desert-img">
                             <img src="../../assets/img/user_bg.jpg">
                            </li>  
                         <li class="desert-msg">
                           <div class="msg-name">
                             <p>漫威</p>
                             <span>855</span>
                           </div>
                           <div class="msg-btn">
                             订阅
                           </div>
                         </li>
                     </ul>
                </dd>
            </dl>
        </div>
        <div class="rec-desert">
            
        </div>
    </div>    
</template>
<script>
    
</script>
<style lang="scss">
.desert{
  font-size: .3rem;
  .my-desert{
    dt{
      border-bottom: 1px solid #e0e0e0;
      padding-left:5%;
    }
    dd{
      padding:.2rem 5% .2rem 5%;
      ul{
        overflow:hidden;
        li{
          width: 50%;
          float: left;
          img{
            width: 100%;
          }
        }
        .desert-img{
          width: 15%;
        }
        .desert-msg{
          overflow: hidden;
          margin-left:5%;
          width: 80%;
          border-bottom: 1px dashed #e0e0e0;
          div{
            height:.8rem;
            float:left;
            p{
              height: .4rem;
            }
            span{
              font-size: .2rem;
              color: #bdbdbd;
            }
          }
          .msg-name{
            width: 80%;
          }
          .msg-btn{
            line-height: .8rem;
          }
        }
      }
      
    }
  }
}
</style>