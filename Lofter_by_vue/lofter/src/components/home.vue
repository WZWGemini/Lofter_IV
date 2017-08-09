<template>
    <div class="home">
         <header>
          <ul class="head-ul">
            <li>
              <router-link to="/lofter/home/follow" active-class='active'>关注</router-link>
            </li>
            <li>
              <router-link to="/lofter/home/desert" active-class='active'>订阅</router-link>
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
.home{
  height: 100%;
  padding:0 3%;
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
}
.head-ul span{
  display: inline-block;
  margin-left:10%; 
  font-size: 0.4rem;
}  

</style>