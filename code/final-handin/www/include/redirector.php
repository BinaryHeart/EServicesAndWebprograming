<?

class Redirector{
    
  public static function redirect($path, $args=array()){
    if(count($args))
      foreach($args as $key=>$value)
        if(is_array($value))
          $args[$key] = self::explode_array($value);

    /*$args = join('&', $args);

    $url = "$path?$args";*/
    $urlargs = http_build_query($args);
    $url = "$path?$urlargs";

    header("Location: $url");
  }

  private static function explode_array($arr){
    return join('|', $arr);
  }
}
