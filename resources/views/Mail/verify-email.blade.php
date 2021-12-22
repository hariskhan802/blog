@component('mail::message')
# Welcome to Blog

<h2>{{ $user['name'] }}</h2>
<h2>{{ $user['email'] }}</h2>

@component('mail::button', ['url' => $user['url']])
Click here to verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
