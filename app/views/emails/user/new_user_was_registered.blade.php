<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<p>Hello {{ $event->user->name }},</P><br>

<p>
    Your are registered in ASM Site.
    Use the following username/password to login to your account.
</p>

<p>
    Username: <strong>{{ $event->user->username }}</strong><br>
    Password: <strong>{{ $event->randomPassword }}</strong><br>
    Login URL: <a href="{{ route('login.index', []) }}">
        {{ route('login.index', []) }}
    </a>
</p>
</body>
</html>
