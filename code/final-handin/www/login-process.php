<?

require 'include/bootstrap.php';

$email    = $_POST['email'];
$password = $_POST['password'];


if(Authorizer::login($email, $password)){
  Redirector::redirect('posts.php');

}else{

  Redirector::redirect('login.php', array(
    'errors' => array('Invalid credentials.')));

}
