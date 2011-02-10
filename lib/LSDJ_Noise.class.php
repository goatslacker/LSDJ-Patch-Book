<?
class LSDJ_Noise {
	var $name = "";
	var $envelope = "A8";
	var $output = "LR";
	var $length = "UNLIM";
	var $shape = "FF";

	var $automate = "OFF";
	var $table  = "OFF";

    function setTable() {
  $this->table = "ON";

  $this->_table = array(
	array("00","00","-00","-00"),
	array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00"),
    array("00","00","-00","-00")
  );
    }
}
?>
