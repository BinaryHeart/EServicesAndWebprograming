<?
  require 'include/bootstrap.php';

  $db = Db::get_instance();

  $post = $db->insert_post(
    $_SESSION['current_user'],
    $_POST['message']
  );

  if(Request::is_ajax())
    require 'views/_post.php';
  else{
    header('Location: posts.php');
  }
?>
