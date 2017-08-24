<template>
  <!--登陆界面  -->
  <div class="login">
    <mt-header fixed title="登录LOFTER" class="top-nav">
      <router-link to="/guide" slot="left">
        <mt-button icon="back"></mt-button>
      </router-link>
    </mt-header>
    <div class="content">
      <div class="landing-logo">
          <img class="replace-2x" src="../assets/img/logo.png" alt="img" width="100">
      </div>
      <div class="welcome-text">
        <h3>Welcome to Lofter</h3>
      </div>
      <div class="login-form">
        <ul class="login-ul">
          <li class="login-li">
            <label for="user_name">用户名</label>
            <input type="text" id='user_name' v-model="user_name"/>
          </li>
          <li class="login-li">
            <label for="user_password">密&nbsp;&nbsp;码</label>
            <input type="password" id='user_password' v-model="user_pwd"/>
          </li>
        </ul>
          <router-link to="/lofter/discover" class="form-control btn btn-success btn-login">登录</router-link>
      </div>
        <p class="bottom-text">2017. Welcome to Lofter</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
// 单独引入mapMutations 辅助函数
import {mapMutations, mapState} from 'vuex'
export default {
  name: 'login',
  data () {
    return {
      user_name: '',
      user_pwd: ''
    }
  },
  computed: {
    ...mapState(['hasLogin', 'uinfo'])
  },
  methods: {
    // 使用辅助函数  (传入参数为对象，将setUinfo映射到setname上)
    ...mapMutations({
      setname: 'setUinfo'
    })
  },
  // 使用导航钩子 检查跳转
  beforeRouteLeave (to, from, next) {
    // console.log(to)
    // console.log(from)
    if (to.path === '/lofter/discover') {
      // 发送请求
      axios.get('/api/user', {
        // 使用get方法必须先将参数放在params里面，否则无法传输数据
        // 而使用post方法  无需将参数放在params
        params: {
          user_name: this.user_name,
          user_pwd: this.user_pwd
        }
      }).then((response) => {
        console.log(response)
        if (response.data.status === 1) {
          this.setname(response.data.info)
          if (this.hasLogin) {
            next()
          } else {
            next(false)
          }
        }
        this.$toast(response.data.msg)
      }).catch((error) => {
        console.log(error)
      })
    }
    if (to.path === '/') {
      next()
    }
  }
}
</script>

<!-- 添加scoped属性限制这个style的作用范围只作用于本组件 -->
<style scoped lang="scss">
  @import '../assets/common.scss';
  /* CSS Document */

  body{
    background-color:#FFF;
  }

  a, ul, li {text-decoration:none;list-style:none;}

  .top-nav{
    background-color: $topic_color;
    font-size: .3rem;
    height: 10%;
  }

  .landing-logo{
    width:30%;
    margin-left:auto;
    margin-right:auto;
    padding-top:1.8rem;
  }

  .bottom-txt{
    margin-bottom:50px;
    text-align:center;
  }

  .welcome-text h3{
    font-family:'Raleway', sans-serif;
    font-size: .3rem;
    color:#535353;
    font-weight:300;
    text-align:center;
    text-transform:uppercase;
    margin-top:20px;
    margin-bottom:50px;
  }

  .welcome-text p{
    text-align:center;
    font-size:14px;
    font-family:'Dosis', sans-serif;
    font-weight:400;
    text-transform:uppercase;
    margin-top:5px;
    color:#ce1a13;
  }

  .login-form{
    width:75%;
    margin-left:auto;
    margin-right:auto;	
  }
  .login-ul {
    padding: 0;
  }
  .login-li {
    height: .6rem;
    border-bottom: 2px solid #efefef;
    margin-bottom: .2rem;
    font-size:.25rem;
  }

  .login-li label {
    text-align:center;
    display:inline-block;
    width: 17%;
    margin-right: 0.15rem;
  }

  .login-li input {
    border: none;
    height: .55rem;
    outline: none;
    font-size: .4rem;
    width: 60%;
    color: #9d9d9d;
  }

  .btn-login {
    height: .6rem;
    color: #fff;
    background-color: #336162;
    border-color: #4cae4c
  }
  .btn-login.focus,
  .btn-login:focus {
    color: #fff;
    background-color: #488283;
    border-color: #488283
  }
  .btn-login:hover {
    color: #fff;
    background-color: #488283;
    border-color: #488283
  }

  .btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: .28rem;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px
  }

  .form-control {
    position: relative;
    z-index: 2;
    float: left;
    width: 90%;
    margin-bottom: 0
  }

  .bottom-text{
    color:#252525;
    display:block;
    text-transform:uppercase;
    float:none;
    text-align:center;
    padding-top:1.5rem;
    font-size:.2rem;
  }
  .login{
    padding: 0;
  }
</style>
