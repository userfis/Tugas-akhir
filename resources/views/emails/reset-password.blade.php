@component('mail::message')
# Reset Password

Klik tombol di bawah ini untuk mereset password Anda:

@component('mail::button', ['url' => url('/reset-password/' . $token)])
Reset Password
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
