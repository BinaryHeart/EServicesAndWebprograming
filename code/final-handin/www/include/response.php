<?
  class Response{
    public static function kill($message=''){
      $base = "Internal server error";

      if($message)
        die("$base: $message");
      else
        die("$base.");
    }
  }