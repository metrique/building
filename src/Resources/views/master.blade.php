<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/js/vendor/modernizr.js"></script>
	</head>
	<main>
		<div>
			<div class="row">
				@include('metrique-building::partial.message')
			</div>
			<div class="row">
				@yield('content')
			</div>
		</div>
	</main>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/js/vendor/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/js/foundation.min.js"></script>
	<script>
		// Modal
		$(document).foundation().ready(function(){
			$('div[data-reveal-auto]').foundation('reveal', 'open');
		});

		// Required for some destroy/delete functionality.
		$('[data-role="destroy"]').on('click', (event) => {

			var result = window.confirm('Are you sure you want to delete this?');

			if(!result)
			{
				return event.preventDefault();
			}

			// Update the form _method to DELETE
			var deleteInput = '<input type="hidden" name="_method" value="DELETE">';

			// Update the form action and submit it.
			var destroyRoute = $(event.target).data('route');
			var form = $(event.target).parents('form:first');
			return $(form).prepend(deleteInput).attr('action', destroyRoute);

		});
	</script>
</html>