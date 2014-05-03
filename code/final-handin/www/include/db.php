<?
  class Db{
    private static $_instance;
    private $mysqli;

    private function __construct(){
      $this->mysqli = new mysqli('127.0.0.1','root','','eservices');

      /* check connection */
      if ($this->mysqli->error) {
        printf("Connect failed: %s\n", $this->mysqli->error);
        exit();
      }
    }

    public static function get_instance(){
      if(self::$_instance == null)
        self::$_instance = new Db();
      return self::$_instance;
    }

    public function insert_post($email, $message){
      $args = array(
        'message' => $message,
        'email'   => $email
      );
      $sql = $this->_insert_query('posts', $args);
      $this->_put($sql);
    }

    public function create_user($email, $password, $password_confirmation){
      $user = new User($email, $password, $password_confirmation);

      if(!$user->is_valid()){
        return $user->errors;
      }
      else{
        $args = array(
          'email'     => $user->email,
          'password'  => $user->hashed_password,
          'salt'      => $user->salt
        );
        $sql = $this->_insert_query('users', $args);
        $this->_put($sql);
        return true;
      }
    }

    public function get_all_posts(){
      return $this->_get($this->_select_query('posts'));
    }

    public function get_user($email){
      $rows = $this->_get($this->_select_query('users', "WHERE email='$email'"));
      foreach($rows as $row){
        $result = $row;
        break;
      }
      if($result != null)
        return $result;
      else
        return false;
    }


    /*
     *
     * PRIVATES
     *
     */


    private function _put($query){
      $this->_query($query);
    }

    private function _get($query){
      $result = $this->_query($query);
      mysqli_fetch_all($result, MYSQLI_ASSOC);
      return $result;
    }

    private function _query($sql){
      $result  = $this->mysqli->query($sql);

      if($this->mysqli->error)
        die($this->mysqli->error);

      return $result;
    }

    private function _select_query($table, $conditions=null){
      return "SELECT * FROM $table $conditions";
    }

    private function _insert_query($table, $associative){
      $columns = array();
      $values  = array();
      foreach($associative as $col=>$val){
        $escaped_col = $this->mysqli->real_escape_string($col);
        $escaped_val = $this->mysqli->real_escape_string($val);

        array_push($columns, $col);
        array_push($values,  "'$val'");
      }
      $columns = join(',', $columns);
      $values  = join(',', $values );

      return "INSERT INTO $table ($columns) VALUES ($values);";
    }

    public function __deconstruct(){
      $this->mysqli->close();
    }
  }
?>