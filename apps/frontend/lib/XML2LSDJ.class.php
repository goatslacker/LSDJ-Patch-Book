<?
class XML2LSDJ {

  public static function length($length) {
    $length = ($length == "UNLIM") ? 255 : hexdec($length);
    $length = (~$length & 0x7F);
    return str_pad(dechex($length), 2, "0", STR_PAD_LEFT);
  }

  public static function hex2bin($hexstr) {
    $strarray = explode(' ', trim($hexstr));
 
    $outstr = '';
 
    for($i = 0; $i < sizeof($strarray); $i++){
      $outstr .= pack("H*", $strarray[$i]);
    }

    return $outstr;
  }
}
?>
