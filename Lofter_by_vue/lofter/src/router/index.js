import Vue from 'vue'
import Router from 'vue-router'
// app启动加载引导登陆注册页面
import index from '@/view/index'
// 登陆注册页面
import login from '@/view/login'
import register from '@/view/register'
// app主页面（app内部页面）
import lofter from '@/view/lofter'
// 个人主页
import user from '@/view/user'
// 评论页面
import comment from '@/view/comment'
// app内部首页
import home from '@/components/home'
// import homeFollow from '@/components/home/follow'
import homeDesert from '@/components/home/desert'
// app内部 消息页面
import message from '@/components/message'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'index',
      component: index
    },
    {
      path: '/login',
      name: 'login',
      component: login
    },
    {
      path: '/register',
      name: 'register',
      component: register
    },
    {
      path: '/lofter',
      name: 'lofter',
      component: lofter,
      // 在lofter主界面定义嵌套路由
      children: [
        // 首页子路由
        { path: 'home',
          component: home,
          // 在子路由中需要定义 关注 与 订阅 子路由
          children: [
            { path: 'follow', component: require('../components/home/follow') },
            { path: 'desert', component: homeDesert }
          ]
        },
        // 发现子路由
        { path: 'message',
          component: message
        },
        // 发现子路由
          { path: 'discover', component: user },
          // 我的子路由
          { path: 'mine', component: user }
      ]
    },
    {
      path: '/user',
      name: 'user',
      component: user
    },
    {
      path: '/comment',
      name: 'comment',
      component: comment
    }

  ]
})
