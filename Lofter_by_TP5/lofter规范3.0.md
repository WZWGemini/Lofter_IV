# Lofter

## 1. 项目录结构
```
application
  ├─background ----------------------- 后台
  │  ├─controller
  │  ├─model
  │  ├─validate
  │  └─view
  ├─extra
  ├─index
  │  └─controller
  └─web ----------------------- web端
      ├─controller ----------------------- 控制器
      ├─model ----------------------- 模块
      ├─validate ----------------------- 验证
      ├─view ----------------------- 视图
``` 
public
  ├─background ----------------------- 后台管理端静态文件
  │  ├─css
  │  ├─img
  │  ├─js
  │  └─lib
  │      └─Bootstrap3.3.7
  │          ├─css
  │          ├─fonts
  │          └─js
  └─web ----------------------- web端静态文件
      ├─css
      ├─img
      ├─js
      └─lib
          └─Bootstrap3.3.7
              ├─css
              ├─fonts
              └─js
```
  
### 1.1.约定编码规范
#### 1.1.1.HTML约定

- 在head中引入必要的CSS文件，优先引用第三方的CSS，方便我们自己的样式覆盖
- 在body末尾引入必要的JS文件，优先引用第三方的JS，注意JS文件之间的依赖关系，比如bootstrap.js依赖jQuery，那就应该先引用jquery.js 然后引用bootstrap.js  

```html
<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="my.css">
...
<script src="jquery.js"></script>
<script src="bootstrap.js"></script>
<script src="my.js"></script>
```

### 1.2.文件命名规则 (均用驼峰命名)

- PHP
  + 文件命名规则一律严格在按照tp5规范
  + 遇到要使用两个单词的话则需要使用驼峰命名法  
    > 例如： IndexSearch.php
- js
  + 如果考虑到模块化的话，命名：模块+‘.js’;
    > 例如：User.js
  + 不考虑模块化的话，就直接命名为： Index.js
- css 
  +  公共样式文件 main.css 用来存储个模版文件的公共样式设置，可以给用网上的 
    > 例如： *{}，body{}，ul{}，a{}
  + 重构第三方库的样式表 命名为：修改的第三方库+‘-re.css’
    > 例如： 重构第三方库 bootstarp-re.css
  + 模块样式文件同上 命名：模块+‘.css’;
  + 没有模块化就直接命名为 index.js
  + 所以css 样式表至少有三个文件
- html（视图文件）
  + 分块 模块+'.html';
    > 例如： header.html , show.html .....  

### 1.3.变量命名规则

- css类名（必要时，用’-‘ 来连接连个单词）两个不同模块可以存在相同子类类名
  > 例如： class = 'happy-ending-bth' 
- id名（必要时，用’_‘来连接两个单词）     
  > 例如 ：id = ' happy_ending_bth'
### 1.4.CSS约定

- 除了公共级别样式，其余样式全部由 模块前缀 id 来命名
  > 例如： #header>.nav
- 尽量使用直接子代选择器， 少用间接子代 避免错杀   
  > 例如： #header > div.nav > .box{}
  > 如果选择器过长，则可以使用子代选择器

### 1.6.外挂字体图标
```css
@font-face {
  font-family: 'itcast';
  src: url('../font/MiFie-Web-Font.eot') format('embedded-opentype'), url('../font/MiFie-Web-Font.svg') format('svg'), url('../font/MiFie-Web-Font.ttf') format('truetype'), url('../font/MiFie-Web-Font.woff') format('woff');
}

[class^="icon-"],
[class*=" icon-"] {
  /*注意上面选择器中间的空格*/
  /*我们使用的名为itcast的字体就是上面的@font-face的方式声明的*/
  font-family: itcast;
  font-style: normal;
}

.icon-mobilephone::before{
  content: '\e908';
}
```

```html
<div class="col-md-2 text-center">
  <a class="mobile-link" href="#">
    <i class="icon-mobile"></i>
    <!-- 这里使用的是bootstrap中的字体图标 -->
    <i class="glyphicon glyphicon-chevron-down"></i>
    <img src="..." alt="">
  </a>
</div>
```

#### 字体文件格式

- eot : embedded-opentype
- svg : svg
- ttf : truetype
- woff : woff



