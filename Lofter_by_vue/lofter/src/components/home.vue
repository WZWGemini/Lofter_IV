<template>
    <div class="home">
        <header>
          <ul class="head-ul">
            <li>
              <router-link to="path">关注</router-link>
            </li>
            <li>
              <router-link to="path">订阅</router-link>
            </li>
            <span class="icon-user-plus"></span>
          </ul>
          
        </header>
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

<style scoped>
.home{
  height: 100%;
}
.home header{
  font-size: 0.5rem;
}
.head-ul{
  overflow: hidden;
  padding: 0;
}
.head-ul li{
  float: left;
  font-size: 0.3rem;
  list-style: none;
}

</style>