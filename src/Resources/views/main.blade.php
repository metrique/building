<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <title>Building</title>
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
                        <a class="navbar-brand" href="github.com/metrique/laravel-building"><i class="fa fa-lg fa-building-o" aria-hidden="true"></i> Building</a>
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
        /**
         * Required for destroy/delete functionality.
         * Attaches an event listener and triggers a warning before deleting content.
         *
         * Usage: Add data-role="destroy" and optionally data-route="http://new-route"
         *
         * data-role: Specifies that the element is to be used for destroying data.
         * data-route: Updates the form action attribute
         */

        var destroy = document.querySelectorAll('[data-role="destroy"]');

        for(var i = 0; i < destroy.length; i++) {

            destroy[i].addEventListener('click', function(event) {

                if(!window.confirm('Are you sure you want to delete this?')) {
                    return event.preventDefault();
                }

                // Search for hidden '_method' input.
                var method = document.querySelector('input[name="_method"]');

                if(method == null) {
                    // Create and add '_method' input to form.
                    method = document.createElement(
                        'input'
                    ).setAttribute(
                        'type', 'hidden'
                    ).setAttribute(
                        'name', '_method'
                    ).setAttribute(
                        'value', 'DELETE'
                    );

                    event.target.form.appendChild(method);
                } else {
                    // Update '_method' input to be 'DELETE'.
                    method.setAttribute('value', 'DELETE');
                }

                // Update form action if data-route is given.
                var route = event.target.getAttribute('data-route');
                
                if(route !== null) {
                    event.target.form.setAttribute('action', route);
                }

                return true;
            });
        }
    </script>
</html>
