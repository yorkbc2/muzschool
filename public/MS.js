let MS = {
	notice(text, method, type) {

		let div = this.createShell(text, method, type);

		$('body').append(div);

	},

	date() {

		let d = new Date().getDate();
		let m = parseInt(new Date().getMonth()) + 1;
		let y = new Date().getFullYear();
		let h = this.correctDate(new Date().getHours());
		let ms = this.correctDate(new Date().getMinutes());

	},

	correctDate(d) {

		let l = d < 10 ? "0" + d.toString() : d;

		return l ; 

	},

	createShell(text, method, type) {
		let shell = ""

		if (type == 'succ') {
			shell = $(`
			<div class='ms-notice ms-success ms-animation'>
				<button class='ms-close' onclick="$(this).parent().remove()">X</button>
				<h3>${method}</h3>
				<p>
					${text}
				</p>
			</div>
			`);
		}
		else {
			shell = $(`
			<div class='ms-notice ms-animation'>
				<button class='ms-close' onclick="$(this).parent().remove()">X</button>
				<h3>${method}</h3>
				<p>
					${text}
				</p>
			</div>
		`);
		}

		return shell;

	},
	loading(text_) {

		let shell = $('<div class="loading_block" id="__LOADING" />')
		let text__ = $("<i class='fa fa-spinner fa-spin'></i><span>"+text_+"</span>")

		shell.append(text__)
	
		console.log(shell)

		$('body').append(shell)

	},
	removeLoading(text_) {
		let el = $("#__LOADING")
		el.addClass('_success')
		el.html(`<i class='fa fa-check-circle'></i> <span>${text_}</span>`)

		setTimeout(e => {
			el.remove()
		}, 2000)
	}
}
