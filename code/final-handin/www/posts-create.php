<?
  require 'include/bootstrap.php';

  $db = new Db();

  $db->insert_post(
    $_POST['email'],
    $_POST['message']
  );

  header('Location: posts.php');
?>
