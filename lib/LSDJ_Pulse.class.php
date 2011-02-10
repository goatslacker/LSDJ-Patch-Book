<?

class LSDJ_Pulse {
	var $name = ""; 

	var $envelope = "A8";
	var $wave = "50";
	var $output = "LR";
	var $length = "UNLIM";
	var $sweep = "FF";
	var $vib_type = "HF";

	var $pu2_tune = "00";
	var $pu_fine = 0;

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
