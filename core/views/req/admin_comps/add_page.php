

<div id="add_page">
	<div id="page_tabs">
		<ul class="page__tabs">
			<li><a href="#add_category">Додати категорію</a></li>
			<li><a href="#add_page_inside">Створити сторінку</a></li>
		</ul>

		<div id="add_category">
			<h2>Додати категорію.</h2>
			<hr>
			<p>Тут Ви можете створити нову категорію для ваших сторінок, або так звану зв'язку. Для чого вона? Якщо Ви бажаєте створити, наприклад, сторінку "Досягнення" та помістити її до категорії "Про школу", то спочатку потрібно створити категорію "Про школу", а вже далі помістити сторінку досягнення в цю категорію.</p>

			<form v-on:submit.prevent="addCategory" class='dx-form'>
				<div>
					<input type="text" placeholder="Назва категорії. Наприклад 'Про школу'" v-model="category.name" required>
				</div>
				<div>
					<input type="text" placeholder="Посилання на категорію. Наприклад 'about_school'" v-model="category.link" required>
				</div>
				<div>
					<button class='submit-button'>
						Створити
					</button>
				</div>
			</form>
			<table class='category__table'>
				
				<thead>
					<tr>
						<th>ID</th>
						<th>Назва</th>
						<th>Посилання</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="cat in categories">
						<td>{{cat.id}}</td><td>{{cat.name}}</td><td>{{cat.link}}</td>
					</tr>
				</tbody>

			</table>
		</div>

		<br>

		<div id="add_page_inside">
			<h2>Створити сторінку.</h2>
			<hr>
			<p>
				Тут Ви можете створити свою сторінку та заповнити її контентом. Вона автоматично створиться у вигляді файлу та з'явиться у Вашому навігаторі по сайту. Якщо буде обрана певна категорія сторінки, наприклад категорія "Про нас", тоді сторінка попаде у розділ "Про нас" під назвою, яку їй дасте при створенні
			</p>
			<hr>
			<button class="btn btn-primary" @click="openModal">Створити сторінку</button>
			<div class="dx-modal" v-if="creatingPage">
				<button class="dx-close" @click="openModal">&times;</button>
				<div class="dx-block">
					<form class='dx-form' v-on:submit.prevent="createPage">
					<h3>
						Створити нову сторінку
					</h3>
					<hr>
						<button class="dx-close" @click="openModal">&times;</button>
						<div>
							<input type="text" v-model="page.name" required placeholder="Назва сторінки">
							<small> Її будуть бачити всі користувачі сайту у навігаторі.</small>
						</div>
						<div>
							<input type="text" v-model="page.link" required placeholder="Посилання на сторінку">
							<small>Посилання по якому буде знаходитись сторінка (/about)</small>
						</div>
						<div>
							<textarea name="page_x2j1" id="page_x2j1" placeholder="Контент вашої сторінки"></textarea>
							<script>
								$("#page_x2j1").froalaEditor()
							</script>
						</div>
						<div>
							<label for="isCategoryFalse">Без категорії</label>
							<input type="radio" id="isCategoryFalse" name='isCategory' v-model="page.isCategory" value="false" @change="changeIsCategory" checked>
							<label for="isCategoryTrue">Оберіть категорію</label>
							<input type="radio" id="isCategoryTrue" name='isCategory' v-model="page.isCategory" value="true" @change="changeIsCategory">
						</div>
						<div>
							<select id="add_page_select" v-model="page.category">
								<option v-for="cat in categories" v-bind:value="cat.link">
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
				<h2>Маніпуляція сторінками</h2>
			<hr>
				<p>
					В цьому розділі Ви можете контролювати сторінки : змінювати дані сторінок, видаляти їх та просто передивитись інформацію про них.
				</p>
				<table class="category__table">
					<thead>
						<tr>
							<th>Заголовок сторінки</th>
							<th>Посилання на сторінку</th>
							<th>Категорія сторінки</th>
						</tr>
					</thead>
					<tbody>
							<tr v-if="pages.length < 1">
								<td></td><td><button @click="getPages" class='btn btn-success'>Отримати список сторінок</button></td><td></td>
							</tr>
							<tr v-else v-for="page in pages">
								<td>{{page.name}} <a v-bind:href="basepath + 'edit/page/' + page.id">Редагувати</a> 
									<button class='__remove' @click="removePage($event, page.id, page.link)">
										&times;
									</button>
								</td>
								<td>{{page.link}}</td>
								<td v-if="page.category">{{page.category}}</td>
								<td v-else>Без категорії</td>
							</tr>
					</tbody>
				</table>
		</div>
	</div>
