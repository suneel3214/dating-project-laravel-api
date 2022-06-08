<!DOCTYPE html>
<html>
<head>
    <title>Dating.com</title>
    <style>
    	button{
    		background-color: green;
    		color: #fff !important;
    		width: 80px;
    		height: 30px;
    		border: none;
    	}
    </style>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>

    <button class="btn btn-success btn-sm">
       <a href="{{ route('user.verify', $token) }}" style='color: #fff;text-decoration: none;' class="">Verify</a>
    </button>
    <p>Thank you</p>
</body>
</html>