<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <style media="screen">

            form {
                margin-bottom: 0;
            }

            .row {
                margin-bottom: 1em;
            }

            .table > tbody > tr > td {
                 vertical-align: middle;
            }
        </style>
    </head>
    <main>
        <div>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="github.com/metrique/laravel-building">Laravel Building</a>
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ route('page.index') }}">Pages</a>
                            </li>
                            <li>
                                <a href="{{ route('component.index') }}">Components</a>
                            </li>
                    </div>
                </div>
            <nav>
        </div>

        <div class="container">
            @include('metrique-building::partial.message')
        </div>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <script src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
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