</div>


	

<script>


	let add_page = new Vue({
		el: "#add_page",

		data: {

			page_controller: "<?php $ms->get_basepath() ?>/core/listeners/page_controller/",

			creatingPage: false,

			categories: [],

			pages: [],

			noPages: false,

			basepath: new String(<?php $ms->get_basepath(); ?>/),

			category: {
				name: "",
				link: ""
			},

			page: {
				name: "",
				link: "",
				content: "",
				isCategory: false,
				category: ""
			},

			options: {
				emulateJSON: true
			}
		}

		,
		methods: {

			removePage(e, id, link) {
				let conf = confirm("Ви дійсно бажаєте видалити сторінку?")
				if(conf) {
					this.$http.post(this.page_controller + "pages/remove_page.php", {
						id: id,
						link: link
					}, this.options)
						.then(
							res => {
							console.log(res)
								if(res.body == true || res.body == 'true' || res.body == '1') {
									MS.notice("Сторінку успішно видаленно.", "виконано", 'succ')
									console.log(e);
								}
								else {
									MS.notice("Щось пішло не так.", "помилка", 'error')
								}
							},
							err => console.error(err)
						)
				}
			},

			changeIsCategory() {
				console.log(this.page.isCategory)
				if(this.page.isCategory == "true") {
					$("#add_page_select").removeAttr('disabled')
				}
				else {
					$("#add_page_select").attr('disabled', true)
				}
			},
			openModal() {

				this.creatingPage = !this.creatingPage;

			},

			createPage() {

				MS.loading("Сторінка створюється. Зачекайте хвилинку.")

				this.$http.post(this.page_controller+"pages/add_page.php", this.page, this.options)
					.then(res => {
						MS.removeLoading("Заклик успішно виконано!");
						console.log(res)
					}, err => console.error(err))

			},

			

			addCategory() {

				this.$http.post(this.page_controller + "categories/add_category.php", {
					name: this.category.name,
					link: this.category.link
				}, {
					emulateJSON: true
				}).then(res => {

					if(res.body == "1" || res.body == 1) {

						this.categories.unshift({name: this.category.name, link: this.category.link, id: "Невідомо"});

					}

				}, err => {
					console.error(err)
				})

			},

			getPages() {
				this.$http.get(this.page_controller + "pages/get_pages.php")
					.then(res => {
						console.log(res.body)
						this.pages = res.body;
						if(this.pages.length < 1) {
							this.noPages = true;
						}
						else {
							this.noPages = false;
						}
					}, err => console.error(err))
			}

		},

		mounted() {

			this.$http.get(this.page_controller + "categories/get_all.php")
				.then(res => {
					this.categories = res.body
				}, err => {
					console.log(err)
				});

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

	.page__tabs {
		margin: 0;
		padding: 0;
	}

	.page__tabs li  {
		list-style: none;
		margin: 0;
		padding: 5px 10px;
		display: inline-block;
		border: 1px solid #e7e7e7;
		border-radius: 4px 4px 0 0;
	}

	.page__tabs li:hover {

		background: linear-gradient(royalblue, blue);

	}

	.page__tabs li:hover a {
		color: #fff;
		text-decoration: none;
	}

	.page__tabs li a {

	}

</style>