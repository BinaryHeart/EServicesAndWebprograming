<? class User{
  public $errors = array();
  public $password;
  public $email;
  public $password_confirmation;
  public $hashed_password;

  function __construct($email, $password, $password_confirmation){
    $this->email = $email;
    $this->password = $password;
    $this->password_confirmation = $password_confirmation;

    $this->_validate();
    $this->_hash_password();
  }

  public function is_valid(){
    return (count($this->errors) == 0);
  }

  private function _validate(){
    $this->_validate_email();
    $this->_validate_password();
  }

  private function _validate_email(){
    $part_at  = strpos($this->email, '@');
    $part_dot = strpos($this->email, '.');
    // TODO: Too naive
    if($part_at === false || $part_dot === false){
      array_push($this->errors, 'Invalid email adress.');
    }
  }

  private function _validate_password(){
    if($this->password != $this->password_confirmation)
      array_push($this->errors, "Passwords do not match.");
    else if(strlen($this->password) < 3)
      array_push($this->errors, "Password is too short.");
  }

  private function _hash_password(){
    if($this->is_valid()){
      $this->salt = date('c');
      $this->hashed_password = Authorizer::hash($this->password, $this->salt);
    }
  }
}