@component('mail::message')
# Contact Us Mail

<h1>User Details</h1>
<h3>User Detail: {{$data['name']}}</h3>
<h3>Email: {{$data['email']}}</h3>
<h3>Phone number: {{$data['phoneNo']}}</h3>
<h3>Message: {{$data['message']}}</h3>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
