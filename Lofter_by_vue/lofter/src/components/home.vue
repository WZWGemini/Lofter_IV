<template>
  <!--主页  -->
    <div class="home">
         <header>
          <ul class="head-ul">
            <li>
              <router-link to="/lofter/home/follow" active-class='active' class="home-nav">关注</router-link>
            </li>
            <li>
              <router-link to="/lofter/home/desert" active-class='active' class="home-nav">订阅</router-link>
            </li>
              <router-link to="/lofter/addFollow"><span class="icon-user-plus"></span></router-link>
          </ul>
         </header> 
          <transition name="fade" mode="out-in">
            <router-view>
              
            </router-view>
          </transition>
    </div>
</template>
<script>
    export default{
      name: 'home',
      data () {
        return {

        }
      }
    }
</script>

<style scoped lang='scss'>
@import '../assets/common';
.home{
  height: 100%;
}
.home header{
  font-size: 0.5rem;
  margin: 0;
}
.head-ul{
  overflow: hidden;
}
.head-ul li{
  float: left;
  text-align: center;
  line-height: 0.7rem;
  width: 40%;
  font-size: 0.3rem;
  list-style: none;
}
.head-ul li a{
  display: inline-block;
  text-decoration: none;
  width: 100%;
}
.active{
  border-bottom: 2px solid #ccc;
  color: $topic_color;
  font-weight: 600;
}
.home-nav {
  color: $topic_color;
}
.head-ul span{
  display: inline-block;
  color: $topic_color;
  margin-top:3%; 
  margin-left:10%; 
  font-size: 0.4rem;
}  

</style>