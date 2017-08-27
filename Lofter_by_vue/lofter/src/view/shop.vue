<template>
  <div class="shop">
    <router-view>
    </router-view>
  </div>
</template>
<script>
// import {mapMutations, mapState} from 'vuex'
export default{
  name: 'shop',
  data () {
    return {

    }
  },
  components: {
  },
  computed: {
    // ...mapState(['goodsInfo', 'uinfo', 'hasLogin'])
  },
  methods: {
    // ...mapMutations(['goodsInfoSave']),
    // init: function () {
    //   this.$http.get('/api/shop')
    //     .then((rtnD) => {
    //       // console.log(rtnD)
    //       this.goodsInfoSave(rtnD)
    //     })
    // }
  }
}

</script>

<style>
.shop{
  height: 100%;
}
</style>