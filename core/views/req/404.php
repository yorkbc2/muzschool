<div id="err_404">
	<h2>{{error}}</h2>
	<a v-bind:href="error_link">На головну</a>
</div>

<script>

	let err = new Vue({
		el: "#err_404",

		data: {
			error: "404. Сторінку не знайдено.",
			error_link: "<?php $ms->get_basepath() ?>" + "/"
		}
	})

</script>