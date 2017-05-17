<div id="_blog">
	<h1 class='_blog_header'>
		Блог сайту музичної школи
	</h1>
	<div class="_post" v-for="post in posts">
		
		<h2 class="_post_title">
			<a :href="bpt + '/blog/post/' + post.id">
				{{post.title}}
			</a>
		</h2>
		<section class="_post_shortText" v-html="post.content">
		</section>
		<footer class="_post_shortbar">
			<span class="_views">
				{{post.views}}
			</span>
			<span class="_date">
				{{post.date}}
			</span>
		</footer>

	</div>
</div>


<script>

	
	let _bl = new Vue({

		el: "#_blog",

		data: {
			msg: "Fuck you",
			posts: [],

			bp : "<?php $ms->get_basepath() ?>/core/listeners/blog/get_posts.php",
			bpt: "<?php $ms->get_basepath() ?>"
		},


		methods: {
			getPosts() {

				this.$http.get(this.bp)
					.then(res => {
						this.posts = res.body.posts;

					}, error => console.error(error))

			}
		},

		mounted() {

			this.getPosts()
		}

	})

</script>

<style>
	

	._blog_header {
		text-align: center;
		font-family: "Lobster", cursive;
		color: firebrick;
		padding: 20px 15px;
		border-top: 3px dashed green;
		border-bottom: 3px dashed green;
	}

	._post {

		min-height: 1px;
		padding: 5px;
		margin: 3px 0;

		border-bottom: 3px solid firebrick;	

		border-radius: 3px;
	}

</style>