<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    Hi <strong>{{ $name }}</strong>,

    <p>User <b>{{$inv->users_name}}</b> has added new inventory.</p><br>
    <p>You can <a href="{{route('mail-action.approved', $inv->id)}}">approved</a>, <b>or</b> <a href="{{route('mail-action.reject', $inv->id)}}">reject</a> the users inventory.</p><br>

    Regards.
</body>
</html>
