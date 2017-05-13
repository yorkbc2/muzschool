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
				<button class="dx-close" @click="openModal">X</button>
				<div class="dx-block">
					<form class='dx-form' v-on:submit.prevent="createPage">
						<div>
							<input type="text" v-model="page.name" required placeholder="Назва сторінки">
							<small> Її будуть бачити всі користувачі сайту у навігаторі.</small>
						</div>
						<div>
							<input type="text" v-model="page.link" required placeholder="Посилання на сторінку">
							<small>Посилання по якому буде знаходитись сторінка (/about)</small>
						</div>
						<div>
							<textarea name="add_page_content" id="add_page_content">
								Текст Вашої сторінки тут.
							</textarea>
						</div>
						<div>
							
						</div>
						<div>
							<input type="radio" name='isCategory' v-model="page.isCategory" value="false" @change="changeIsCategory">
							<input type="radio" name='isCategory' v-model="page.isCategory" value="true" @change="changeIsCategory">
						</div>
						<div>
							<select id="add_page_select" v-model="page.category">
								<option v-for="cat in categories" v-bind:value="cat.link">
									{{cat.name}}
								</option>
							</select>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="core/views/req/admin_comps/config/ckeditor.js"></script>

<script>


	let add_page = new Vue({
		el: "#add_page",

		data: {

			page_controller: "<?php $ms->get_basepath() ?>/core/listeners/page_controller/",

			creatingPage: false,

			categories: [],

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
			}
		}

		,
		methods: {

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

			changelog() {

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