<?
  require 'include/bootstrap.php';

  $db = Db::get_instance();

  $db->insert_post(
    $_SESSION['current_user'],
    $_POST['message']
  );

  header('Location: posts.php');
?>
