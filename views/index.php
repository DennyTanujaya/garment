<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<style>
			#card {
				background: #fbfbfb;
				border-radius: 8px;
				box-shadow: 1px 2px 8px rgba(0, 0, 0, 0.65);
				height: 410px;
				margin: 6rem auto 8.1rem auto;
				width: 329px;
			}
			#card-content {
				padding: 12px 44px;
			}
			body {
			   background-color: #87CEFA;
			}
			a {
				text-decoration: none;
			}
			label {
				font-family: "Raleway", sans-serif;
				font-size: 11pt;
			}
			#forgot-pass {
				color: #2dbd6e;
				font-family: "Raleway", sans-serif;
				font-size: 10pt;
				margin-top: 3px;
				text-align: right;
			}
			.form {
				align-items: left;
				display: flex;
				flex-direction: column;
			}
			.form-border {
				background: -webkit-linear-gradient(right, #a6f77b, #2ec06f);
				height: 1px;
				width: 100%;
			}
			.form-content {
				background: #fbfbfb;
				border: none;
				outline: none;
				padding-top: 14px;
			}
			#signup {
				color: #2dbd6e;
				font-family: "Raleway", sans-serif;
				font-size: 10pt;
				margin-top: 16px;
				text-align: center;
			}
			#submit-btn {
				background-color: #87CEFA;
				border: none;
				border-radius: 21px;
				box-shadow: 0px 1px 8px #24c64f;
				cursor: pointer;
				color: white;
				font-family: "Raleway SemiBold", sans-serif;
				height: 42.3px;
				margin: 0 auto;
				margin-top: 50px;
				transition: 0.25s;
				width: 153px;
			}
			#submit-btn:hover {
				box-shadow: 0px 1px 18px #24c64f;
			}
		</style>
	</head>
	<body>
	<div id="card">
		<div id="card-content">
			<div id="card-title">
				<h1 style="text-align:center;">Serrano</h1>
				<div class="underline-title"></div>
				<form method="post" class="form" action="../controllers/proses_login.php">
					<label for="user-email" style="padding-top:13px">&nbsp;Username</label>
					<input id="user-email" class="form-content" type="text" name="username" autocomplete="on" required />
					<div class="form-border"></div>
					<label for="user-password" style="padding-top:22px">&nbsp;Password</label>
					<input id="user-password" class="form-content" type="password" name="password" required />
					<div class="form-border"></div>
					<a href="#"><legend id="forgot-pass">Forgot password?</legend></a>
					<input id="submit-btn" type="submit" name="submit" value="LOGIN" />
					<!--<a href="#" id="signup">Don't have account yet?</a>-->
				</form>
			</div>
		</div>
	</div>
	</body>
</html>