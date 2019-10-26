<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Action</title>
    <style>
        @import url('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');

        .info-msg,
            .success-msg,
            .warning-msg,
            .error-msg {
                margin: 10px 0;
                padding: 10px;
                border-radius: 3px 3px 3px 3px;
            }
            .info-msg {
                color: #059;
                background-color: #BEF;
            }
            .success-msg {
                color: #270;
                background-color: #DFF2BF;
            }
            .warning-msg {
                color: #9F6000;
                background-color: #FEEFB3;
            }
            .error-msg {
                color: #D8000C;
                background-color: #FFBABA;
            }

            /* Just for CodePen styling - don't include if you copy paste */
            html {
                font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                font-weight: 300;
                margin: 25px;
            }
            body {
                width: 640px;
        }
    </style>
</head>
<body>
    @if ($message = Session::get('fail'))
    <div class="info-msg">
        <i class="fa fa-info-circle"></i>
        {{$message}}, please <a href="{{route('admin.login')}}">Log In</a> to see.
    </div>
    @endif

    @if ($message = Session::get('success'))
    <div class="success-msg">
        <i class="fa fa-check"></i>
        {{$message}}, please <a href="{{route('admin.login')}}">Log In</a> to see.
    </div>
    @endif
</body>
</html>
