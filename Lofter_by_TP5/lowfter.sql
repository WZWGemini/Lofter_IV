-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-08-18 17:18:26
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lowfter`
--

-- --------------------------------------------------------

--
-- 表的结构 `lofter_article`
--

CREATE TABLE `lofter_article` (
  `article_id` int(11) NOT NULL COMMENT '文章ID',
  `user_id` int(11) NOT NULL COMMENT '文章发布者ID',
  `article_title` varchar(255) DEFAULT NULL COMMENT '文章标题',
  `article_content` text NOT NULL COMMENT '文章内容',
  `article_time` int(11) NOT NULL COMMENT '文章发布时间',
  `article_img` varchar(255) DEFAULT NULL COMMENT '单发图片的路径',
  `article_music` varchar(255) DEFAULT NULL COMMENT '音乐的路径',
  `article_video` varchar(255) DEFAULT NULL COMMENT '视频的路径'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表';

--
-- 转存表中的数据 `lofter_article`
--

INSERT INTO `lofter_article` (`article_id`, `user_id`, `article_title`, `article_content`, `article_time`, `article_img`, `article_music`, `article_video`) VALUES
(1, 1, '', '【右视觉摄影】 孑然·...', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/6345677120170818110644049_640.jpg?1150x1727_120"]', NULL, NULL),
(2, 2, '', '微笑的温度', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/17776440720170818110552093_640.jpg?1365x2048_120"]', NULL, NULL),
(3, 3, '', '致敬23', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/17728928320170818110620052_640.jpg?2048x1280_120"]', NULL, NULL),
(4, 4, '', '闭起双眼你最挂念谁', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18680424120170818110735054_640.jpg?1134x709_120"]', NULL, NULL),
(5, 5, '', '一朵花开的时间', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/1849842202017081810533104_640.jpg?1300x1733_120"]', NULL, NULL),
(6, 6, '', '孑然·暗香', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/3982494920170818105519011_640.jpg?1150x1727_120"]', NULL, NULL),
(7, 7, '', '水边', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/18542048020170818105117090_640.jpg?2048x1536_120"]', NULL, NULL),
(8, 8, '', 'CosPaly人物', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170731/13/17900743320170731135840073_640.jpg?500x750_120"]', NULL, NULL),
(9, 9, '', '阿乔的私房照', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/18662791220170818104501039_640.jpg?2048x1365_120"]', NULL, NULL),
(10, 10, '', '尤那沙', 1503029812, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/18535578820170818104406036_640.jpg?1365x2048_120"]', NULL, NULL),
(11, 11, '', '第19届国际植物学大会...', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/17498489120170818110514099_640.jpg?1365x2048_120"]', NULL, NULL),
(12, 12, '', '十三陵水库', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/6483508920170818114933071_640.jpg?932x625_130"]', NULL, NULL),
(13, 13, '', '新昌大佛寺II', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/4443668920170818111157090_640.jpg?1200x800_120"]', NULL, NULL),
(14, 14, '', '当你看到前面阴影的时...', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18403577220170818110812088_640.jpg?1536x2048_120"]', NULL, NULL),
(15, 15, '', '田子坊', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/18528749920170818103238040_640.jpg?1776x1184_120"]', NULL, NULL),
(16, 16, '', '魔都 魔都', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/18528749920170818102959097_640.jpg?1776x1184_120"]', NULL, NULL),
(17, 17, '', '2017，我们有约---小聚...', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/09/17963720520170818093030065_640.jpg?2048x1366_120"]', NULL, NULL),
(18, 18, '', '灯塔', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/18708383520170818102440061_640.jpg?1440x1103_120"]', NULL, NULL),
(19, 19, '', '高手在民间', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/5479906720170818101935085_640.jpg?648x1152_120"]', NULL, NULL),
(20, 20, '', '晚宴', 1503030244, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/18549739420170818101310084_640.jpg?1620x1080_120"]', NULL, NULL),
(21, 21, '', '漫卷残云', 1503030283, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/18666707120170818102742058_640.jpg?2048x1033_120"]', NULL, NULL),
(22, 22, '', '红红的鸡蛋花', 1503030283, '["http://image18.poco.cn/mypoco/myphoto/20170715/17/6497240720170715175002099_640.jpg?800x766_120"]', NULL, NULL),
(23, 23, '', '橡树啄木鸟', 1503030283, '["http://image13.poco.cn/mypoco/myphoto/20170818/09/5383272720170818095324019_640.jpg?1200x800_120"]', NULL, NULL),
(24, 24, '', '荷', 1503030283, '["http://image13.poco.cn/mypoco/myphoto/20170818/09/18720107220170818094911093_640.jpg?2000x1394_120"]', NULL, NULL),
(25, 25, '', '小熊猫', 1503030283, '["http://image13.poco.cn/mypoco/myphoto/20170818/09/18660460020170818090020042_640.jpg?2048x1356_120"]', NULL, NULL),
(26, 26, '', '白莲', 1503030283, '["http://image13.poco.cn/mypoco/myphoto/20170818/08/18660460020170818085921065_640.jpg?2048x1356_120"]', NULL, NULL),
(27, 27, '', '一丝秋意', 1503030283, '["http://image13.poco.cn/mypoco/myphoto/20170818/08/18695717420170818083003064_640.jpg?2048x1452_120"]', NULL, NULL),
(28, 28, '', '自驾川西2--白玉县白玉...', 1503030283, '["http://image13.poco.cn/mypoco/myphoto/20170818/08/4639501020170818080256020_640.jpg?2048x1278_120"]', NULL, NULL),
(29, 29, '', '捉鱼的白鹭', 1503030283, '["http://image13.poco.cn/mypoco/myphoto/20170818/08/5360949920170818082831014_640.jpg?1704x1089_120"]', NULL, NULL),
(30, 30, '', '飞燕凌空育雏忙', 1503030283, '["http://image13.poco.cn/mypoco/myphoto/20170818/08/5639543720170818082355047_640.jpg?1024x683_120"]', NULL, NULL),
(31, 31, '', '黑暗中的灯', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170818/00/18720984320170818003406059_640.jpg?1024x1024_120"]', NULL, NULL),
(32, 32, '', '家常菜', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170817/19/18703305920170817194038078_640.jpg?1809x1280_120"]', NULL, NULL),
(33, 33, '', '花开半夏', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170817/12/18735032420170817123140089_640.jpg?612x816_120"]', NULL, NULL),
(34, 34, '', '安静的风', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170817/12/18735032420170817122810029_640.jpg?1040x780_120"]', NULL, NULL),
(35, 35, '', '遇见798', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170817/12/18735032420170817121553065_640.jpg?780x1040_120"]', NULL, NULL),
(36, 36, '', '夏天', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170817/11/18503399720170817114002076_640.jpg?657x658_120"]', NULL, NULL),
(37, 37, '', '独。自', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170817/01/6468263520170817013518030_640.jpg?909x1364_120"]', NULL, NULL),
(38, 38, '', '手机里の蓝天', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170817/00/5783731820170817005329096_640.jpg?1100x1100_120"]', NULL, NULL),
(39, 39, '', 'Long Long Journey Ⅳ', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170816/22/6277600520170816225619020_640.jpg?2048x1370_120"]', NULL, NULL),
(40, 40, '', '恋爱的力量', 1503030324, '["http://image13.poco.cn/mypoco/myphoto/20170816/22/6432479820170816221246088_640.jpg?1000x667_120"]', NULL, NULL),
(41, 41, '', '祖国的蓝天', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18695125120170818111257012_640.jpg?669x446_120"]', NULL, NULL),
(42, 42, '', '车流', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18730605020170818111123056_640.jpg?2048x1365_120"]', NULL, NULL),
(43, 43, '', '韵', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18421456920170818110313072_640.jpg?2048x764_120"]', NULL, NULL),
(44, 44, '', '贵阳白鹭湖', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18730605020170818110454057_640.jpg?1152x2048_120"]', NULL, NULL),
(45, 45, '', '其实我只是个门外汉，...', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18734848620170818110503019_640.jpg?1040x780_120"]', NULL, NULL),
(46, 46, '', '邛崃南河随拍', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/1871750722017081811083408_640.jpg?992x517_120"]', NULL, NULL),
(47, 47, '', '华灯初上', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18642786920170818110428087_640.jpg?2048x1366_120"]', NULL, NULL),
(48, 48, '', '八月', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18735023520170818110735071_640.jpg?2000x2000_120"]', NULL, NULL),
(49, 49, '', '家乡夜色', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/11/18720667720170818110357021_640.jpg?1280x720_120"]', NULL, NULL),
(50, 50, '', 'Travelling can\'t...', 1503030345, '["http://image13.poco.cn/mypoco/myphoto/20170818/10/17540617520170818105625014_640.jpg?684x1024_120"]', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `lofter_comment`
--

CREATE TABLE `lofter_comment` (
  `comment_id` int(11) NOT NULL COMMENT '评论ID',
  `user_id` int(11) NOT NULL COMMENT '评论者ID',
  `article_id` int(11) NOT NULL COMMENT '被评论的文章ID',
  `comment_content` varchar(255) NOT NULL COMMENT '评论内容',
  `comment_time` int(11) NOT NULL COMMENT '评论时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';

--
-- 转存表中的数据 `lofter_comment`
--

INSERT INTO `lofter_comment` (`comment_id`, `user_id`, `article_id`, `comment_content`, `comment_time`) VALUES
(19, 1, 63, '6363663', 111111),
(20, 2, 63, '636636ss3', 111111),
(21, 2, 62, '62662262', 33333333),
(22, 2, 61, '6161616161', 3333333),
(23, 1, 67, '是是是', 1501751874),
(24, 21, 95, 'asdff ', 1501814638),
(25, 1, 95, '这个是ttest', 1501815924),
(26, 1, 95, '这个是ttest', 1501815949),
(27, 2, 106, 'df', 1501816717),
(28, 2, 105, 'sdf ', 1501816722),
(29, 2, 104, 'we', 1501816726),
(30, 2, 106, 'ddd', 1501817071),
(31, 2, 107, 'ddd', 1501827844),
(32, 2, 107, 'dddf', 1501828107),
(33, 24, 143, '111', 1502282514),
(34, 24, 143, '222', 1502282518),
(35, 24, 154, '11111', 1502370342),
(36, 24, 162, '111', 1502511618),
(37, 1, 175, '1', 1502849131);

-- --------------------------------------------------------

--
-- 表的结构 `lofter_concern`
--

CREATE TABLE `lofter_concern` (
  `concern_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `concern_user_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关注表';

--
-- 转存表中的数据 `lofter_concern`
--

INSERT INTO `lofter_concern` (`concern_id`, `user_id`, `concern_user_id`, `create_time`) VALUES
(11, 1, 24, 1502859900),
(17, 24, 1, 1502877503),
(24, 25, 24, 1502878219),
(25, 50, 49, 1503045931),
(26, 50, 48, 1503045941);

-- --------------------------------------------------------

--
-- 表的结构 `lofter_hot`
--

CREATE TABLE `lofter_hot` (
  `hot_id` int(11) UNSIGNED NOT NULL,
  `article_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `hot_love` int(2) UNSIGNED ZEROFILL NOT NULL DEFAULT '00',
  `hot_recommend` int(2) UNSIGNED ZEROFILL NOT NULL DEFAULT '00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `lofter_shop`
