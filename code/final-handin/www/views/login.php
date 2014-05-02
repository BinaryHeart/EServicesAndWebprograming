<? require '_header.php'; ?>

<h1>Login</h1>
<p>Login using the form below. Or click <a href="register.php">here to signup</a>.

<form action="login-process.php" method="POST">
  <input type="text" name="email" placeholder="Email">
  <input type="password" name="password" placeholder="Password">
  <input type="submit" value="Login">
</form>

<? require '_footer.php'; ?>