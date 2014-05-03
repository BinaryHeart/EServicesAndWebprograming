<?
  require 'include/bootstrap.php';

  Authorizer::authorize();

  $db = Db::get_instance();
  $posts = $db->get_all_posts();

  if(!$_GET['type']=='ajax'){
    require 'views/posts.php';
  }else{
    require 'views/_posts-list.php';
  }
?>