<html>
<head>
<title></title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="header">
		<div id="content">
			<h2>Register</h2>
			<img src="images/login-welcome.gif" width="97" height="105" hspace="10" align="left">

			<form method="POST" action="proses.php">
				<table>
					<tr>
						<td>Username</td>
						<td> : <input type="text" name="username"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td> : <input type="password" name="password"></td>
					</tr>
					<tr>
						<td>NIK</td>
						<td> : <input type="text" name="nik"></td>
					</tr>
					<tr>
						<td>Nama Lengkap</td>
						<td> : <input type="text" name="nama"></td>
					</tr>
					<tr>
						<td>Nomor Telepon</td>
						<td> : <input type="text" name="telp"></td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" value="Register" name="register">
						</td>
					</tr>
				</table>
			</form>
			<td><a href="index.php"><button>Login</button></a></td>

			<p>&nbsp;</p>
		</div>
		<div id="footer">
				Copyright &copy; 2023 by <a href="github.com/MhnnX/">MhnnX</a> All rights reserved.
		</div>
	</div>
</body>
</html>
