@component('mail::message')
# Thank you for contacting B2B Global Hub.

<h1>User Details</h1>
<h3>User Detail: {{$data['name']}}</h3>
<h3>Email: {{$data['email']}}</h3>
<h3>Phone No: {{$data['phoneNo']}}</h3>
<h3>Shipping: {{$data['shipping']}}</h3>
<h3>Product: {{$data['productName']}}</h3>
<h3>Message: {{$data['message']}}</h3>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
