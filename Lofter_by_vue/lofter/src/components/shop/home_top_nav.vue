<template class="topNav-view">
	<div class="topNav">
		<ul>
			<li class="li-left">
				<router-link to="" @click.native="$router.go(-1)" class="link-class"><span class="icon-chevron-left"></span></router-link>
			</li>
			<li class="title">
				<span class="stitle">{{title}}</span>
			</li>
		</ul>
	</div>
</template>
<script>
export default {
  props: ['title']
}
</script>
<style lang="scss">
@import '../../assets/common.scss';

/* 顶部导航栏样式 */
.topNav{
	width: 100%;
	position: fixed;
	top: 0;
	z-index: 999;
	font-size: .35rem;
	background-color: $topic_color;
	ul {
		text-align: center;
		width: 100%;
		li {
			// width: 23%;
			padding: .15rem 0 .1rem;
			display: inline-block;
			text-align: center;
			.link-class {
				color: #fff;
				p {
					font-size: .3rem;
				}
			}
		}
		.li-left {
			float: left;
			padding-left: .2rem;
		}
		.title {
			.stitle {
				color: #fff;
			}
		}
		li:focus {
			background-color: $topic_hcolor;
		}
	}
}


</style>
