<div class="__blog_controller" id="__blog_ctrl">
	
	<h2>Керування блогом</h2>
	<hr>
	<p>
		В цьому модулі Ви можете створити новини для блогу, получити список всіх новин та маніпулювати ними. Видалити або просто редагувати. Все, що забажаєте.
	</p>
	<hr>
	<h3>Створити категорію</h3>
	<hr>
	<p>
		Створіть категорію для Ваших новин, аби людям було легше знайти потрібно їм новину! Що таке категорія? Наприклад: нам потрібно відгородити всі новини від новин, які стосуються батьків. Ми створюємо категорію "Батьки" та потім додаємо ту, чи іншу новину в цю категорію.
	</p>
	<hr>
	<form v-on:submit.prevent="addCategory" class='dx-form'>
		<div>
			<input type="text" v-model="category.name" placeholder="Назва категорії" required minlength="2">
			<small>Цю назву категорії будуть бачити користувачі.</small>
		</div>
		<div>
			<button class="btn btn-primary" type='submit'>Створити категорію</button>
		</div>
	</form>
	<hr>
	<h3>
		Створити новину
	</h3>
	<hr>
	<p>
		В цьому блоці Ви маєте можливість створити новину, яка одразу потрапить до блогу. Всього надайте їй назву, категорію та саму новину й вже, після натискання на кнопку "Додати", новина потрапить в місце призначення. <button v-on:click="toggle" class='btn btn-success'>Створити новину</button>
	</p>
	<div class="dx-modal" v-show="isModal">
				<button class="dx-close" @click="toggle">&times;</button>
				<div class="dx-block">
					<form class='dx-form' v-on:submit.prevent="addPost">
					<h3>
						Створити нову сторінку
					</h3>
					<hr>
						<button class="dx-close" type='button' @click="toggle">&times;</button>
						<div>
							<input type="text" v-model="newPost.title" required placeholder="Заголовок">
							<small> Назва новини, яку будуть бачити користувачі.</small>
						</div>
						<div>
							<textarea id="addNewPost" name="addNewPost"></textarea>
						</div>
						<div>
							<select v-model="newPost.category">
								<option value="">Без категорії</option>
								<option v-for="cat in clist" :value="cat.id">
									{{cat.name}}
								</option>
							</select>
						</div>
						<div>
							<button type='submit' class='btn btn-primary'>Створити</button>
						</div>
					</form>
				</div>
			</div>
	<hr>
	<h3>
		Список новин
	</h3>
	<hr>
	<p>
		Аби отримати список новин, достатньо натиснути кнопку "Отримати список новин", й Ви одразу побачите всі новини, які доступні на сайті.
	</p>

	<table class='category__table'>
		
		<thead>
			<tr>
				<th>Заголовок сайту</th>
				<th>Дії</th>
				<th v-if="posts.length < 1">
					
				</th>
				<th>Продивилися</th>
				<th>Дата створення</th>
			</tr>
		</thead>
		<tbody>
			<tr v-if="posts.length < 1">
				<td></td>
				<td></td>
				<td><button class="btn btn-success" v-on:click="getPosts">Отримати список новин</button></td>
				<td></td>
				<td></td>
			</tr>
			<tr v-else v-for="post in posts">
				<td><a v-bind:href="basepath + 'post/' + post.id">{{post.title}}</a></td>
				<td><button class='__delete' @click="removePost(post.id)">
					&times;
				</button></td>
				<td>{{post.views}}</td>
				<td>{{post.date}}</td>
			</tr>
		</tbody>

	</table>

</div>

<script>
	
	let bl = new Vue({

		el: "#__blog_ctrl",

		data: {
			page_controller: "<?php $ms->get_basepath() ?>/core/listeners/blog/",
			posts: [],
			basepath: new String("<?php $ms->get_basepath() ?>/"),
			isModal: false,

			newPost: {
				title: '',
				category: ''
			},

			category: {},

			clist: [],

			opt : {emulateJSON: true}
		},

		methods: {

			removePost(id) {

				let c = confirm("Ви дійсно бажаєте видалити новину?")

				if(c) {

				this.$http.post(this.page_controller + "post_controller.php",
					{id: id,
						req: "remove_post"},
						this.opt)
					.then(res => {
						alert("Новина видалена")
						this.getPosts()
					}, error => console.error(error))

				}

			},

			getPosts() {

				this.$http.get(this.page_controller  +  "controller.php")
					.then(res => {
						this.posts = res.body
					}, err => console.error(err))

			},
			toggle() {
				this.isModal = !this.isModal;
			},

			correctDate(d) {
				let l = d < 10 ? "0" + d.toString() : d;

				return l ;
			},

			addCategory() {
				// create_category

				MS.loading("Категорія " + this.category.name + " створюється")

				this.$http.post(this.page_controller + "post_controller.php", {
					name: this.category.name,
					req: "create_category"
				}, this.opt).then(res => {
						console.log(res.body)
						MS.removeLoading("Створення категорії закінчилося")

					if(res.body == "1" || res.body == 1) {
						let cl = this.getCategories();

						this.clist = cl;
					}

				}, err => console.error(err))


			},

			addPost() {

				MS.loading("Обробка інформації для створення новини")

				let content = CKEDITOR.instances['addNewPost'].getData();

				let d = this.correctDate(new Date().getDate());
				let m = this.correctDate(parseInt(new Date().getMonth()) + 1);
				let y = new Date().getFullYear();
				let h = this.correctDate(new Date().getHours());
				let ms = this.correctDate(new Date().getMinutes());

				let date = `${h}:${ms} ${d}/${m}/${y}`;

				let sendObject = {
					content: content,
					title: this.newPost.title,
					category: this.newPost.category,
					date:date,
					req: "create_post"
				}

				this.$http.post(this.page_controller + "post_controller.php", sendObject, this.opt)
					.then(res => {
						if(res.body == "1" || res.body == 1) {

							MS.removeLoading("Новина створена!")

						}
					}, error => console.error(error))

			},
			getCategories() {
				this.$http.get(this.page_controller + "get_cats.php")
					.then(res => {
						this.clist = res.body;
						console.log(this.clist)
					})
				}

		},
		
		mounted() {

			this.clist = this.getCategories();

		}



	})

</script>

<style>
	
	.category__table {
		width: 100%;
		display: table;
		border :1px solid #e7e7e7;
		padding: 10px;
	}

	.category__table tbody tr td:first-child,
	 .category__table thead tr th:first-child{
		padding-left: 10px;
	}

	.category__table td,
	.category__table th {
		padding: 5px 5px;
	}

	.category__table tr {
		border-bottom: 1px solid #e7e7e7;
	}

</style>