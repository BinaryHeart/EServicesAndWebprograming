<?

class Redirector{
    
  public static function redirect($path, $args=array()){
    if(count($args))
      foreach($args as $key=>$value)
        if(is_array($value))
          $args[$key] = self::explode_array($value);

    $urlargs = http_build_query($args);

    if($urlargs)
      header("Location: $path?$urlargs");
    else
      header("Location: $path");
  }

  public static function render($controller){
    require_once $controller;
  }

  private static function explode_array($arr){
    return join('|', $arr);
  }
}
