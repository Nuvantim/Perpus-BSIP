<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login System</title>
</head>
<body>
	<form action="{{ route('login') }}">
		<div>
			<label>Username : </label>
        	<input type="text" placeholder="Username" name="username" required>
		</div>
		<div>
			<label>Password : </label>
        	<input type="password" placeholder="Password" name="password" required>
		</div>
		<button type="submit">Login</button>
	</form>
</body>
</html>