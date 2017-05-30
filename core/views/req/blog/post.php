<div id="_post_item" v-cloak>
	<div class="_back">
		<a href="<?php $ms->get_basepath() ?>/blog">&laquo; Назад</a>
	</div>
	<div class="_post_title">
		<h1 v-cloak>{{post.title}}</h1>
	</div>
	<div class="_post_top">
		<span class="_date" v-cloak>
			{{post.date}}
		</span>
		<span class="category" v-cloak>
			{{post.categoryId}}
		</span>
	</div>
	<div v-cloak class="_post_content" v-html="post.content">
	</div>
	<div class="_post_views" v-cloak>
		<i class="fa fa-eye"></i> Переглянуло : {{post.views}}
	</div>
</div>

<script>
	
	let post = new Vue({

		el: "#_post_item",

		data: {

			postId: "<?php echo $postId; ?>",

			post: {},

			phpPath: ["<?php $ms->get_basepath() ?>/core/listeners/blog/get_post.php", "<?php $ms->get_basepath() ?>/core/listeners/blog/set_views.php"]

		},

		methods: {

			getPost(id) {

					this.$http.post(this.phpPath[0], {id: id}, {emulateJSON: true})
					.then(res => {
						this.post = res.body

						console.log(this.post)
					}, error => console.error(error))

					this.$http.post(this.phpPath[1], {id: id}, {emulateJSON: true})
					.then(res => {
						this.post.views = parseInt(this.post.views) + 1; 	
					}, error => console.error(error))

			}

		},

		mounted() {

			this.getPost(this.postId)

		}

	})

</script>

<style>
	#_post_item {
		margin: 20px 0;
	}

	._post_title {

		padding: 15px 20px;

		text-align: left;

		border-bottom: 2px dashed #000;
		background-color: #fff;

	}

	._post_top {

		background-color: rgba(0,255,0,.3);
		padding: 4px;

		font-size: 14px;
	}

	._date {
		color: rgba(0,0,0,.9);
	}

	._post_views {

		background-color: rgba(0,255,0,.3);
		padding: 4px;

	}

	._post_content {

		padding: 20px 15px;

		font-size: 17px;

		background-color: #fff;
	}


</style>