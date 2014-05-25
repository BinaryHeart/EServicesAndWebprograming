<?
  date_default_timezone_set('UTC');
  session_start();

  // models
  include 'db.php';
  include 'redirector.php';
  include 'response.php';
  include 'authorizer.php';
  include 'user.php';


  // procedural
  include 'flashes.php';
?>