<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<p>Dear Sir/Madam,</P><br>

<p>
    A new account has been registered for you in ASM Site.
    Use the following username/password to login to your account. Please make sure you update your account
    information once you are logged in.
</p>

<p>
    Email: {{ $event->user->email }}<br>
    Password: <strong>{{ $event->randomPassword }}</strong><br>
    Login URL: <a href="{{ route('login.index', []) }}">
        {{ route('login.index', []) }}
    </a>
</p>
</body>
</html>
