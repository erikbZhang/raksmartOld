/*
Navicat MySQL Data Transfer

Source Server         : 本地-loan
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : waibao

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2020-06-09 11:05:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for h_area
-- ----------------------------
DROP TABLE IF EXISTS `h_area`;
CREATE TABLE `h_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `area_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_code` int(10) unsigned DEFAULT '0',
  `status` int(2) DEFAULT '1' COMMENT '1正常 -1删除',
  `type` int(2) DEFAULT '1' COMMENT '1裸机云 2大带宽服务器',
  `update_time` int(11) DEFAULT NULL,
  `site` int(2) DEFAULT '1' COMMENT '版本 1中文 2英文',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='服务器 区域管理';

-- ----------------------------
-- Records of h_area
-- ----------------------------
INSERT INTO `h_area` VALUES ('1', '美国服务器', '1', '1', '1', '1586240232', '1');
INSERT INTO `h_area` VALUES ('2', '香港服务器', '11', '1', '1', '1586240559', '1');
INSERT INTO `h_area` VALUES ('3', '新加坡服务器', '2', '1', '1', '1586240577', '1');
INSERT INTO `h_area` VALUES ('4', '韩国服务器', '4', '1', '1', '1586240587', '1');
INSERT INTO `h_area` VALUES ('5', '日本', '2', '1', '2', '1586241358', '1');
INSERT INTO `h_area` VALUES ('6', '中国', '1', '1', '2', '1586418928', '1');
INSERT INTO `h_area` VALUES ('7', 'meiguo1', '1', '1', '1', '1591321808', '2');
INSERT INTO `h_area` VALUES ('8', '1112', '111', '1', '2', '1591321897', '2');

-- ----------------------------
-- Table structure for h_article
-- ----------------------------
DROP TABLE IF EXISTS `h_article`;
CREATE TABLE `h_article` (
  `a_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `c_id` int(11) DEFAULT NULL,
  `a_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文章标题',
  `a_con` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_introduction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文章简介',
  `a_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '主图',
  `a_imgs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '组图',
  `a_content` text COLLATE utf8_unicode_ci COMMENT '内容',
  `a_addtime` int(11) DEFAULT NULL,
  `a_updatetime` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '-1删除 1正常',
  `a_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '文章来源',
  `a_type` int(1) DEFAULT '0' COMMENT '1官方公告 2行业新闻 0全部',
  `site` int(2) DEFAULT '1' COMMENT '1中 2英',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='文章表';

-- ----------------------------
-- Records of h_article
-- ----------------------------
INSERT INTO `h_article` VALUES ('1', '11', '两瓶饮料', '两瓶饮料', '两瓶饮料', '20200409\\ad3a3b0fd3270e206983fa7b82457944.png', '', '<div><div><p>父亲常年在外地打工，有一次，父亲回家，特意给儿子带了礼物，是两瓶饮料。儿子迫不及待地拧开瓶盖，咕咚就一大口。</p><p>父亲赶紧问，好喝吗？儿子嘴里还含着饮料，说不出话，只好含含糊糊的点头。父亲开心的笑了，儿子忽然问他，爸，你喝过吗？父亲顿时扬起了眉毛，那当然，我在工地上干活儿干累了，就买它当水喝。儿子再没说什么。<br/></p><p>若干年后，儿子在城里安了家，父亲却查出了癌症。儿子说，爸，你想吃点儿什么尽管说，我给您买去。父亲想了想，说，我只想尝一种饮料，就是那年夏天我从城里给你带回来的那种。儿子有点意外，但没说什么，转身就下楼扛了两箱回来。</p><p>儿子帮父亲拧开瓶盖，父亲接过来，刚喝了一口，忽然就皱起了眉头，用手指着饮料，郑重其事的告诉儿子，你买到假货了。儿子说，不可能，我在熟人店里买的。父亲说，不信你尝尝，这饮料掺水了！</p><p>儿子扑通跪下，眼泪刷的就下来了，爸，矿泉水就是这个味儿啊……</p></div></div><p><br/></p>', '1586402723', '1588144451', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('2', '10', '做人，不要自作多情，生活中真的没有人在乎你', '做人，不要自作多情，生活中真的没有人在乎你', '做人，不要自作多情，生活中真的没有人在乎你', '20200409\\b0008d960892e7e4665e5f7acc0ea2b2.png', '', '<div><div><p>三毛说：“一个朋友很好，两个朋友就多了一点，三个朋友就未免太多了。 知音，能有一个已经很好了，不必太多，如果实在没有，还有自己，好好对待自己，跟自己相处，也是一个朋友…… ”<br/></p><p>也许有一天，你会发现自己一个真心朋友都没有，不是你不善于交际，不是你封闭了自己，而是你在乎别人，其实是自作多情，高估了自己在别人心中的位置。</p><p>其实，我们总以为有人在乎你，但你只是自作多情，想多了。</p><p>我们的微信里，有很多的好友，有的人，微信好友都有一千个以上。但是你打开朋友圈，真的没有几个人在乎你，他们都在发自己喜欢的东西，都在等你去点赞留言，当然，你不点赞，也没有关系，大家本来也就是网络朋友，现实中，不太熟。</p><p>很多时候，我们都在满怀期待一个好的结果，但是坏的结果却成为了注定的 结局。不是你人不够好，不是你的朋友太少，而是你太高看别人了，太自以为是了。你对别人好一点，是理所当然的，如果你指望得到回报，往往会失望。</p><p>人穷了，亲戚朋友都看不起你；人在倒霉的时候，求谁都没有用。</p><p>“穷在闹市无人问，富在深山有远亲”，一个人穷的时候，别人就会躲着你，感觉“很穷”是一种瘟疫，会传染别人，会导致别人一起受穷。最担心你借钱，借钱之后，还还不起。</p><p>人生起起伏伏，每个人都有倒霉的时候。可是你倒霉了，踩你一脚的人还是有几个，扶你一把的人，可能一个都没有。当你哭泣的时候，不是看到彩虹，而是看到了眼泪，除了眼泪，别无所有。<br/></p><p>常常和你在一起的人，也许是“共事”而已，并不会在乎你。</p><p>很多朋友，之所以和你交往，其实是需要你帮助他们，你也需要借助他们的力量，是一种互相利用的关系。如果你没有能力了，没有利用价值了，他们就会疏远你。</p><p>如果你真的工作很累了，想要发牢骚，不如找一个没有人角落里，吼几句，或者哭一阵子。别指望有人安慰你，别指望同事会帮助你。很多同事，都希望把自己的工作推给你，把自己的错误嫁祸给你，帮忙的同事，太少了。<br/></p><p>还有一个很现实的问题，如果单位有人事变动的机会，被提拔的人，往往不是能力最强的，而是和上司走得最近的人，或者有亲戚关系的人。你埋头苦干，以为自己的成绩会被认可，到头来，做得多，错得多；做得好，工作越来越多。你就好好干一辈子吧，真的不必指望谁在乎你的成绩。</p><p>在群体之中，你以为自己的主角，很多人都会听你的，结果你只是配角。</p><p>同学聚会的时候，你主动和同学联系，还努力回忆青春的时光，结果落座的时候，大家都在“论资排辈”，有钱的一桌子，有势力的 一桌子，结婚了的一桌子，离婚了的一桌子，穷人一桌子。你应该坐在哪一桌？你自己看着办。</p><p>同学情，从大家走出校门的那一刻开始，就慢慢变淡了，越来越多的同学，被社会的不良风气感染了。真正值得交往的同学，很少了。你在同学群里讲话，回复你的人，不是没有，而是回复的话，往往是嘲笑的话，还有阴阳怪气的话，让你很不是滋味。</p><p>同学群，不再如初美好，亲戚朋友群，也不见得就会好很多。如果你不是有钱有势的人，那么就沉默一点吧，别发声，否则你就是打扰了别人，令人讨厌。</p><p>做人，不要自作多情，生活中真的没有人在乎你。从今往后，学会取悦自己，做好自己，只要问心无愧，别人在乎你，不在乎你，都没有关系。</p></div></div>', '1586403143', '1588144443', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('3', '15', '挪威的森林', '挪威的森林', '挪威的森林', '20200409\\f0e8d340be93e62fc1bd239e4c02c6ed.png', '[{\"file\":\"20200409\\\\50f1a652f4be0f3601f59910d5bd2930.png\",\"listorder\":\"0\"},{\"file\":\"20200409\\\\89513b35e3838cb7eace42d66e63a201.png\",\"listorder\":\"0\"}]', '<h2>书中故事</h2><p>小说主人翁叫“渡边君”，故事围绕他的中学生活到大学生活的描写，重点写他青春里的感情生活，又或者说爱情吧。其他的主人翁分别有中学时的朋友：木月、直子（女），大学认识的朋友：绿子（女）、永泽、室友“敢死队（记不起叫啥了）”、初美（永泽女友），包括直子疗养院的室友：玲子（女）。</p><p>以心相交的好友木月中学时自杀了。渡边一下子失去了能谈心的伙伴，后面选择离家很远没有人认识的地方读大学，也想重新开始自己的人生。本来单调乏味的大学生活他一直无感的持续着，在地铁上再次遇到好友木月的女朋友直子，让渡边的生活发生了大的变化，并在种种纠结中同直子自然而然的睡了，可心理又总觉得愧疚于木月。</p><p>同直子甜蜜的大学生活还未能怎么样，她就突然消失了，令渡边十分忐忑迷茫，一下子也不知所错了。</p><p>故事中的渡边是一个十分笃定坦诚又真实的人，有自己思考，绝不是个人云亦云的家伙。他的内心波澜不惊，仿佛对什么都不感兴趣，也不好奇，一切按自己的节奏生活着，其他人的高低贵贱完全无视，他是那么的纯真。</p><p>因为一本《了不起的盖茨比》认识了身为富家子弟的同学永泽。这位富二代心气十分高，一副看透世事一般，大多数人在他眼里全是阿谀奉承的废材，根本就是没有思想只是活着而已。因渡边把《了不起的盖茨比》看了三遍，便认定他配成为自己的朋友。一定程度上他们确实成了好友，那种彼此看透相互认可尊重但却完全不同的朋友。</p><p>看似完全不同的两类人，一般来说是完全没有可能成为朋友的，但他们却一起鬼混泡妞谈天，彼此成为对方的知己。应该说他们俩都是内心孤独的人，也都是十分坚定的人，就好像武侠小说里那些顶尖强者们的心心相惜，但又选择保持距离。</p><p>通过永泽认识了初美，一位华贵高雅的完美“梦中型”女人。第一次见到她，渡边便直言十分喜欢，是心中理想的女友。故事结尾，在得知初美自杀后，断然与永泽绝交了。</p><p>在失去直子联系的日子里，渡边认识了上同一门选修课的同学绿子。后面的故事，直子与绿子两个人都走进了渡边心里，但他们又不是三角恋（青春少年本就该有如此的烦恼，那才叫青春），在渡边搞不懂自己，纠结中发生了很多故事...</p><p>后来给直子老家寄信才联系上了她，去疗养院看望直子又认识了她的病室友玲子，一个大自己十几岁的女人，两次深夜散步中了解了她的故事。</p><p>直子最终病情加重自杀了，渡边因此独自流浪了一个多月，深夜里独自痛哭。</p><p>故事结局，渡边在同看望自己的玲子睡了后，明白了自己的内心，其实早已离不开来绿子了，而绿子也深爱着他，在公用电话亭拨通了绿子电话诉说着，故事结束，留下想象空间给读者。</p><div class=\"image-package\"><div class=\"image-caption\"></div></div><ul class=\" list-paddingleft-2\"><li><p><strong>死并非生的对立面，而作为生的一部分永存。死迟早会将我们俘获在手。但反言之，在死俘获我们之前，我们并未被死俘获。生在此侧，死在彼侧。我在此侧，不在彼侧。</strong></p></li></ul><p>渡边在木月死后，明悟的一段对生死的感受，那年他才17岁。</p><ul class=\" list-paddingleft-2\"><li><p><strong>对死后不足三十年的作家，原则上是不屑一顾的，那种书不足为信。不是我不相信现代文学。我只是不愿意在阅读未经过时间洗礼的书籍上面浪费时间。人生短暂。</strong></p></li></ul><p>渡边与永泽刚认识时，永泽发表自己对文学作品的态度，说的一段经典。这句话在真实世界也很有借鉴意义，但也不能绝对。</p><ul class=\" list-paddingleft-2\"><li><p><strong>哪里会有人喜欢孤独！不过是不乱交朋友罢了。那样只能落得失望。</strong></p></li></ul><p>这段话是绿子刚认识渡边时，问他怎么老是一个人待着，一个人干这干那的，而渡边自嘲回答是喜欢孤独，绿子解读出了他的“喜欢孤独”。</p>', '1586403523', '1588145964', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('4', '3', '独立硬件资源', '123', '独享 CPU 内存 硬盘 网卡等硬件资源，独享服务器性能和带宽防御', '20200409\\3c8502e5e6d08ebd22a4a83d8beb6e84.png', '', '<p>123</p>', '1586416745', '1586416745', '-1', null, '1', '1');
INSERT INTO `h_article` VALUES ('5', '3', '全球网络部署', '123', '出口带宽覆盖全球，T 级带宽保证', '20200409\\29555095e7f0d897c71f8d42fda969b7.png', '', '<p>123</p>', '1586416784', '1586416784', '-1', null, '1', '1');
INSERT INTO `h_article` VALUES ('6', '3', '灵活升级扩展', '12', '根据需求可升级带宽，IP 防御和网络', '20200409\\60c815f50a868068f903e38c369acdc1.png', '', '<p>123</p>', '1586416804', '1586416804', '-1', null, '1', '1');
INSERT INTO `h_article` VALUES ('7', '3', '无忧售后服务', '12', '13年以上的运维服务\r\n7*24小时全年技术支持', '20200409\\ba484788c6a7258b07f0cf6fc6461f0f.png', '', '<p>123</p>', '1586416840', '1586416849', '-1', null, '1', '1');
INSERT INTO `h_article` VALUES ('8', '4', '全球网络部署', '', '10G 100G 宽带裸机全球T级带宽网络保证', '20200409\\87e5cf895b5a5f40575ef7918da90b2c.png', '', '<p>123</p>', '1586418402', '1586418402', '1', null, '1', '1');
INSERT INTO `h_article` VALUES ('9', '4', '定制化服务', '', '与戴尔超微一线供需关系定制硬件，根据需求可升级带宽、IP、网络', '20200409\\550b7fd56216957bb8aa92a4bd89e2ed.png', '', '<p>123</p>', '1586418423', '1586418423', '1', null, '1', '1');
INSERT INTO `h_article` VALUES ('10', '4', 'DDOS 解决方案', '', 'TBPS 级 DDOS 防御解决方案，专业 SOC 工程团队，7*24小时服务', '20200409\\04ef2013c780520abbf00bd41af3cc7f.png', '', '<p>123</p>', '1586418444', '1586418444', '1', null, '1', '1');
INSERT INTO `h_article` VALUES ('11', '4', '完善的后台管理', '', '可视化带宽报告，攻击报告，IPMI 重启重装，KVM 可视化管理', '20200409\\837c1a12e8abe4e1a57958c3df9e459e.png', '', '<p>123</p>', '1586418465', '1586418465', '1', null, '1', '1');
INSERT INTO `h_article` VALUES ('12', '6', '与我们合作！', '', '成为经销商或推介者，您将从 RAKSMART 受益良多，通过我们的经销商计划拓展您的产品与服务，或利用您的人脉优势，为推介计划提供一大助力！', '20200410\\32857470b81b6cbdc92df34ba93d39fa.png', '', '<p><span style=\"font-family: PFR; font-size: 15px;\">成为经销商或推介者，您将从</span><span style=\"font-family: PFR; font-size: 15px;\">RAKSMART&nbsp;</span><span style=\"font-family: PFR; font-size: 15px;\">&nbsp;受益良多，通过我们的经销商计划拓展您的产品与服务，或利用您的人脉优势，为推介计划提供一大助力！</span></p>', '1586498585', '1587978632', '1', '', '1', '1');
INSERT INTO `h_article` VALUES ('13', '14', '新加坡 - GLOBAL SWITCH', '新加坡', '新加坡 - GLOBAL SWITCH', '20200413\\a5c79498097a3ebee37c9565c86b4218.png', '', '<p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>DC说明：</strong>可扩展1T空间，专用建筑设计，运行性能达三级以上</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>UPS系统：</strong>公用供电能力达 25MVA（包括现有能力和计划中能力）。主楼内采用现场 2N 静态 UPS 提供技术（IT）供电，在延长翼上由柴油机转子发动机 UPS 提供 N+1 冗余</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>发电机：</strong>22kV 公用电源和 N+N 冗余、主楼采用备用柴油发电机，为机械系统提供支持，冗余能力达 N+1</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>安全：</strong>运营中心及 24x7x365 的全天候安保巡逻人员。内外部均由闭路电视系统进行监控，闭路电视记录将保存31天，且所有区域均配备完善的入侵者检测和警报系统</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>应急保护：</strong>所有区域均有火灾检测系统，吸气式烟雾检测预警系统（24x7x365全天候监控），可实现</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>DC说明：</strong>可扩展1T空间，专用建筑设计，运行性能达三级以上</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>UPS系统：</strong>公用供电能力达 25MVA（包括现有能力和计划中能力）。主楼内采用现场 2N 静态 UPS 提供技术（IT）供电，在延长翼上由柴油机转子发动机 UPS 提供 N+1 冗余</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>发电机：</strong>22kV 公用电源和 N+N 冗余、主楼采用备用柴油发电机，为机械系统提供支持，冗余能力达 N+1</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>安全：</strong>运营中心及 24x7x365 的全天候安保巡逻人员。内外部均由闭路电视系统进行监控，闭路电视记录将保存31天，且所有区域均配备完善的入侵者检测和警报系统</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>应急保护：</strong>所有区域均有火灾检测系统，吸气式烟雾检测预警系统（24x7x365全天候监控），可实现</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>DC说明：</strong>可扩展1T空间，专用建筑设计，运行性能达三级以上</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>UPS系统：</strong>公用供电能力达 25MVA（包括现有能力和计划中能力）。主楼内采用现场 2N 静态 UPS 提供技术（IT）供电，在延长翼上由柴油机转子发动机 UPS 提供 N+1 冗余</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>发电机：</strong>22kV 公用电源和 N+N 冗余、主楼采用备用柴油发电机，为机械系统提供支持，冗余能力达 N+1</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>安全：</strong>运营中心及 24x7x365 的全天候安保巡逻人员。内外部均由闭路电视系统进行监控，闭路电视记录将保存31天，且所有区域均配备完善的入侵者检测和警报系统</p><p style=\"margin-top: 0px; margin-bottom: 0px; padding-bottom: 8px; font-family: PFR; font-size: 15px; white-space: normal;\"><strong>应急保护：</strong>所有区域均有火灾检测系统，吸气式烟雾检测预警系统（24x7x365全天候监控），可实现</p><p><br/></p>', '1586740690', '1588144137', '1', 'http://www.baidu.com', '0', '1');
INSERT INTO `h_article` VALUES ('14', '13', '中国的啊', '中国', '123', '20200413\\2504b480483728b9cad4cb250980a9c1.png', '', '<p>1231231231</p>', '1586740734', '1588144129', '1', 'http://www.baidu.com', '0', '1');
INSERT INTO `h_article` VALUES ('15', '12', '韩国--GLOBAL SWITCH', '韩国', '阿斯顿', '20200413\\3c8082759ba6bd463e4f359a7e9c7306.png', '', '<p>啊实打实的</p>', '1586740781', '1588144118', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('16', '7', '空缺职位', '吉隆坡 | 全职', '吉隆坡 | 全职', '20200415\\0f3faeeee7d574c502783911591d5c31.png', '', '<p><span style=\"font-family: PFR; font-size: 15px; background-color: rgb(255, 255, 255);\">详细介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍详细介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍详细介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍详细介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍详细介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍详细介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍详细介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍详细介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍详细介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍详细介绍介绍介绍介绍介绍介绍介绍介绍介绍</span></p>', '1586933379', '1586933469', '1', 'http://www.baidu.com', '1', '1');
INSERT INTO `h_article` VALUES ('17', '11', '疫情当前，求职者该何去何从，下一个春天在哪里？', '小知识', '疫情当前，求职者该何去何从，下一个春天在哪里？', '', '', '<div><div>不久就到了一年一度的金三银四的求职季了，相信不少小伙伴之前都是有计划和打算离职跳槽，甚至不少人在年前就已经离职等待这一波的求职季（真挚的祝福眼光）。但是受到突如其来的疫情影响，别说求职了，就是现在会不会被迫下岗都说不定，太多网上例子冲击着我们，从3号到10号再到17后，最后到倒闭。如果说2019互联网的热词是“裁员”的话，那2020“倒闭”将首当其冲。</div></div>', '1586934753', '1588144471', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('18', '10', '2020人生新的起点', '新闻动态', '2020人生新的起点', '', '', '<div><div><p>不知不觉，人生已经过了30年。。。回首上一个10年，努力学习考入名牌大学，毕业后进入国企，不甘心在一个三线城市过一辈子毅然去深圳，后来又到了杭州。。。虽然过程曲折离奇，但大体上还是一个普通人的人生轨迹，当然在生活、感情、事业、工作和资产积累上也没什么明显的进步，或许这个过程唯一值得欣慰的事情就是年年上涨的收入的了吧。。。回想起来最大的遗憾就是没有记录过去生活中的美好瞬间，以至于有光阴似箭的错觉。。。这并不是我期待的人生！一直以来我的理想是成为一个有影响力的人，希望未来能给自己，给身边的人或者说给这个世界留下一些只言片语，证明自己曾经来过，如果顺带能帮助一些有相同困惑的人，那就再好不过了。</p></div></div>', '1586941086', '1588144465', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('19', '8', 'IDC 服务协议', 'IDC 服务协议', 'IDC 服务协议', '', '', '<p><span style=\"font-family: PFR; font-size: 15px; text-indent: 30px; background-color: rgb(255, 255, 255);\">SSD L512，512M内存，20G SSD，1IP，共享G口/不限流量；原价：¥326.10 /年，惊爆价：¥163.05 /年 ,SSD W512，512M内存，20G SSD，1IP，共享G口/不限流量；原价：¥326.10 /年，惊爆价：¥163.05 / 年SSD L1536，1536M内存，60G SSD，1IP，共享G口/不限流量；原价：¥642.30 /年，惊爆价：¥321.15 /年 SSD W1536，1536M内存，60G SSD，1IP，共享G口/不限流量；原价：¥642。30年，惊爆价：¥321.15 /年 CN2 L512，512M内存，20G SSD，1IP，精品网15M /不限流量；原价：¥500.00 /年，惊爆价：¥249.00 /年 CN2 W512，512M内存，20G SSD，1IP，精品网15M /不限流量；原价：¥500.00 /年，惊爆价：¥249.00 /年 CN2 L1536，1536M内存，60G SSD，1IP，精品网15M /不限流量；原价：¥1000.00 /年，惊，1IP，精品网15M /不限流量；SSD L512，512M内存，20G SSD，1IP，共享G口/不限流量；原价：¥326.10 /年，惊爆价：¥163.05 /年 ,SSD W512，512M内存，20G SSD，1IP，共享G口/不限流量；原价：¥326.10 /年，惊爆价：¥163.05 / 年SSD L1536，1536M内存，60G SSD，1IP，共享G口/不限流量；原价：¥642.30 /年，惊爆价：¥321.15 /年 SSD W1536，1536M内存，60G SSD，1IP，共享G口/不限流量；原价：¥642。30年，惊爆价：¥321.15 /年 CN2 L512，512M内存，20G SSD，1IP，精品网15M /不限流量；原价：¥500.00 /年，惊爆价：¥249.00 /年 CN2 W512，512M内存，20G SSD，1IP，精品网15M /不限流量；原价：¥500.00 /年，惊爆价：¥249.00 /年 CN2 L1536，1536M内存，60G SSD，1IP，精品网15M /不限流量；原价：¥1000.00 /年，惊，1IP，精品网15M /不限流量；原价SSD L512，512M内存，20G SSD，1IP，共享G口/不限流量；原价：¥326.10 /年，惊爆价：¥163.05 /年 ,SSD W512，512M内存，20G SSD，1IP，共享G口/不限流量；原价：¥326.10 /年，惊爆价：¥163.05 / 年SSD L1536，1536M内存，60G SSD，1IP，共享G口/不限流量；原价：¥642.30 /年，惊爆价：¥321.15 /年 SSD W1536，1536M内存，60G SSD，1IP，共享G口/不限流量；原价：¥642。30年，惊爆价：¥321.15 /年 CN2 L512，512M内存，20G SSD，1IP，精品网15M /不限流量；原价：¥500.00 /年，惊爆价：¥249.00 /年 CN2 W512，512M内存，20G SSD，1IP，精品网15M /不限流量；原价：¥500.00 /年，惊爆价：¥249.00 /年 CN2 L1536，1536M内存，60G SSD，1IP，精品网15M /不限流量；原价：¥1000.00 /年，惊，1IP，精品网15M /不限流量；原价2222</span></p>', '1586998777', '1586998777', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('20', '8', '那朵紫苑花', '那朵紫苑花', '那朵紫苑花', '', '', '<div><div><p>世界上的事，谁能说清楚，就像我爱你，从前、现在、未来，都是。</p><p>可我是用了多大的勇气，成为大人，却仍愿意这样一步一步的靠近你，尽管每一步都迎着无尽的风雪，可如果风雪的尽头是你，我又怎么劝说自己放弃……</p><p>“你叫什么？”男孩的眼睛像一汪清澈透明的湖水，光影在水波中摇晃。</p><p>“李书逸。”稚嫩的声音，奶声奶气的，却一本正经地回答道。</p><p>“我叫……”少年低下头望着她，轻轻地说。</p><p>“快点，我们快点走了……”一个精致的女人有些焦急地呼唤打断。</p><p>阳光从稀松的树叶下投下斑斑的阴影，小男孩回头逆着光芒，笑容灿烂，手中的纯白银莲花熠熠生辉，却越来越模糊。</p><p>男孩低下身子，把手中纯洁柔嫩的花朵，轻轻放进女孩的手中，温温的笑。</p><p>“听到了吗？我叫……记住了吗……”</p></div></div><p><br/></p>', '1586998942', '1587001522', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('21', '8', '《人物》', '', '', '', '', '<p><span style=\"color: rgb(51, 51, 51); font-family: Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">在《人物》的时候我们设有一个专门的“女性”版，我跟同事们说，一篇简单的“女性”版的报道，就是去楼下卖米粉的店里跟女服务员聊天，一直倾听，直到了解所有她有的而同龄同阶级的男性没有的那些困难。</span><br/><br/><span style=\"color: rgb(51, 51, 51); font-family: Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">说到底，这是因为好的媒体的工作核心就是“困难”，“困难”就是新闻。所以我始终理解为什么有时我还是会被有些女性骂是男权，因为我的确不是从女性角度来理解女权的，我只是从“困难”角度来理解。也许我有一种“还想让我怎么样呢”的懒惰心理。</span><br/><br/><span style=\"color: rgb(51, 51, 51); font-family: Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">很多年过去了，如今的情况大抵如此：我们的时代没有人跟上优秀女性的脚步，甚至优秀的媒体；我们的时代也没有人跟优秀媒体同路，甚至优秀的女性。</span><br/><br/><span style=\"color: rgb(51, 51, 51); font-family: Arial, &quot;PingFang SC&quot;, &quot;Hiragino Sans GB&quot;, &quot;Microsoft YaHei&quot;, &quot;WenQuanYi Micro Hei&quot;, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);\">还是那么困难</span></p>', '1586998992', '1586998992', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('22', '9', '现在就向我提交简历吧！', '123', '123', '20200416\\9635ebbd8eb77c7c1bfbd2683b3373f0.png', '', '<p>加入我们，锦绣前程就在眼前。发送您的简历，我们将很乐意与您进一步沟通。</p><p>如果您对某个职位感兴趣，您可以随时申请下列空缺位置。</p>', '1587020284', '1587980557', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('23', '7', '123', '123', '123', '', '', '<p>123123</p>', '1588040717', '1588040717', '1', 'http://www.baidu.com', '0', '1');
INSERT INTO `h_article` VALUES ('24', '7', '网络工程师', '网络工程师', '网络工程师', '', '', '<p>网络工程师<br/></p>', '1588777830', '1588777830', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('25', '7', '系统工程师', '系统工程师', '系统工程师', '', '', '<p>系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师系统工程师</p>', '1588777862', '1588777883', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('26', '8', 'SLA标准', 'SLA标准', 'SLA标准', '', '', '<p>SLA标准SLA标准SLA标准SLA标准SLA标准SLA标准SLA标准SLA标准</p>', '1588778017', '1588778017', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('27', '17', '网络调整', '网络调整', '网络调整', '', '', '<p>网络调整网络调整网络调整网络调整</p>', '1588778141', '1588778141', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('28', '18', 'linux 发展', 'linux 发展', 'linux 发展', '', '', '<p>linux 发展linux 发展linux 发展linux 发展</p>', '1588778239', '1588778239', '1', '', '0', '1');
INSERT INTO `h_article` VALUES ('29', '21', 'xinwen', '123', '123', '', '', '<p>123</p>', '1591324606', '1591324669', '1', '', '0', '2');
INSERT INTO `h_article` VALUES ('30', '23', '123', '123', '123', '', '', '<p>123123</p>', '1591326435', '1591326435', '1', '', '0', '2');
INSERT INTO `h_article` VALUES ('31', '24', 'Partner With RAKsmart', '123', '123', '20200605\\c6887232afbd43d5c834110573b6d835.jpeg', '', '<p>123123</p>', '1591327883', '1591327940', '1', '', '0', '2');
INSERT INTO `h_article` VALUES ('32', '21', '12', '12', '12', '', '', '<p>12</p>', '1591328954', '1591328954', '1', '', '0', '2');
INSERT INTO `h_article` VALUES ('33', '25', '123', '123', '123', '', '', '<p>123</p>', '1591329022', '1591329022', '1', '', '0', '2');
INSERT INTO `h_article` VALUES ('34', '26', '123', '123', '123', '', '', '<p>123123</p>', '1591329241', '1591329241', '1', '', '0', '2');
INSERT INTO `h_article` VALUES ('35', '28', '123', '123', '123', '', '', '<p>123</p>', '1591329938', '1591329938', '1', '', '0', '2');
INSERT INTO `h_article` VALUES ('36', '27', '22', '22', '22', '', '', '<p>22</p>', '1591338059', '1591338059', '1', '', '0', '2');

-- ----------------------------
-- Table structure for h_article_class
-- ----------------------------
DROP TABLE IF EXISTS `h_article_class`;
CREATE TABLE `h_article_class` (
  `c_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '分类名称',
  `addtime` int(11) unsigned NOT NULL COMMENT '添加时间',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '-1删除',
  `update_time` int(11) DEFAULT NULL,
  `listorder` int(10) DEFAULT '0',
  `pid` int(10) DEFAULT '0',
  `site` int(2) DEFAULT '1' COMMENT '版本 1中文 2英文',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='文章分类管理';

-- ----------------------------
-- Records of h_article_class
-- ----------------------------
INSERT INTO `h_article_class` VALUES ('1', '新闻动态', '1586401282', '1', '1586402628', '1', '0', '1');
INSERT INTO `h_article_class` VALUES ('2', '知识库', '1586403178', '1', '1586403178', '2', '0', '1');
INSERT INTO `h_article_class` VALUES ('3', '为什么选择裸机云', '1586415806', '1', '1586415806', '3', '0', '1');
INSERT INTO `h_article_class` VALUES ('4', '大带宽服务器的优势', '1586418369', '1', '1586418535', '4', '0', '1');
INSERT INTO `h_article_class` VALUES ('5', '数据中心设施', '1586491240', '1', '1586491240', '5', '0', '1');
INSERT INTO `h_article_class` VALUES ('6', '与我们合作！', '1586498528', '1', '1586498528', '1', '0', '1');
INSERT INTO `h_article_class` VALUES ('7', '空缺职位', '1586933279', '1', '1586933279', '1', '0', '1');
INSERT INTO `h_article_class` VALUES ('8', '服务协议', '1586998746', '1', '1586998746', '6', '0', '1');
INSERT INTO `h_article_class` VALUES ('9', '加入我们', '1587020232', '1', '1587020232', '7', '0', '1');
INSERT INTO `h_article_class` VALUES ('10', '活动发布', '1588140445', '1', '1588140527', '1', '1', '1');
INSERT INTO `h_article_class` VALUES ('11', '产品更新', '1588140489', '1', '1588140489', '1', '1', '1');
INSERT INTO `h_article_class` VALUES ('12', '新加坡', '1588140551', '1', '1588140551', '0', '5', '1');
INSERT INTO `h_article_class` VALUES ('13', '中国', '1588140560', '1', '1588140560', '0', '5', '1');
INSERT INTO `h_article_class` VALUES ('14', '韩国', '1588140567', '1', '1588140636', '0', '5', '1');
INSERT INTO `h_article_class` VALUES ('15', '新手指南', '1588145938', '1', '1588145938', '1', '2', '1');
INSERT INTO `h_article_class` VALUES ('16', '视频教程', '1588145952', '1', '1588145952', '1', '2', '1');
INSERT INTO `h_article_class` VALUES ('17', '服务公告', '1588778117', '1', '1588778117', '1', '1', '1');
INSERT INTO `h_article_class` VALUES ('18', '教程文档', '1588778204', '1', '1588778204', '1', '2', '1');
INSERT INTO `h_article_class` VALUES ('19', 'New', '1591324539', '1', '1591324539', '1', '0', '2');
INSERT INTO `h_article_class` VALUES ('20', 'Knowledge', '1591324566', '1', '1591324566', '2', '0', '2');
INSERT INTO `h_article_class` VALUES ('21', 'fuwugonggao', '1591324659', '1', '1591324659', '1', '19', '2');
INSERT INTO `h_article_class` VALUES ('22', '数据中心设施english', '1591326367', '1', '1591326367', '1', '0', '2');
INSERT INTO `h_article_class` VALUES ('23', 'china', '1591326380', '1', '1591326380', '1', '22', '2');
INSERT INTO `h_article_class` VALUES ('24', 'Partner With RAKsmart', '1591327865', '1', '1591327949', '1', '0', '2');
INSERT INTO `h_article_class` VALUES ('25', '11', '1591328943', '1', '1591328943', '11', '20', '2');
INSERT INTO `h_article_class` VALUES ('26', '空缺职位（english）', '1591329226', '1', '1591329226', '1', '0', '2');
INSERT INTO `h_article_class` VALUES ('27', '加入我们（english）', '1591329226', '1', '1591329226', '1', '0', '2');
INSERT INTO `h_article_class` VALUES ('28', '服务协议（english）', '1591329921', '1', '1591329921', '1', '0', '2');

-- ----------------------------
-- Table structure for h_banner
-- ----------------------------
DROP TABLE IF EXISTS `h_banner`;
CREATE TABLE `h_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` char(32) NOT NULL COMMENT 'id',
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `con` varchar(255) DEFAULT NULL COMMENT '简介',
  `img_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'PC地址',
  `img_url2` varchar(255) NOT NULL COMMENT '手机端轮播图片地址',
  `point_url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片指向的地址',
  `order_list` int(2) NOT NULL DEFAULT '100' COMMENT '图片顺序',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1--启用 0--禁用 -1删除',
  `banner_type` int(1) NOT NULL DEFAULT '0' COMMENT '类型 1--首页',
  `site` int(2) DEFAULT '1' COMMENT '版本 1中文 2英文',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='banner表 通过banner_type 区分板块';

-- ----------------------------
-- Records of h_banner
-- ----------------------------
INSERT INTO `h_banner` VALUES ('1', 'c305a97932f47f15096a3815fc36adee', '共享', '1231', '20200403\\f2a8277decdd10336ccd10f8a27ee719.jpg', '', 'http://content.hc1014.com/apicontent/car_short/car_pos_share.html', '100', '1586395747', '-1', '1', '1');
INSERT INTO `h_banner` VALUES ('2', '8e2397da1d938191827b00ecbcfdb421', 'banner图', null, '20200403\\f2a8277decdd10336ccd10f8a27ee719.jpg', '', 'http://content.hc1014.com/apicontent/description/introduce.html', '100', '1487245362', '-1', '2', '1');
INSERT INTO `h_banner` VALUES ('3', 'a4d993b2d56beda5c5b4d8d6140cdc1b', '123', null, '20200403\\f2a8277decdd10336ccd10f8a27ee719.jpg', '', 'http://www.baidu.com', '12', '1585907213', '-1', '1', '1');
INSERT INTO `h_banner` VALUES ('4', '384287f7870745914d8fd651a766ee92', '456', '', '20200420/a620d261f7a462bf6f8c7cb6c910927a.jpg', '20200420/460d5c2f667a2dcc2082dbcbb8690730.jpeg', '456', '456', '1587375157', '0', '1', '1');
INSERT INTO `h_banner` VALUES ('5', '639799bfce61115feee595b843c70f11', '裸机云', '提供强大的云+网络连接智能管理', '20200526/366a1b49e3b0d85f650ed2e3e2a3d784.png', '20200526/db85ccd00a2e705624dfa4444bfa59d3.png', '123', '2', '1590460911', '1', '1', '1');
INSERT INTO `h_banner` VALUES ('6', '8c584a3cc148d19fa3c167c5e5c3ca3f', '服务器托管', '一站式全球化服务', '20200526/0ec6d6a879090769196caf50b44f1f34.png', '20200526/8720b5061f2a402a91f813f2bc6a410e.png', 'http://www.baidu.com', '1', '1590460948', '1', '1', '1');
INSERT INTO `h_banner` VALUES ('7', '23d533cd8b5d4110c98176b63cfd2f6f', '裸机云', '快速部署全球业务', '20200409\\6032322023395763006394a5f98e7e1e.png', '20200409\\fc00f1dd4e5e981d5b25861a0c6adafa.png', 'http://www.baidu.com', '2', '1587375081', '1', '2', '1');
INSERT INTO `h_banner` VALUES ('8', '42f5a5a7752caba724677a21885528d9', '大带宽服务器', '全球大带宽提供者', '20200409\\5b79fac1a5fbac254496713b988c2bd3.png', '20200409\\4c3113e0cbdcbbbd1279f8f5913bef02.png', 'http://www.baidu.com', '2', '1586418760', '1', '3', '1');
INSERT INTO `h_banner` VALUES ('9', '1f4c57e5ca55a118bce0e1896b6538f4', '服务器定制', '灵活 快捷 打造您的专属服务器', '20200409\\7c7b97b24e06bd78e21012cc8605ab2a.png', '20200409\\be8e7adf0e68bea5f88689c627f273ff.png', 'http://www.baidu.com', '1', '1586419675', '1', '4', '1');
INSERT INTO `h_banner` VALUES ('10', '67c178be5848996b8ab1b05364fc98e7', '混合云互联', '混合云互联提供了高效、灵活的主流公有云、私有云到 I 数据中心之间的云互联服务', '20200409\\f52a39f0d42885fbe546ec1f8db85f18.png', '20200409\\30d0259bcbe078376c14fc69b1447d2e.png', 'http://www.baidu.com', '1', '1586427720', '1', '5', '1');
INSERT INTO `h_banner` VALUES ('11', 'f59c49b0fda7907fd32928082e8d015f', '私有云', '快速、稳定、安全的云计算产品', '20200410\\4667b864ee48e0963dd88a02475b8774.png', '20200410\\53e1fe8fdaffe2bbd92480cfb12f918c.png', 'http://www.baidu.com', '1', '1586480832', '1', '6', '1');
INSERT INTO `h_banner` VALUES ('12', 'b6a073307d3bf4325c202d55feb638ef', 'zstack', 'zstack', '20200410\\415668dcb46b11fdf7d1916e94415274.png', '20200410\\2f61046d85a1e491f5a0806e9205fea8.png', 'http://www.baidu.com', '0', '1586480940', '1', '7', '1');
INSERT INTO `h_banner` VALUES ('13', 'bd07cd8a82aaf5df6bfbbeb7319bbfd8', 'fusionsphere', 'fusionsphere', '20200410\\f2e002135ce8b3ce298fea0b59619432.png', '20200410\\271412e2b01ceb4a9df189593a73b944.png', 'http://www.baidu.com', '0', '1586480930', '1', '7', '1');
INSERT INTO `h_banner` VALUES ('14', 'b1d822e4e5ad1803950b442c53edeb39', 'vmware', 'vmware', '20200410\\52d5aba6e8e43bd612b04c1b8d1acf9f.png', '20200410\\0892b4d681e4e9cd44e8823b6eae1828.png', 'http://www.baidu.com', '0', '1586480965', '1', '7', '1');
INSERT INTO `h_banner` VALUES ('15', '3e6d88e562d04ff0f2681176053a6473', 'openstack', 'openstack', '20200410\\04b25b79cd5789ee3829d29d9fd47031.png', '20200410\\32d280bf5bf25841462def5b277ea69b.png', '', '0', '1586480988', '1', '7', '1');
INSERT INTO `h_banner` VALUES ('16', 'ffdf21a5038fbde4fc7f3266d65a6ad9', 'DDOS 防护服务', '1 Tbps + DDOS 防护解决方案', '20200410\\07b4d9acbc8888ab885a2a24b6ee19db.png', '20200410\\c25cba473acfe8f1ed506aea4df95791.png', 'http://www.baidu.com', '0', '1586481850', '1', '8', '1');
INSERT INTO `h_banner` VALUES ('17', '6fd25b6bbde5c015e544098f4b773317', 'IP传输服务', '圣何塞，波特兰，洛杉矶，日本，香港，新加坡，韩国', '20200410\\de8206f444b8b243edb841cc635c1384.png', '20200410\\4f721f6e3cd9fdd66eea33a9ceef3b07.png', 'http://www.baidu.com', '0', '1586482409', '1', '9', '1');
INSERT INTO `h_banner` VALUES ('18', '9b6654fd28826a938c473e7179f05fce', '全球网络', '稳定、可靠、快速的全球 BGP 网络', '20200410\\865155b113cc7d853b2d46fa4d93ff0d.png', '20200410\\8bfd7d985105686332b16e92afb17901.png', 'http://www.baidu.com', '0', '1586483487', '1', '10', '1');
INSERT INTO `h_banner` VALUES ('19', 'b7ce3f49ad3d6924ab1b968415bf4a7d', '一站式服务', '一站式服务', '20200410\\aa12f62192f011b7e1c2b55eff0f7562.png', '20200410\\f135adde5e5a34b016d34cb82faf7412.png', 'http://www.baidu.com', '0', '1588867740', '1', '11', '1');
INSERT INTO `h_banner` VALUES ('20', '24b27100c35d3334d190afc093a963c7', '什么是 SD-WAN?', 'SD-WAN是软件定义管理广域网的一种方式。它提供了：分支机构、ISP、IDC、公有云、私有云、混合云之间的动态连接', '20200410\\fd34d5455b884d9638136e9ff03d9f86.png', '20200410\\b6eb309012d046640cbf9c62b414a92b.png', 'http://www.baidu.com', '0', '1588867748', '1', '12', '1');
INSERT INTO `h_banner` VALUES ('21', '969a3d207b37b41c21d6fbcd0485adfb', '代理商 合作伙伴', '网络、服务你值得信赖', '20200410\\45d6336646edbb33e25504be2b2b7d1b.png', '20200410\\4126e108f5ce854c46265389ff82d4dd.png', 'http://www.baidu.com', '0', '1588867756', '1', '13', '1');
INSERT INTO `h_banner` VALUES ('22', 'fba6ecab1dff518947cd3d15e7aea3b6', '公有云', '快速、稳定、安全的公有云产品', '20200410\\162f59ab6feeb5f47550da842d977a2d.png', '20200410\\1b1315f4ae2d2779867220a3aba56ec4.png', 'http://www.baidu.com', '0', '1588867851', '1', '14', '1');
INSERT INTO `h_banner` VALUES ('23', 'e0d70945adbd66a055d8a592eadd621f', '数据中心遍布全球，一站式托管服务', '圣何塞、波特兰、洛杉矶、日本、香港、新加坡、韩国', '20200413\\4a354030f7844006cdf8b8ca3573a3e8.png', '20200413\\95d28d924320c868658b22919fb4a7e8.png', 'http://www.baidu.com', '0', '1588867843', '1', '15', '1');
INSERT INTO `h_banner` VALUES ('24', '084d2966fa087fd96a9ff0eb10ffaf0a', 'Network Peering', '', '20200415\\b09eb641859291e15cc34a7f18d66f62.png', '20200415\\30521b89bc617c5cf3ad7c5c713187cd.png', 'http://www.baidu.com', '0', '1588867836', '1', '16', '1');
INSERT INTO `h_banner` VALUES ('25', '510de563b9c182fd1f2f9596b3dedbcc', '加入推荐 推广全球服务器 佣金高达15%!', '激活推荐 赚取佣金', '20200415\\148be53712f4ce03b6212eaf749e6671.png', '20200415\\1a0fbe68aa5eedc053313665f33442b3.png', 'http://www.baidu.com', '0', '1588867820', '1', '17', '1');
INSERT INTO `h_banner` VALUES ('26', 'c8cfa51482c3000d6b7fc4e66e288f2a', '关于 RAKSMART', '', '20200415\\aabb0fbe77a659e04fa6523d0b08a5fb.png', '20200415\\b23d2488089477b8fafd4fe209266898.png', 'http://www.baidu.com', '0', '1588867828', '1', '18', '1');
INSERT INTO `h_banner` VALUES ('27', 'e3647406be6db02045c18d382e44e295', '联系我们', '', '20200415\\b73cbcb3c96efc0e647ef677f9bf8781.png', '20200415\\b2ed918380de33df2890938d83cf3f47.png', 'http://www.baidu.com', '0', '1588867814', '1', '19', '1');
INSERT INTO `h_banner` VALUES ('28', '62fe9ba7b66c7a5273e521b5ac8683b0', '加入 RAKSMART', '', '20200415\\c9f6c3c8e5b8e87396a6828575e563e0.png', '20200415\\a2d6ee3cdcbf8e9df52c4c6fe9be62cd.png', 'http://www.baidu.com', '0', '1588867807', '1', '20', '1');
INSERT INTO `h_banner` VALUES ('29', '22ebcc2b5f6908a29c56ebab59cfbac5', '新闻中心', '新闻中心', '20200415\\a69cb03b74750b9cd957dd18aa7caebd.png', '20200415\\88c35edec4bd055fa85b79bd533e1e5c.png', 'http://www.baidu.com', '0', '1588867792', '1', '21', '1');
INSERT INTO `h_banner` VALUES ('30', 'f85c19a76aeaad0106ef91b0074d7a44', '知识库', '知识库', '20200415\\209593b0982ebbd64a9c50c51043e22b.png', '20200415\\515ef91610dfc0db81a2e8c353bae90a.png', 'http://www.baidu.com', '0', '1588867798', '1', '22', '1');
INSERT INTO `h_banner` VALUES ('31', 'ae4f8aef8f3620c93abbec1eb45858df', '服务协议', '', '20200416\\1c81c854d446b794552e6074d5223fc0.png', '20200416\\e2fc6c65851e00436dc6187ec1010e8b.png', 'http://www.baidu.com', '0', '1588867785', '1', '23', '1');
INSERT INTO `h_banner` VALUES ('32', 'e7336df6ac8fa6d7174f960c2dff52f0', 'SD-WAN', '提供强大的云+网络连接智能管理', '20200526/3ef51e3fdcc701b7fb306fb2c7b1362c.png', '20200526/d76849d0b1f3c3eebf77c36ff4c1d051.png', 'http://www.baidu.com', '3', '1590460968', '1', '1', '1');
INSERT INTO `h_banner` VALUES ('33', '3eeb4fe4ce8a3b5c8ed5a7cb780c4bad', '云集成服务', '公有云、私有云、裸机云多云互联', '20200517/9a902e6c7c841e1045778d1f5b70b191.png', '20200517/0dfc9b407a5fe8bb8de459d9081c0b6f.png', 'http://www.baidu.com', '4', '1589719261', '1', '1', '1');
INSERT INTO `h_banner` VALUES ('34', 'cad9829dff381d98e456e1e75a646e89', 'DDoS 防御解决方案', '1Tbps+DDos防御解决方案', '20200506/6605b5aa615cef6d70886435640b693c.png', '20200517/97ae29b8de7933e5408091b506a3ba25.png', 'http://www.baidu.com', '5', '1589719348', '1', '1', '1');
INSERT INTO `h_banner` VALUES ('35', '7079521a86bdc573a36b444fab26f234', 'english111', 'english jajahd', '20200605\\54ca97d12c9a8389050dffd413a26bd0.jpg', '20200605\\69506abfe3e187af31f4975bf314b4a7.jpeg', 'http://www.baidu.com', '123', '1591320721', '1', '1', '2');
INSERT INTO `h_banner` VALUES ('36', '2817f130abeea7f6dedbb14d2769b545', '1', '1', '20200605\\c1d7871236b67cc58dffb982fa5554c4.jpeg', '20200605\\57fccc3bb298fab503f466893c90bed5.jpeg', '1', '1', '1591325099', '1', '2', '2');

-- ----------------------------
-- Table structure for h_config
-- ----------------------------
DROP TABLE IF EXISTS `h_config`;
CREATE TABLE `h_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of h_config
-- ----------------------------
INSERT INTO `h_config` VALUES ('1', '关于我们-订购链接', 'http://www.baidu.com', '1');
INSERT INTO `h_config` VALUES ('2', '销售-美国电话', '(657) 206-5036', '1');
INSERT INTO `h_config` VALUES ('3', '销售-中国电话', '(657) 206-5036', '1');
INSERT INTO `h_config` VALUES ('4', '销售-邮箱', 'sales@raksmart.com', '1');
INSERT INTO `h_config` VALUES ('5', '技术支持-美国', '(657) 206-5036', '1');
INSERT INTO `h_config` VALUES ('6', '技术支持-国际', '(657) 206-5036', '1');
INSERT INTO `h_config` VALUES ('7', '技术支持-中国', '(657) 206-5036', '1');
INSERT INTO `h_config` VALUES ('8', '技术支持-邮箱', 'support@raksmart.com ', '1');
INSERT INTO `h_config` VALUES ('9', '关于我们-订购链接', 'http://www.baidu.com', '2');
INSERT INTO `h_config` VALUES ('10', '销售-美国电话', '(657) 206-5036', '2');
INSERT INTO `h_config` VALUES ('11', '销售-中国电话', '(657) 206-5036', '2');
INSERT INTO `h_config` VALUES ('12', '销售-邮箱', 'sales@raksmart.com', '2');
INSERT INTO `h_config` VALUES ('13', '技术支持-美国', '(657) 206-5036', '2');
INSERT INTO `h_config` VALUES ('14', '技术支持-国际', '(657) 206-5036', '2');
INSERT INTO `h_config` VALUES ('15', '技术支持-中国', '(657) 206-5036', '2');
INSERT INTO `h_config` VALUES ('16', '技术支持-邮箱', 'support@raksmart.com ', '2');

-- ----------------------------
-- Table structure for h_configuration
-- ----------------------------
DROP TABLE IF EXISTS `h_configuration`;
CREATE TABLE `h_configuration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '类型 SSD VPS/Cn2 SSD VPS/HK VPS',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '产品名称',
  `cpu` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'cpu',
  `nc` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '内存',
  `yp` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '硬盘',
  `dk` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '带宽',
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ip',
  `money` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '价格（美金）',
  `system` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '操作系统',
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '订购url',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `status` int(1) DEFAULT '1' COMMENT '1 -1删除',
  `site` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of h_configuration
-- ----------------------------
INSERT INTO `h_configuration` VALUES ('1', '1', 'W5121', '1', '1024M', '256G', '100M', '1', '100', 'Windows', 'http://www.baidu.com', '1586504931', '1', '1');
INSERT INTO `h_configuration` VALUES ('2', '1', '123', '1', '512M', '128G', '100M', '1', '123', 'Windows', '', '1586507234', '1', '1');
INSERT INTO `h_configuration` VALUES ('3', '1', '111', '1', '512M', '128G', '100M', '1', '1233', 'Windows', '', '1586507253', '1', '1');
INSERT INTO `h_configuration` VALUES ('4', '2', '3333', '2', '512M', '256G', '100M', '1', '101', 'Linux', '', '1586507273', '1', '1');
INSERT INTO `h_configuration` VALUES ('5', '1', '222', '2', '1024M', '256G', '100M', '1', '222', 'Linux', '', '1586507293', '1', '1');
INSERT INTO `h_configuration` VALUES ('6', '3', '123', '1', '512M', '128G', '100M', '1', '123', 'Windows', '', '1588043472', '1', '1');
INSERT INTO `h_configuration` VALUES ('7', '4', '22', '2', '2', '2', '2', '2', '2', 'Windows', 'http://www.baidu.com', '1591322347', '1', '2');

-- ----------------------------
-- Table structure for h_configuration_type
-- ----------------------------
DROP TABLE IF EXISTS `h_configuration_type`;
CREATE TABLE `h_configuration_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '-1删除 1正常',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of h_configuration_type
-- ----------------------------
INSERT INTO `h_configuration_type` VALUES ('1', 'SSD VPS', '1', '1');
INSERT INTO `h_configuration_type` VALUES ('2', 'Cn2 SSD VPS', '1', '1');
INSERT INTO `h_configuration_type` VALUES ('3', '111', '1', '1');
INSERT INTO `h_configuration_type` VALUES ('4', '22', '1', '2');

-- ----------------------------
-- Table structure for h_dictionaries
-- ----------------------------
DROP TABLE IF EXISTS `h_dictionaries`;
CREATE TABLE `h_dictionaries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '-1删除 1 正常',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='字典管理---定制服务器';

-- ----------------------------
-- Records of h_dictionaries
-- ----------------------------
INSERT INTO `h_dictionaries` VALUES ('1', '中国', '1', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('2', '美国', '1', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('3', '1', '2', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('4', '2', '2', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('5', '3', '2', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('6', '512M', '3', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('7', '1024M', '3', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('8', '2048M', '3', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('9', '128G', '4', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('10', '256G', '4', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('11', '1T', '4', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('12', '1', '5', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('13', '共享G口', '6', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('14', '100M', '7', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('15', '200M', '7', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('16', '300M', '7', '1', '1');
INSERT INTO `h_dictionaries` VALUES ('17', '111', '1', '1', '2');

-- ----------------------------
-- Table structure for h_ding
-- ----------------------------
DROP TABLE IF EXISTS `h_ding`;
CREATE TABLE `h_ding` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `d_country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '国家',
  `d_cpu` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'cpu',
  `d_nc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '内存',
  `d_yp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '硬盘',
  `d_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ip',
  `d_wl` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '网络',
  `d_kd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '宽带/流量',
  `d_other` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '其他需求',
  `d_tell` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系电话',
  `d_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '邮箱',
  `d_qq` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'qq',
  `d_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '联系人姓名',
  `d_skype` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '提交ip地址',
  `addtime` int(11) unsigned DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1 -1',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='定制服务器 ';

-- ----------------------------
-- Records of h_ding
-- ----------------------------
INSERT INTO `h_ding` VALUES ('1', '美国', '123', '123', '1231', '123', '123', '123', '123', '18712933521', '123@qq.com', '272948575', '张晓', '123', null, '1504055914', '1', '1');
INSERT INTO `h_ding` VALUES ('2', '美国', '1 CPU', '1024M', '256G', '1 IP', '共享G口', '100M', '', '123', '123', '123', '123', '123', '127.0.0.1', '1586424832', '1', '1');
INSERT INTO `h_ding` VALUES ('3', '美国', '1 CPU', '1024M', '256G', '1 IP', '共享G口', '100M', '', '123', '123', '123', '123', '123', '127.0.0.1', '1586424933', '1', '1');
INSERT INTO `h_ding` VALUES ('4', '', '', '', '', '', '', '', '', '', '', '', '', '', '127.0.0.1', '1586425240', '-1', '1');
INSERT INTO `h_ding` VALUES ('5', '美国', '2 CPU', '1024M', '256G', '1 IP', '共享G口', '200M', '123123', '18712933521', '1223@qq.com', '242521524', '田会方', '1125', '127.0.0.1', '1586429117', '1', '1');
INSERT INTO `h_ding` VALUES ('6', '美国', '2', '2048M', '256G', '1 IP', '共享G口', '100M', '123', '123', '123', '123', '123', '123', '127.0.0.1', '1591326068', '1', '1');

-- ----------------------------
-- Table structure for h_fuwu
-- ----------------------------
DROP TABLE IF EXISTS `h_fuwu`;
CREATE TABLE `h_fuwu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(100) NOT NULL COMMENT '类型',
  `name` varchar(122) COLLATE utf8_unicode_ci NOT NULL COMMENT '产品名称',
  `unumber` int(10) DEFAULT NULL COMMENT 'U数',
  `dian` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '电量',
  `pdu` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'PDU',
  `kou` varchar(122) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '接口',
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ip',
  `money` decimal(10,2) DEFAULT NULL COMMENT '价格',
  `go` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去订购链接',
  `status` int(11) DEFAULT '1' COMMENT '-1删除 1正常',
  `addtime` int(11) unsigned DEFAULT NULL,
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='服务器托管 --产品';

-- ----------------------------
-- Records of h_fuwu
-- ----------------------------
INSERT INTO `h_fuwu` VALUES ('1', '1', '2', '22', '2', '2', '2', '2', '2.00', '2', '1', '1588054474', '1');
INSERT INTO `h_fuwu` VALUES ('2', '3', '213', '123', '123', '123', '123', '123', '123.00', '123', '1', '1588055110', '1');
INSERT INTO `h_fuwu` VALUES ('3', '5', '12', '2', '2', '2', '2', '2', '2.00', '2', '1', '1591322468', '2');

-- ----------------------------
-- Table structure for h_fuwu_type
-- ----------------------------
DROP TABLE IF EXISTS `h_fuwu_type`;
CREATE TABLE `h_fuwu_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '-1删除 1正常',
  `site` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COMMENT='服务器托管--产品类型';

-- ----------------------------
-- Records of h_fuwu_type
-- ----------------------------
INSERT INTO `h_fuwu_type` VALUES ('1', 'SSD VPS', '1', '1');
INSERT INTO `h_fuwu_type` VALUES ('2', 'Cn2 SSD VPS', '-1', '1');
INSERT INTO `h_fuwu_type` VALUES ('3', '2222', '1', '1');
INSERT INTO `h_fuwu_type` VALUES ('4', '444', '1', '1');
INSERT INTO `h_fuwu_type` VALUES ('5', '123', '1', '2');

-- ----------------------------
-- Table structure for h_member
-- ----------------------------
DROP TABLE IF EXISTS `h_member`;
CREATE TABLE `h_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_account` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '账号',
  `m_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '手机号',
  `status` int(2) DEFAULT NULL COMMENT '-1删除 1正常 0禁用',
  `addtime` int(11) unsigned DEFAULT NULL,
  `site` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of h_member
-- ----------------------------
INSERT INTO `h_member` VALUES ('1', '40691d476cfa3563cc0e0dceb6bb3197', '22', 'e10adc3949ba59abbe56e057f20f', 'tianhuifang2', '18712933522', '1', '1586766120', '1');
INSERT INTO `h_member` VALUES ('2', '5557b31bf6ffdab0f5918e86b4c2351e', '123123123', '4297f44b13955235245b2497399d', '123', '15630144444', '1', '1586767693', '1');

-- ----------------------------
-- Table structure for h_menu
-- ----------------------------
DROP TABLE IF EXISTS `h_menu`;
CREATE TABLE `h_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) NOT NULL,
  `menu_url` varchar(255) NOT NULL,
  `parent` int(10) unsigned DEFAULT '0' COMMENT '父级',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `status` int(1) unsigned DEFAULT '1' COMMENT '1正常 -1删除',
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='菜单表';

-- ----------------------------
-- Records of h_menu
-- ----------------------------
INSERT INTO `h_menu` VALUES ('1', '系统设置', '', '0', '1', '1', '7');
INSERT INTO `h_menu` VALUES ('2', '菜单设置', '/admin/menu/index', '1', '2', '1', '2');
INSERT INTO `h_menu` VALUES ('3', '账号管理', '', '0', '1', '1', '5');
INSERT INTO `h_menu` VALUES ('4', '角色管理', '/admin/role/index', '3', '2', '1', '1');
INSERT INTO `h_menu` VALUES ('5', '账号管理', '/admin/user/index', '3', '2', '1', '2');
INSERT INTO `h_menu` VALUES ('6', '档案', '', '0', '1', '1', '3');
INSERT INTO `h_menu` VALUES ('7', '档案管理', '/admin/community/index', '6', '2', '1', '0');
INSERT INTO `h_menu` VALUES ('8', '概况', '', '0', '1', '1', '1');
INSERT INTO `h_menu` VALUES ('9', '控制台', '/admin/index/home', '8', '2', '1', '1');
INSERT INTO `h_menu` VALUES ('10', '物业公司', '/admin/company/index', '6', '2', '1', '0');

-- ----------------------------
-- Table structure for h_message
-- ----------------------------
DROP TABLE IF EXISTS `h_message`;
CREATE TABLE `h_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '姓名',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
  `tell` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '电话',
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '类型',
  `content` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '内容',
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addtime` int(11) unsigned NOT NULL COMMENT '留言时间',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='留言';

-- ----------------------------
-- Records of h_message
-- ----------------------------
INSERT INTO `h_message` VALUES ('2', '小王', '3123@qq.com', '18712933521', '$0~$1000', '123', '127.0.0.1', '123', '1');
INSERT INTO `h_message` VALUES ('3', '123', '123', '123', '$100 - $200', '123', '127.0.0.1', '1586428838', '1');
INSERT INTO `h_message` VALUES ('4', '123', '123', '123', '$100 - $200', '123', '127.0.0.1', '1586480762', '1');
INSERT INTO `h_message` VALUES ('5', '111', '111', '111', '$0 - $100', '111', '127.0.0.1', '1591579482', '1');
INSERT INTO `h_message` VALUES ('6', '33', '33', '33', '$100 - $200', '3333', '127.0.0.1', '1591579894', '1');
INSERT INTO `h_message` VALUES ('7', '123', '123', '123', '$0 - $100', '123', '127.0.0.1', '1591579931', '2');

-- ----------------------------
-- Table structure for h_network
-- ----------------------------
DROP TABLE IF EXISTS `h_network`;
CREATE TABLE `h_network` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `w_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '网络名称',
  `w_operator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '网络运营商分布',
  `w_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '测试ip',
  `w_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '下载测试地址',
  `addtime` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1 -1',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='全球网络测试';

-- ----------------------------
-- Records of h_network
-- ----------------------------
INSERT INTO `h_network` VALUES ('1', '圣何塞精品网', '1,3,4', '127.0.0.1', 'http://www.baidu.com', null, '1', '1');
INSERT INTO `h_network` VALUES ('2', '123精品网', '1,4', '152.0.21.11', 'http://www.baidu.com', '1586316066', '1', '1');
INSERT INTO `h_network` VALUES ('3', '圣333塞精品网', '2,6', '125.002.12.0', 'http://www.baidu.com', '1586317360', '1', '1');
INSERT INTO `h_network` VALUES ('4', '1', '1,2,4', '1', 'http://www.baidu.com', '1591581607', '1', '2');

-- ----------------------------
-- Table structure for h_partner
-- ----------------------------
DROP TABLE IF EXISTS `h_partner`;
CREATE TABLE `h_partner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文章标题',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '文章简介',
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '主图',
  `listorder` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `addtime` int(11) unsigned DEFAULT '0',
  `updatetime` int(11) unsigned DEFAULT '0',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='合作伙伴';

-- ----------------------------
-- Records of h_partner
-- ----------------------------
INSERT INTO `h_partner` VALUES ('3', '中国电信', 'http://www.chinatelecom.com.cn/', '20200410\\a9e58e9973f1e4ecb6942ec70c7d2918.png', '123', '1586413937', '1588148941', '1');
INSERT INTO `h_partner` VALUES ('4', '中国联通', 'http://www.chinaunicom.com.cn/', '20200410\\487e0c54ab637cccb32d8b976bd89eeb.png', '2', '1586425794', '1588148940', '1');
INSERT INTO `h_partner` VALUES ('5', '中国移动', 'http://www.10086.cn', '20200410\\6ebca80ab3c063e880aa202484781701.png', '3', '1586479485', '1588148940', '1');
INSERT INTO `h_partner` VALUES ('6', '中国电信', 'http://www.chinatelecom.com.cn/', '20200410\\a9e58e9973f1e4ecb6942ec70c7d2918.png', '1', '1586479485', '1586479485', '2');

-- ----------------------------
-- Table structure for h_position
-- ----------------------------
DROP TABLE IF EXISTS `h_position`;
CREATE TABLE `h_position` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `staus` int(1) DEFAULT '1' COMMENT '-1删除',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of h_position
-- ----------------------------
INSERT INTO `h_position` VALUES ('1', '网络工程师', '123', '兼职', '吉隆坡', '123', null, '1', '1');

-- ----------------------------
-- Table structure for h_product
-- ----------------------------
DROP TABLE IF EXISTS `h_product`;
CREATE TABLE `h_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `p_area` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '地区',
  `type` int(1) DEFAULT '1' COMMENT '1裸机云 2大宽带服务器',
  `p_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '产品名称',
  `p_nc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '内存',
  `p_yp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '硬盘',
  `p_kd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '宽带',
  `p_ll` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '流量',
  `p_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ip',
  `p_money` decimal(10,2) DEFAULT NULL COMMENT 'j金额',
  `p_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去订购',
  `addtime` int(11) DEFAULT NULL COMMENT '时间',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `status` int(1) DEFAULT '1' COMMENT '1正常 -1删除',
  `ddos` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='产品';

-- ----------------------------
-- Records of h_product
-- ----------------------------
INSERT INTO `h_product` VALUES ('1', '2', '1', '13-2122 seever', '123', '123', '123', '123', '123', '123.00', 'http://www.baidu.com', '1586243907', '123', '1', null, '1');
INSERT INTO `h_product` VALUES ('2', '3', '1', '13-52541', '12G', '1T', '123', '123', '11', '3000.00', 'http://www.baidu.com', '1587976785', '12', '1', '111', '1');
INSERT INTO `h_product` VALUES ('3', '5', '2', '11', '11', '11', '11', '11', '11', '11.00', 'http://www.baidu.com', '1586246210', '11', '1', null, '1');
INSERT INTO `h_product` VALUES ('4', '1', '1', '123', '123', '123', '123', '123', '123', '123.00', 'http://www.baidu.com', '1586413907', '123', '1', null, '1');
INSERT INTO `h_product` VALUES ('5', '1', '1', '456', '456', '456', '456', '456', '456', '456.00', 'http://www.baidu.com', '1586413932', '456', '1', null, '1');
INSERT INTO `h_product` VALUES ('6', '2', '1', '123123', '123', '123', '123', '123', '123', '123.00', 'http://www.baidu.com', '1586415530', '123', '1', null, '1');
INSERT INTO `h_product` VALUES ('7', '6', '2', '额鹅鹅鹅', '12', '12', '12', '100M', '127.0.0.1', '100.00', 'http://www.baidu.com', '1587019871', '0', '1', null, '1');
INSERT INTO `h_product` VALUES ('8', '7', '1', '12', '12', '2', '12', '1', '21', '12.00', '1', '1591321844', '12', '1', '1', '2');
INSERT INTO `h_product` VALUES ('9', '8', '2', '12311111113', '123', '1', '123', '1', '111', '1.00', '1', '1591581092', '123', '1', '1', '2');
INSERT INTO `h_product` VALUES ('10', '8', '2', '123', '123', '123', '123', '123', '123', '123.00', 'http://www.baidu.com', '1591581086', '0', '1', '', '2');

-- ----------------------------
-- Table structure for h_reseller
-- ----------------------------
DROP TABLE IF EXISTS `h_reseller`;
CREATE TABLE `h_reseller` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `r_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1银牌 2金牌 3 白金 4钻石',
  `r_money` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '消费金额',
  `r_zhe` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '折扣',
  `r_resource` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '资源',
  `r_zc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '技术支持',
  `r_server` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '重装服务器',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='代理商折扣制度';

-- ----------------------------
-- Records of h_reseller
-- ----------------------------
INSERT INTO `h_reseller` VALUES ('1', '银牌', '$500-$5000', '10', '标准', '标准', '免费', '1');
INSERT INTO `h_reseller` VALUES ('2', '金牌', '$5000-$10000', '15', '标准', '标准', '免费', '1');
INSERT INTO `h_reseller` VALUES ('3', '白金', '$10000-$20000', '20', '优先', '优先', '免费', '1');
INSERT INTO `h_reseller` VALUES ('4', '钻石', '仅限邀请', '', '优先', '优先', '免费', '1');
INSERT INTO `h_reseller` VALUES ('5', 'jinpai11', '$500-$5000', '10', 'baiozhun', 'baiozhun', 'mainfei', '2');
INSERT INTO `h_reseller` VALUES ('6', '银牌222', '21', '12', '12', '12', '21', '2');

-- ----------------------------
-- Table structure for h_role
-- ----------------------------
DROP TABLE IF EXISTS `h_role`;
CREATE TABLE `h_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(40) DEFAULT '' COMMENT '角色名称',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1正常 -1删除',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='角色表';

-- ----------------------------
-- Records of h_role
-- ----------------------------
INSERT INTO `h_role` VALUES ('1', '超级管理员', '2', '1', '1');
INSERT INTO `h_role` VALUES ('2', '产品部', '产品', '1', '1');
INSERT INTO `h_role` VALUES ('3', '工程部', '', '1', '1');

-- ----------------------------
-- Table structure for h_role_privilege
-- ----------------------------
DROP TABLE IF EXISTS `h_role_privilege`;
CREATE TABLE `h_role_privilege` (
  `role_id` char(34) NOT NULL DEFAULT '' COMMENT '角色id',
  `menu_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '菜单id',
  `site` int(2) DEFAULT '1',
  KEY `role_id` (`role_id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='角色-权限表';

-- ----------------------------
-- Records of h_role_privilege
-- ----------------------------
INSERT INTO `h_role_privilege` VALUES ('1', '1', '1');
INSERT INTO `h_role_privilege` VALUES ('1', '5', '1');
INSERT INTO `h_role_privilege` VALUES ('1', '4', '1');
INSERT INTO `h_role_privilege` VALUES ('1', '3', '1');
INSERT INTO `h_role_privilege` VALUES ('1', '10', '1');
INSERT INTO `h_role_privilege` VALUES ('1', '7', '1');
INSERT INTO `h_role_privilege` VALUES ('1', '6', '1');
INSERT INTO `h_role_privilege` VALUES ('1', '9', '1');
INSERT INTO `h_role_privilege` VALUES ('1', '8', '1');
INSERT INTO `h_role_privilege` VALUES ('1', '2', '1');

-- ----------------------------
-- Table structure for h_user
-- ----------------------------
DROP TABLE IF EXISTS `h_user`;
CREATE TABLE `h_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` char(32) NOT NULL DEFAULT '',
  `account` varchar(40) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `user_name` varchar(40) NOT NULL DEFAULT '' COMMENT '姓名',
  `phone` char(11) NOT NULL,
  `role_id` char(32) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态 1正常 -1删除 0禁用',
  `site` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户表';

-- ----------------------------
-- Records of h_user
-- ----------------------------
INSERT INTO `h_user` VALUES ('1', 'f47fd3fa84b08c96b94', 'admin', 'e10adc3949ba59abbe56e057f20f', '123', '15227111111', '1', '1', '1');
INSERT INTO `h_user` VALUES ('2', 'f47fd3fa84b08c96b9413658f876892b', '2', '4297f44b13955235245b2497399d', 'xiaofangzhuce1', '18712933520', '2', '-1', '1');
INSERT INTO `h_user` VALUES ('3', '0692b84eb5ada8a5b407afffbc86fbcb', 'ceshi', 'e10adc3949ba59abbe56e057f20f', 'xiaofangzhuce', '18712933521', '2', '0', '1');
INSERT INTO `h_user` VALUES ('4', '48b9cbd2b99d4bcbaef4c64e6d70cb0b', 'ceshi1', 'e10adc3949ba59abbe56e057f20f', '1123', '18712933521', '2', '-1', '1');
INSERT INTO `h_user` VALUES ('5', '4401ae83a602aec143895a6ccda5d109', 'xiaofang', 'e10adc3949ba59abbe56e057f20f', '田会方', '18712933521', null, '1', '1');

-- ----------------------------
-- View structure for view_role_privilege
-- ----------------------------
DROP VIEW IF EXISTS `view_role_privilege`;
CREATE ALGORITHM=UNDEFINED DEFINER=`waibao`@`%` SQL SECURITY DEFINER VIEW `view_role_privilege` AS select `waibao`.`h_menu`.`id` AS `menu_id`,`waibao`.`h_menu`.`menu_name` AS `menu_name`,`waibao`.`h_menu`.`menu_url` AS `menu_url`,`waibao`.`h_menu`.`parent` AS `parent`,`waibao`.`h_menu`.`level` AS `level`,`waibao`.`h_menu`.`listorder` AS `listorder`,`waibao`.`h_role_privilege`.`role_id` AS `role_id` from (`h_role_privilege` join `h_menu` on(((`waibao`.`h_role_privilege`.`menu_id` = `waibao`.`h_menu`.`id`) and (`waibao`.`h_menu`.`status` = 1)))) ;
