import Vue from 'vue'
import Router from 'vue-router'
<<<<<<< HEAD
import index from '@/view/index'
import login from '@/view/login'
import register from '@/view/register'
import lofter from '@/view/lofter'
import user from '@/components/user'
import home from '@/components/home'
=======
import index from '@/components/index'
import login from '@/components/login'
import register from '@/components/register'
import user from '@/components/user'
>>>>>>> fdf29ea986931b9270ff08949b73697bfd949bc9
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'index',
      component: index
    }, {
      path: '/login',
      name: 'login',
      component: login
    },
    {
      path: '/register',
      name: 'register',
      component: register
<<<<<<< HEAD
    }, {
      path: '/lofter/:path',
      name: 'lofter',
      component: lofter,
      // 在lofter主界面定义嵌套路由
      children: [
          { path: '/lofter/home', component: home },
          { path: '/lofter/discover', component: user },
          { path: '/lofter/mine', component: index }
      ]
=======
>>>>>>> fdf29ea986931b9270ff08949b73697bfd949bc9
    },
    {
      path: '/user',
      name: 'user',
      component: user
    }

  ]
})
