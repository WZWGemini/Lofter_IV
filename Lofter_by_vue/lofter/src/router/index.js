import Vue from 'vue'
import Router from 'vue-router'
// app启动加载页面
import index from '@/view/index'
// 注册登录引导页面
import guide from '@/view/guide'
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
            // { path: 'addFollow', component: require('../components/home/addFollow') }
          ]
        },
        // 消息子路由
        { path: 'message',
          component: message
        },
        // 发现子路由
        {
          path: 'discover',
          component: require('../components/discover'),
          children: [
            { path: 'all', component: require('../components/discover/all') },
            { path: 'sport', component: require('../components/discover/sport') },
            { path: 'foot', component: require('../components/discover/music') },
            { path: 'shoot', component: require('../components/discover/detail') },
            { path: 'movie', component: require('../components/discover/detail') },
            { path: 'trip', component: require('../components/discover/detail') },
            { path: 'music', component: require('../components/discover/detail') }
          ]
        },
        // 我的子路由
        { path: 'mine', component: require('../components/mine/personal') }
      ]
    },
    { path: '/addFollow',
      component: require('../components/home/addFollow')
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
    },
    {
      path: '/guide',
      name: 'guide',
      component: guide
    },
    {
      path: '/lofter/issue/text/:type',
      name: 'text',
      component: require('../components/issue/text')
    },
    {
      path: '/lofter/issue/music',
      name: 'music',
      component: require('../components/issue/music')
    },
    {
      path: '/personal',
      name: 'personal',
      component: require('../components/mine/personal')
    },
    {
      path: '/tag/:tag_id',
      name: 'tag',
      component: require('../view/tag')
    },
    {
      path: '/personalhome',
      name: 'personalhome',
      component: require('../view/personal_home')
    },
    {
      path: '/test',
      name: 'test',
      component: require('../components/shop/home_top_nav')
    },
    // 单个文章页面
    {
      path: '/onearticle',
      component: require('../components/one_article')
    },
    // 我的关注
    {
      path: '/myfollow',
      component: require('../components/mine/my_follow')
    },
    {
      path: '/shop',
      name: 'shop',
      component: require('../view/shop'),
      // 在shop主界面定义嵌套路由
      children: [
        // 首页子路由
        { path: 'shome',
          component: require('../components/shop/shome')
        }
        // 结算子路由
        // { path: 'sbalance', component: require('../components/shop/shop_balance') }
      ]
    },
    // 详情页子路由
    { path: '/sgoods/:goods_id',
      component: require('../components/shop/shop_goods')
    },
    // 购物车路由
    {
      path: '/shopcar/:user_id',
      component: require('../components/shop/shop_cart')
    },
    // 结算路由
    { path: '/consigner/:user_id',
      component: require('../components/shop/shop_balance')
    },
    // 添加收货人路由
    { path: '/address/:user_id',
      component: require('../components/shop/shop_address')
    }
  ]
})
