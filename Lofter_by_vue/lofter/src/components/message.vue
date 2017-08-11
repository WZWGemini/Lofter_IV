<template>
  <!--主页  -->
    <div class="message">
      <!-- 顶部固定导航栏 可滑动 -->
      <div class="top-nav">
         <ul>
          <li><router-link @click.native.prevent="active = 'tab-dynamic'" to="" active-class="nav-class">动态</router-link></li>
          <li><router-link @click.native.prevent="active = 'tab-news'" to="" active-class="nav-class">消息</router-link></li>
          <li><router-link @click.native.prevent="active = 'tab-chat'" to="" active-class="nav-class">聊天</router-link></li>
        </ul> 
      </div>  
      
      <!-- 消息 总页面内容 -->
      <div class="message-container">
        <!-- tab-container组件 -->
        <mt-tab-container v-model="active" swipeable>  
          <!-- 消息 动态页面内容 -->
          <mt-tab-container-item id="tab-dynamic">
            <DynamicContent></DynamicContent>
          </mt-tab-container-item>  
          <mt-tab-container-item id="tab-news" class="news-class">
            <NewsContent></NewsContent>
          </mt-tab-container-item>  
          <mt-tab-container-item id="tab-chat">  
            <ChatContent></ChatContent>
          </mt-tab-container-item>  
        </mt-tab-container>  
      </div>
    </div>
</template>
<script>
import { TabContainer, TabContainerItem } from 'mint-ui'
import Vue from 'vue'
import DynamicContent from '../components/message/dynamic'
import NewsContent from '../components/message/news'
import ChatContent from '../components/message/chat'
Vue.component(TabContainer.name, TabContainer)
Vue.component(TabContainerItem.name, TabContainerItem)
export default{
  name: 'message',
  data () {
    return {
      active: 'tab-dynamic'
    }
  },
  components: {
    DynamicContent,
    NewsContent,
    ChatContent
  }
}
</script>

<style scoped lang='scss'>
@import '../assets/common.scss';
.message{
  height: 100%;
  background-color: #efefef;
}
.top-nav {
  ul {
    width: 100%;
    font-size: .4rem;
    float: left;
    background-color: #fff;
    li {
      width: 33.3%;
      float: left;
      text-align: center;
      line-height: .9rem;
      border-bottom: 1px solid #eee;
      .nav-class {
      border-bottom: 2px solid $topic_color;
        color: $topic_color;
        display: inline-block;
        width: 100%;
      }
    }
  }
}
.message-container {
  width: 100%;
  float: left;
}



</style>