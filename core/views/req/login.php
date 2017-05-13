<div id="login">
	
	<div class="center-block">
		<form v-on:submit.prevent="onSubmit" class='dx-form'>
			<div class="error-message" v-if="error.length > 0">
				
				{{error}}

			</div>
			<div>
				<input type="text" v-model="login" placeholder="Логін" required>
				<small>
					Введіть Ваш логін, який Ви вказали при реєстрації
				</small>
			</div>
			<div>
				<input type="password" v-model="password" placeholder="Пароль">
				<small>Згадайте пароль, який Ви придумали</small>
			</div>
			<div>
				<button type='submit' class='submit-button'>
					Увійти <i class="fa fa-sign-in"></i>
				</button>
			</div>

		</form>
	</div>

</div>


<script>
	let login = new Vue({

		el : "#login", 

		data: {
			login: "",
			password: "",
			error: ""
		},

		methods: {
			onSubmit(event) {
			
				this.$http.post("/muzschool/core/listeners/login.php", {
					login: this.login,
					password: this.password
				}, {
					emulateJSON: true
				}).then(res => {
					
					if(res.body == "1" || res.body == 1) {

						window.location.href="/muzschool/admin-panel";

					}
					else {

						this.error = res.body;
						MS.notice(this.error, "помилка");

					}

				}, err => {
					console.error(err);
				})


			}
		}

	})
</script>


<style>
	
	.submit-button {
		padding: 5px 10px;
		color: white;
		background-color: <?php echo $ms->main_color; ?>;
		font-family: <?php echo $ms->main_font ; ?>;
		font-size: 18px;
		border: 1px solid transparent;
		border-radius: 3px;
		box-shadow: 1px 1px 3px #000;
	}	


</style>