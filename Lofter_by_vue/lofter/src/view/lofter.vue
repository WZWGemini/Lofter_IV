<template>
  <div class="lofter">
    <router-view>
  
    </router-view>
    <foot></foot>
  </div>
</template>
<script>
    import foot from '../components/foot_nav'
    export default{
      name: 'lofter',
      data () {
        return {

        }
      },
      components: {
        foot
      }
    }

</script>

<style>
.lofter{
  height: 100%;
}
</style>