<template>
    <!--公共底部  -->
    <div class='foot-nav'>
        <ul>
            <li>
                <router-link to='/lofter/home/follow'>
                    <span class='icon-home'></span>
                    <p>首页</p>
                </router-link>  
            </li>
            <li>
                <router-link to='/lofter/discover'>
                    <span class='icon-earth'></span>
                    <p>发现</p>
                </router-link> 
            </li>
            <li class="camera">
                <router-link to='/lofter/issue'>
                    <span class='icon-camera'></span>
                </router-link>
            </li>
            <li>
                <router-link to='/lofter/message'>
                    <span class='icon-bell'></span>
                    <p>消息</p>
                </router-link>
            </li>
            <li>
                <router-link to='/user'>
                    <span class='icon-user'></span>
                    <p>我的</p>
                </router-link>
            </li>
        </ul>  
    </div>
</template>
<script>
    export default {
      name: 'foot_nav',
      data () {
        return {
        }
      }
    }
</script>
<style scoped>
.foot-nav{
    background-color: #f5f5f5;
    font-size:0.58rem;
    width: 100%;
    padding:4px 0;
    position:fixed;
    bottom:0;
}
.foot-nav ul{
    padding: 0;
    margin:0;
    overflow:hidden;
}

.foot-nav a{
    text-decoration: none;
}
.foot-nav li{
    font-size:0.35rem;
    text-align:center;
    list-style:none;
    float:left;
    width:20%;
}
.camera{
    height: .78rem;
}
.camera a{
    display:inline-block;
    border: 1px solid #9e9e9e;
    border-radius:50%; 
    width: .75rem;
    height: .75rem;
}
.camera a span{
    display:inline-block;
    margin-top: .16rem;
}
.foot-nav li p{
    font-size:0.25rem;
    margin:0;
}

</style>