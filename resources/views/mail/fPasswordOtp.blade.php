<div style="width: 100%; display:block;">
<h2>Welcome To Supportstock</h2>
<p>
	<strong>{{ trans('labels.Hi') }} {{ $userData[0]->first_name }} {{ $userData[0]->last_name }}!</strong><br>
	Your OTP is {{ $userData[0]->rand_otp }}<br><br>
	<strong>{{ trans('labels.Sincerely') }},</strong><br>
	Supportstock
</p>
</div>