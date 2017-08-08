<template>
    <div>
        <ul class='foot-nav'>
            <li>
                <router-link to='/home'>
                    <span class='icon-home'></span>
                    <p>首页</p>
                </router-link>  
            </li>
            <li>
                <router-link to='/discover'>
                    <span class='icon-earth'></span>
                    <p>发现</p>
                </router-link> 
            </li>
            <li>
                <router-link to='/issue'>
                    <span class='icon-camera'></span>
                </router-link>
            </li>
            <li>
                <router-link to='/message'>
                    <span class='icon-bell'></span>
                    <p>消息</p>
                </router-link>
            </li>
            <li>
                <router-link to='/mine'>
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
          selected: null
        }
      }
    }
</script>
<style scoped>
.foot-nav{
    background-color: #f5f5f5;
    font-size:0.58rem;
    overflow:hidden;
    width: 100%;
    padding:4px 0;
    margin:0;
    position:fixed;
    bottom:0;
}
.foot-nav li{
    font-size:0.35rem;
    text-align:center;
    list-style:none;
    float:left;
    width:20%;
}
.foot-nav li p{
    font-size:0.25rem;
    margin:0;
}

</style>