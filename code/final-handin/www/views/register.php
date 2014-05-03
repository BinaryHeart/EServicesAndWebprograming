<? require '_header.php'; ?>

<h1>Create new account</h1>
<p>Please fill in all the information</p>

<form action="register-create.php" method="POST">
  <input type="text" name="email" placeholder="Your email-adress">
  <input type="password" name="password" placeholder="password">
  <input type="password" name="password_confirmation" placeholder="password again">
  <input type="submit" value="Register">
</form>

<? require '_footer.php'; ?>
