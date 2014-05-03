<?
  require 'include/bootstrap.php';

  $db = Db::get_instance();

  $status = $db->create_user(
    $_POST['email'],
    $_POST['password'],
    $_POST['password_confirmation']
  );


  /* 
   * render
   */

  if($status === true){
    header('Location: index.php');
  }else{
    $email  = $_POST['email'];
    $errors = join('|', $status);
    header("Location: register.php?email=$email&errors=$errors");
  }