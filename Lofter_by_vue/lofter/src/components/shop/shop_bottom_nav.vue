<template class="bottomNav-shop">
  <div class="bottomNav">
    <ul>
      <li>
        <router-link to='/goods' class="link-class">
          <span class="icon-home"></span>
          <p>主页</p>
        </router-link>
      </li>
      <!-- <li>
        <router-link to='/' class="link-class">
          <span class="icon-indent-increase"></span>
          <p>收藏</p>
        </router-link>
      </li> -->
      <li>
        <router-link to='' class="link-class">
          <span class="icon-cart"></span>
          <p>购物车</p>
        </router-link>
      </li>
      <li class="li-class-add">
        <router-link to='' class="link-class" @click="addCart()">
          <span class="icon-user"></span>
          <p>加入购物车</p>
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {

}
</script>


<style lang="scss">
@import '../../assets/common.scss';

/* 底部导航栏样式 */
.bottomNav{
	width: 100%;
	position: fixed;
  bottom: 0;
  font-size: .35rem;
  background-color: #fff;
  ul {
    // text-align: center;
    width: 100%;
    li {
      width: 23%;
      padding: .15rem 0 .1rem;
      display: inline-block;
      text-align: center;
      .link-class {
        color: $topic_color;
        p {
          font-size: .3rem;
        }
      }
    }
    .li-class-add {
      float: right;
      width: 50%;
      background-color: #f95b07;
      .link-class {
        color: #fff;
      }
    }
    li:hover, li:focus {
      background-color: $topic_hcolor;
    }
  }
}


</style>
