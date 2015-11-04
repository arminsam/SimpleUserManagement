<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<p>Password Reset</p>

<p>
    To reset your password, click on the link below. This link will expire in
    {{ Config::get('auth.reminder.expire', 60) }} minutes.
</p>
<p>
    <a href="{{ route('reset.password.index', [$token]) }}">
        {{ route('reset.password.index', [$token]) }}
    </a><br>
</p>
</body>
</html>
