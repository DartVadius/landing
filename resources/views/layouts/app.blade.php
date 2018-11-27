<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'HandmadeHome')</title>
    <meta name="keywords" content="@yield('keywords', '')">
    <meta name="description" content="@yield('description', '')">
    <meta name="robots" content="all">
    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="page-wrap">
    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="{{ route('index') }}" class="active"><span class="icon fa-home"></span></a></li>
            <li><a href="{{ route('galleries') }}"><span class="icon fa-camera-retro"></span></a></li>
            <li><a href="{{ route('posts') }}"><span class="icon fa-file-text-o"></span></a></li>
        </ul>
    </nav>
    <section id="main">
    @yield('content')
    <!-- Contact -->
        <section id="contact">
            <!-- Social -->
            <div class="social column">
                <h3>Обо мне</h3>
                {!! $about->text !!}
                <ul class="icons">
                    <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                    <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                    <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
                </ul>
            </div>

            <!-- Form -->
            <div class="column">
                <h3>Будьте на связи</h3>
                {!! Form::model(null, ['url' => URL::route('send_message')]) !!}
                <div class="field half first">
                    {!! Form::label('name', 'Имя'); !!}
                    {!! Form::text('name', null, ['required' => true, 'placeholder' => 'Имя', 'id' => 'name']) !!}

                </div>
                <div class="field half">
                    {!! Form::label('email', 'Email'); !!}
                    {!! Form::email('email', null, ['required' => true, 'placeholder' => 'Email', 'id' => 'email']) !!}
                </div>
                <div class="field">
                    {!! Form::label('message', 'Сообщение'); !!}
                    {!! Form::textarea('message', null, ['rows' => 6, 'placeholder' => 'Сообщение', 'id' => 'message']) !!}
                </div>
                <ul class="actions">
                    <li>{!! Form::submit('Отправить'); !!}</li>
                </ul>
                {!! Form::close() !!}
            </div>
        </section>
        <!-- Footer -->
        <footer id="footer">
            <div class="copyright">
                &copy; Design: <a href="https://templated.co/">TEMPLATED</a>.
            </div>
        </footer>
    </section>
</div>

<!-- Scripts -->
<script src="{{ asset('js/autobahn.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.poptrox.min.js') }}"></script>
<script src="{{ asset('js/jquery.scrolly.min.js') }}"></script>
<script src="{{ asset('js/skel.min.js') }}"></script>
<script src="{{ asset('js/util.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script>
    $( document ).ready(function() {
        var push_conn = new ab.connect('ws://localhost:8080',
            function(session) {
                session.subscribe('newGallery', function(topic, data) {
                    // This is where you would add the new article to the DOM (beyond the scope of this tutorial)
                    console.log(data.data);
                    console.info('topic id: ' + topic);
                });
            },
            function(code, reason, detail) {
                console.warn('WebSocket connection closed ' + code + " " + reason + " " + detail);
            },
            {
                'maxRetries': 60,
                'retryDelay': 4000,
                'skipSubprotocolCheck': true
            }
        );
    });

</script>
</body>
</html>
