<template class="bottomNav-view">
  <div class="bottomNav">
    <ul>
      <li>
        <router-link to='/goods' class="link-class">
          <span class="icon-home"></span>
          <p>主页</p>
        </router-link>
      </li>
      <li>
        <router-link to='/' class="link-class">
          <span class="icon-indent-increase"></span>
          <p>分类</p>
        </router-link>
      </li>
      <li>
        <router-link to='/' class="link-class">
          <span class="icon-cart"></span>
          <p>购物车</p>
        </router-link>
      </li>
      <li>
        <router-link to='/' class="link-class">
          <span class="icon-user"></span>
          <p>我的</p>
        </router-link>
      </li>
    </ul>
  </div>
</template>

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
    text-align: center;
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
    li:hover, li:focus {
      background-color: $topic_hcolor;
    }
  }
}


</style>
