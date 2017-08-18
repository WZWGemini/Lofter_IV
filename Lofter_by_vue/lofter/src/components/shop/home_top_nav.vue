<template class="topNav-view">
  <div class="topNav">
    <ul>
      li
    </ul>
  </div>
</template>

<style lang="scss">
@import '../../assets/common.scss';

/* 底部导航栏样式 */
.topNav{
	width: 100%;
	position: fixed;
  top: 0;
  font-size: .35rem;
  background-color: $topic_color;
  ul {
    text-align: center;
    width: 100%;
    li {
      width: 23%;
      padding: .15rem 0 .1rem;
      display: inline-block;
      text-align: center;
      .link-class {
        color: #fff;
        p {
          font-size: .3rem;
        }
      }
    }
    li:focus {
      background-color: $topic_hcolor;
    }
  }
}


</style>
