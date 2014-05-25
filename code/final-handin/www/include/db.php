<?
  class Db{
    private static $_instance;
    private $mysqli;

    private function __construct(){
      $this->mysqli = new mysqli('127.0.0.1','root','','eservices');

      /* check connection */
      if ($this->mysqli->error) {
        Response::kill("Connect failed: %s\n", $this->mysqli->error);
      }
    }

    public static function get_instance(){
      if(self::$_instance == null)
        self::$_instance = new Db();
      return self::$_instance;
    }

    public function insert_post($email, $message){
      $user = $this->find_user_by_email($email);

      if($user){
        $args = array(
          'userId'  => $user['id'],
          'message' => $message
        );

        $sql = $this->_insert_query('posts', $args);
        $this->_put($sql);
        return $this->get_last_post();
      }else{
        var_dump($email);
        Response::kill('No user');
      }
    }

    public function get_last_post(){
      $posts = $this->get_all_posts();
      $post = end($posts);
      $post['email'] = $this->find_user($post['userId'])['email'];
      return $post;
    }

    public function find_user_by_email($email){
      $result = $this->_get($this->_select_query('users', "WHERE email='$email'"));
      if(count($result))
        return $result[0];
      else
        return false;
    }

    public function find_user($id){
      $result = $this->_get($this->_select_query('users', "WHERE id='$id'"));
      if(count($result))
        return $result[0];
      else
        return false;
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
      $result = array();

      $posts = $this->_get($this->_select_query('posts'));
      foreach($posts as $post){
        $post['email'] = $this->find_user($post['userId'])['email'];
        array_push($result, $post);
      }

      return $result;
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
      return mysqli_fetch_all($result, MYSQLI_ASSOC);
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