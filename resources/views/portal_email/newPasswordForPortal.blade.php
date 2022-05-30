<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New password for portal</title>
</head>

<body>
    <p>
        Dear {{ $user['name'] }},
    </p>


    <p>
        Your new password has been updated.<br>
        here is your account details:<br>
        Portal URL: https://www.cubedots.com<br>
        Email: {{ $user['email'] }}<br>
        Password: {{ $password }}<br>

    </p>
    <p>
        This is temporary password. please change your password after first login.
    </p>

    <br>

    <p>
        ---<br>
        Thanks
    </p>

</body>

</html>
