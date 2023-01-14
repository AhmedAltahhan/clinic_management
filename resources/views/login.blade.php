<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/nunito-font.css">
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body class="form-v6">
	<div class="page-content">
		<div class="form-v6-content">
			<div class="form-left">
				<img src="img/a.jpg" alt="form">
			</div>
			<form action="/login" method="POST" class="form-detail">
                @csrf
				<h2>Login</h2>
                <small style="color:red">{{$error}}</small>
				<div class="form-row">
					<input type="email" name="email" id="your-email" class="input-text" placeholder="Email Address" required>
				</div>
				<div class="form-row">
					<input type="password" name="password" id="password" class="input-text" placeholder="Password" required>
				</div>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="Login">
				</div>
			</form>
		</div>
	</div>
</body>
</html>
