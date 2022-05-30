
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot password</title>
</head>
<body>
    <p>
        Hello {{$user['name']}},
    </p>

    <p>
        Resetting your password is easy.<br>

        Just press the link below and follow the instructions. We’ll have you up and running in no time.<br>
        {{ 'https://www.cubedots.com/restPassword/'.$token.'/'.$email }}<br>
        <br>
        If you did not make this request then please ignore this email.
        </p>
    
        <br><br>
    <p>
        ---<br>
        Thanks
    </p>

</body>
</html>