--

CREATE TABLE `lofter_shop` (
  `shop_id` int(11) NOT NULL,
  `show_name` varchar(100) NOT NULL,
  `shop_img` varchar(100) NOT NULL,
  `show_describe` text,
  `user_id` int(11) NOT NULL,
  `is_show` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `lofter_shopcar`
--

CREATE TABLE `lofter_shopcar` (
  `shopcar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `shop_num` int(11) NOT NULL COMMENT '要购买商品的数量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `lofter_shop_attr`
--

CREATE TABLE `lofter_shop_attr` (
  `shop_attr_id` int(11) NOT NULL,
  `shop_attr_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `lofter_shop_detail`
--

CREATE TABLE `lofter_shop_detail` (
  `shop_detail_id` int(11) NOT NULL,
  `shop_detail_json` varchar(255) NOT NULL,
  `shop_store` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品详情';

-- --------------------------------------------------------

--
-- 表的结构 `lofter_shop_history`
--

CREATE TABLE `lofter_shop_history` (
  `shop_history_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `shop_num` int(11) NOT NULL,
  `shop_time` int(11) NOT NULL COMMENT '购买时间',
  `user_address` varchar(255) NOT NULL COMMENT '收货地址',
  `is_get` tinyint(4) DEFAULT '0' COMMENT '确认收货'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购买记录';

-- --------------------------------------------------------

--
-- 表的结构 `lofter_shop_spec`
--

CREATE TABLE `lofter_shop_spec` (
  `shop_spec_id` int(11) NOT NULL,
  `shop_spec_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品规格表';

-- --------------------------------------------------------

--
-- 表的结构 `lofter_shop_type`
--

CREATE TABLE `lofter_shop_type` (
  `shop_type_id` int(11) NOT NULL COMMENT '商品类型id',
  `shop_type_name` varchar(100) NOT NULL COMMENT '商品类型名称',
  `shop_parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品父级id,0为一级菜单',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品类型表';

-- --------------------------------------------------------

--
-- 表的结构 `lofter_tag`
--

CREATE TABLE `lofter_tag` (
  `tag_id` int(11) NOT NULL COMMENT '标签ID',
  `tag_id_exit` int(11) UNSIGNED DEFAULT NULL,
  `tag_content` varchar(255) NOT NULL COMMENT '标签内容',
  `tag_url` varchar(255) DEFAULT NULL COMMENT '爬取的tag的url'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lofter_tag`
--

INSERT INTO `lofter_tag` (`tag_id`, `tag_id_exit`, `tag_content`, `tag_url`) VALUES
(1, 0, '人像', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=0#list'),
(2, 5, '风景', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=5#list'),
(3, 1, '生态', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=1#list'),
(4, 6, '纪实', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=6#list'),
(5, 3, '生活', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=3#list'),
(6, 11, 'LOMO', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=11#list'),
(7, 16, '观念', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=16#list'),
(8, 10, '商业', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=10#list'),
(9, 14, '妆型', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=14#list'),
(10, 13, '宠物', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=13#list'),
(11, 12, '达物', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=12#list'),
(12, 15, '汽车', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=15#list'),
(13, 4, '夜景', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=4#list'),
(14, 2, '运动', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=2#list'),
(15, 17, '潜水', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=17#list'),
(16, 18, '儿童', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=18#list'),
(17, 19, '航拍', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=19#list'),
(18, 23, '手机摄影', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=23#list'),
(19, 8, '其他', 'http://photo.poco.cn/vision.htx&index_type=new&tid=-1&gid=8#list');

-- --------------------------------------------------------

--
-- 表的结构 `lofter_tag_article`
--

CREATE TABLE `lofter_tag_article` (
  `tag_article_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `lofter_tag_article`
--

INSERT INTO `lofter_tag_article` (`tag_article_id`, `article_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 10, 1),
(11, 11, 4),
(12, 12, 4),
(13, 13, 4),
(14, 14, 4),
(15, 15, 4),
(16, 16, 4),
(17, 17, 4),
(18, 18, 4),
(19, 19, 4),
(20, 20, 4),
(21, 21, 3),
(22, 22, 3),
(23, 23, 3),
(24, 24, 3),
(25, 25, 3),
(26, 26, 3),
(27, 27, 3),
(28, 28, 3),
(29, 29, 3),
(30, 30, 3),
(31, 31, 6),
(32, 32, 6),
(33, 33, 6),
(34, 34, 6),
(35, 35, 6),
(36, 36, 6),
(37, 37, 6),
(38, 38, 6),
(39, 39, 6),
(40, 40, 6),
(41, 41, 2),
(42, 42, 2),
(43, 43, 2),
(44, 44, 2),
(45, 45, 2),
(46, 46, 2),
(47, 47, 2),
(48, 48, 2),
(49, 49, 2),
(50, 50, 2);

-- --------------------------------------------------------

--
-- 表的结构 `lofter_user`
--

CREATE TABLE `lofter_user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_head` varchar(255) DEFAULT 'upload\\img\\default_head.jpg' COMMENT '用户头像路径',
  `create_time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `lofter_user`
--

INSERT INTO `lofter_user` (`user_id`, `user_name`, `user_pwd`, `user_head`, `create_time`) VALUES
(1, '右视觉摄影', '123456', 'http://myicon211.poco.cn/6345/63456771.jpg', 1503029812),
(2, '黄小小小_鹏', '123456', 'http://myicon211.poco.cn/17776/177764407.jpg', 1503029812),
(3, 'CarzyPhoenix凤癫癫', '123456', 'http://myicon211.poco.cn/17728/177289283.jpg', 1503029812),
(4, 'L。', '123456', 'http://myicon211.poco.cn/18680/186804241.jpg', 1503029812),
(5, '三金侠', '123456', 'http://myicon211.poco.cn/18498/184984220.jpg', 1503029812),
(6, 'eale老秘', '123456', 'http://myicon211.poco.cn/3982/39824949.jpg', 1503029812),
(7, '鱼仔', '123456', 'http://myicon211.poco.cn/18542/185420480.jpg', 1503029812),
(8, '盟捷文化礼仪柳强', '123456', 'http://myicon211.poco.cn/17900/179007433.jpg', 1503029812),
(9, '奔跑的笑笑易爆炸', '123456', 'http://myicon211.poco.cn/18662/186627912.jpg', 1503029812),
(10, '女民工金媛', '123456', 'http://myicon211.poco.cn/18535/185355788.jpg', 1503029812),
(11, '雁客留影', '123456', 'http://myicon211.poco.cn/17498/174984891.jpg', 1503030244),
(12, '百合', '123456', 'http://myicon211.poco.cn/6483/64835089.jpg', 1503030244),
(13, 'Mirage2000', '123456', 'http://myicon211.poco.cn/4443/44436689.jpg', 1503030244),
(14, '春', '123456', 'http://myicon211.poco.cn/18403/184035772.jpg', 1503030244),
(15, '呼叫海大星', '123456', 'http://myicon211.poco.cn/18528/185287499.jpg', 1503030244),
(16, '呼叫海大星', '123456', 'http://myicon211.poco.cn/18528/185287499.jpg', 1503030244),
(17, '红袖添香', '123456', 'http://myicon211.poco.cn/17963/179637205.jpg', 1503030244),
(18, 'wuliの公瑾', '123456', 'http://myicon211.poco.cn/18708/187083835.jpg', 1503030244),
(19, '高阳山顶', '123456', 'http://myicon211.poco.cn/5479/54799067.jpg', 1503030244),
(20, '快乐每一天', '123456', 'http://myicon211.poco.cn/18549/185497394.jpg', 1503030244),
(21, '一叶孤舟', '123456', 'http://myicon211.poco.cn/18666/186667071.jpg', 1503030283),
(22, '叶儿', '123456', 'http://myicon211.poco.cn/6497/64972407.jpg', 1503030283),
(23, 'tango', '123456', 'http://myicon211.poco.cn/5383/53832727.jpg', 1503030283),
(24, '大勇image', '123456', 'http://myicon211.poco.cn/18720/187201072.jpg', 1503030283),
(25, 'veDa', '123456', 'http://myicon211.poco.cn/18660/186604600.jpg', 1503030283),
(26, 'veDa', '123456', 'http://myicon211.poco.cn/18660/186604600.jpg', 1503030283),
(27, '心已远', '123456', 'http://myicon211.poco.cn/18695/186957174.jpg', 1503030283),
(28, '纪录轮回', '123456', 'http://myicon211.poco.cn/4639/46395010.jpg', 1503030283),
(29, 'zgj', '123456', 'http://myicon211.poco.cn/5360/53609499.jpg', 1503030283),
(30, '红木棉', '123456', 'http://myicon211.poco.cn/5639/56395437.jpg', 1503030283),
(31, '关涛涛屁事', '123456', 'http://myicon211.poco.cn/18720/187209843.jpg', 1503030324),
(32, 'Harper', '123456', 'http://myicon211.poco.cn/18703/187033059.jpg', 1503030324),
(33, '爱穿T恤的少年', '123456', 'http://myicon211.poco.cn/18735/187350324.jpg', 1503030324),
(34, '爱穿T恤的少年', '123456', 'http://myicon211.poco.cn/18735/187350324.jpg', 1503030324),
(35, '爱穿T恤的少年', '123456', 'http://myicon211.poco.cn/18735/187350324.jpg', 1503030324),
(36, '啊颜z', '123456', 'http://myicon211.poco.cn/18503/185033997.jpg', 1503030324),
(37, '郑荐蓝LAN', '123456', 'http://myicon211.poco.cn/6468/64682635.jpg', 1503030324),
(38, '王小多', '123456', 'http://myicon211.poco.cn/5783/57837318.jpg', 1503030324),
(39, '陳小信', '123456', 'http://myicon211.poco.cn/6277/62776005.jpg', 1503030324),
(40, '般梦般醒', '123456', 'http://myicon211.poco.cn/6432/64324798.jpg', 1503030324),
(41, '清凉风', '123456', 'http://myicon211.poco.cn/18695/186951251.jpg', 1503030345),
(42, 'Cage', '123456', 'http://myicon211.poco.cn/18730/187306050.jpg', 1503030345),
(43, '麒麟映画', '123456', 'http://myicon211.poco.cn/18421/184214569.jpg', 1503030345),
(44, 'Cage', '123456', 'http://myicon211.poco.cn/18730/187306050.jpg', 1503030345),
(45, '北颠', '123456', 'http://myicon211.poco.cn/18734/187348486.jpg', 1503030345),
(46, '石边', '123456', 'http://myicon211.poco.cn/18717/187175072.jpg', 1503030345),
(47, 'Titanium', '123456', 'http://myicon211.poco.cn/18642/186427869.jpg', 1503030345),
(48, '杨乐', '123456', 'http://myicon211.poco.cn/18735/187350235.jpg', 1503030345),
(49, '道欲何求', '123456', 'http://myicon211.poco.cn/18720/187206677.jpg', 1503030345),
(50, 'test', '123456', 'http://myicon211.poco.cn/17540/175406175.jpg', 1503030345);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lofter_article`
--
ALTER TABLE `lofter_article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `lofter_comment`
--
ALTER TABLE `lofter_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `lofter_concern`
--
ALTER TABLE `lofter_concern`
  ADD PRIMARY KEY (`concern_id`);

--
-- Indexes for table `lofter_hot`
--
ALTER TABLE `lofter_hot`
  ADD PRIMARY KEY (`hot_id`);

--
-- Indexes for table `lofter_shop`
--
ALTER TABLE `lofter_shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `lofter_shopcar`
--
ALTER TABLE `lofter_shopcar`
  ADD PRIMARY KEY (`shopcar_id`);

--
-- Indexes for table `lofter_shop_attr`
--
ALTER TABLE `lofter_shop_attr`
  ADD PRIMARY KEY (`shop_attr_id`);

--
-- Indexes for table `lofter_shop_detail`
--
ALTER TABLE `lofter_shop_detail`
  ADD PRIMARY KEY (`shop_detail_id`);

--
-- Indexes for table `lofter_shop_history`
--
ALTER TABLE `lofter_shop_history`
  ADD PRIMARY KEY (`shop_history_id`);

--
-- Indexes for table `lofter_shop_spec`
--
ALTER TABLE `lofter_shop_spec`
  ADD PRIMARY KEY (`shop_spec_id`);

--
-- Indexes for table `lofter_shop_type`
--
ALTER TABLE `lofter_shop_type`
  ADD PRIMARY KEY (`shop_type_id`);

--
-- Indexes for table `lofter_tag`
--
ALTER TABLE `lofter_tag`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `lofter_tag_article`
--
ALTER TABLE `lofter_tag_article`
  ADD PRIMARY KEY (`tag_article_id`);

--
-- Indexes for table `lofter_user`
--
ALTER TABLE `lofter_user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `lofter_article`
--
ALTER TABLE `lofter_article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章ID', AUTO_INCREMENT=51;
--
-- 使用表AUTO_INCREMENT `lofter_comment`
--
ALTER TABLE `lofter_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评论ID', AUTO_INCREMENT=38;
--
-- 使用表AUTO_INCREMENT `lofter_concern`
--
ALTER TABLE `lofter_concern`
  MODIFY `concern_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- 使用表AUTO_INCREMENT `lofter_hot`
--
ALTER TABLE `lofter_hot`
  MODIFY `hot_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `lofter_shop`
--
ALTER TABLE `lofter_shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `lofter_shopcar`
--
ALTER TABLE `lofter_shopcar`
  MODIFY `shopcar_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `lofter_shop_attr`
--
ALTER TABLE `lofter_shop_attr`
  MODIFY `shop_attr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `lofter_shop_detail`
--
ALTER TABLE `lofter_shop_detail`
  MODIFY `shop_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `lofter_shop_history`
--
ALTER TABLE `lofter_shop_history`
  MODIFY `shop_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `lofter_shop_spec`
--
ALTER TABLE `lofter_shop_spec`
  MODIFY `shop_spec_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `lofter_shop_type`
--
ALTER TABLE `lofter_shop_type`
  MODIFY `shop_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品类型id';
--
-- 使用表AUTO_INCREMENT `lofter_tag`
--
ALTER TABLE `lofter_tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '标签ID', AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `lofter_tag_article`
--
ALTER TABLE `lofter_tag_article`
  MODIFY `tag_article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- 使用表AUTO_INCREMENT `lofter_user`
--
ALTER TABLE `lofter_user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
