let MS = {
	notice(text, method) {

		let div = this.createShell(text, method);

		$('body').append(div);

	},

	createShell(text, method) {

		let shell = $(`
			<div class='ms-notice ms-animation'>
				<button class='ms-close' onclick="$(this).parent().remove()">X</button>
				<h3>${method}</h3>
				<p>
					${text}
				</p>
			</div>
		`);

		return shell;

	}
}