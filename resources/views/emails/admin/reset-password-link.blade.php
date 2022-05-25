@component('mail::message')
# Update your existing password

<b>Hello!</b><br><br>
You are receiving this email because we received a password reset request for your account. <br>

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent <br>
This password reset link will expire in 60 minutes.
<br><br>
If you did not request a password reset, no further action is required.<br><br>
Thanks,<br>
{{ config('app.name') }}
<hr>
@component('mail::panel')
If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="{{ $url }}">{{ $url }}</a>
@endcomponent
@endcomponent
