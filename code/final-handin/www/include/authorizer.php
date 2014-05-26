<? class Authorizer{
  public static function login($email, $password){
    $db = Db::get_instance();

    $user = $db->find_user_by_email($email);
    $expected = $user['password'];

    $given = self::hash($password, $user['salt']);

    if($expected == $given){
      $_SESSION['current_user'] = $email;
      return true;
    }else{
      return false;
    }
  }

  public static function logout(){
    session_destroy();
    Redirector::redirect('index.php');
  }

  public static function authorize(){
    if(!isset($_SESSION['current_user'])){
      Redirector::redirect('login.php');
    }
  }

  public static function hash($password, $salt){
    return sha1($password . $salt);
  }
}