<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h2>LOGIN</h2>

<form method="post" action="login_proses_buku.php">
    <table border="0">
        <tr>
            <td>USER</td>
            <td><input type="text" name="pengguna" required /></td>
        </tr>
        <tr>
            <td>PASSWORD</td>
            <td><input type="password" name="kata_kunci" required /></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="LOGIN" /></td>
        </tr>
    </table>
</form>

</body>
</html>
