<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
        <script src="js/app.js"></script>
        <!-- <script src="{{asset('js/echo.js')}}"></script> -->
        <script>
        var module = { };
           // Enable pusher logging - don't include this in production
           Pusher.logToConsole = true;

           var pusher = new Pusher('f45f35f433671e1538b4', {
             cluster: 'eu',
             forceTLS: true
           });

           var channel = pusher.subscribe('my-channel');
           channel.bind('chat-started', function(data) {
             alert(JSON.stringify(data));
           });

           function postMessage() {
             document.getElementById('result').innerHTML =
                document.getElementById('text').value;
             document.getElementById('test').style.display = "block";
           }

        </script>
        <!-- Styles -->
        <style>
            html, body {
              background-color: #fff;
              color: #636b6f;
              font-family: 'Nunito', sans-serif;
              font-weight: 200;
              margin: 15px;
            }

            p {
              margin: 5px;
            }

            .full-height {
              height: 100vh;
            }

            .flex-center {
              align-items: center;
              display: flex;
              justify-content: center;
            }

            .position-ref {
              position: relative;
            }

            .top-right {
              position: absolute;
              right: 10px;
              top: 18px;
            }

            .content {
              text-align: center;
            }

            .title {
              font-size: 84px;
            }

            .links > a {
              color: #636b6f;
              padding: 0 25px;
              font-size: 13px;
              font-weight: 600;
              letter-spacing: .1rem;
              text-decoration: none;
              text-transform: uppercase;
            }

            .m-b-md {
              margin-bottom: 30px;
            }

            .flex {
              display: flex;
              flex-direction: column;
            }

            .message {
              padding: .2em;
              border-radius: 20px;
              background-color: rgba(186, 186, 186, .5);
              min-width: 5%;
              max-width: 20%;
              text-align: center;
              margin: auto;
              margin-bottom: 5px;
              margin-top: 5px;
              flex-grow: 1;
            }
            .message:nth-child(2n+0) {
              background-color: rgba(92, 228, 94, 0.84);
              margin-right: 35%;
            }
            .message:nth-child(2n+1) {
              margin-left: 35%;
            }
            .message:last-child {
              display: none;
            }
        </style>
    </head>
    <body>
      <div class="content">
        <div class="title m-b-md">
          ChatBot
        </div>
        <p>
          Ask something please.
        </p>

        <div class="flex">
          @foreach ($messages as $message)
          <div class="message">
            <p>{{ $message->content }}</p>
          </div>
          @endforeach
          <div id="test" class="message">
            <p id="result"></p>
          </div>
        </div>

        <form action="/" method="post" >
          <input type="text" name="text" id="text">
          <input type="submit" onclick="postMessage()">
          {{ csrf_field() }}
        </form>

      </div>
    </body>
    <script>
    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{env("PUSHER_KEY")}}',
        cluster: 'eu',
        encrypted: true,
        authEndpoint: '{{env("APP_URL")}}/broadcasting/auth'
    });
</script>
</html>
