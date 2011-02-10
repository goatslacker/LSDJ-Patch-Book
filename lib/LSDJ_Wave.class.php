<?

class LSDJ_Wave {
	var $name = "";

	var $volume = "3";
	var $output = "LR";
	var $vib_type = "HF";

	var $synth = "0";
	var $play = "ONCE";
	var $length = "F";
	var $repeat = "0";
	var $speed = "4";

	var $automate = "OFF";
	var $table  = "OFF";

	var $s_wave = "SIN";
	var $s_filter = "LOWP";
	var $s_q = "0";
	var $s_dist = "CLIP";
	var $s_phase = "NORMAL";

	var $s_start_volume = "10";
	var $s_start_cutoff = "FF";
	var $s_start_phase = "00";
	var $s_start_vshift = "00";

	var $s_end_volume = "10";
	var $s_end_cutoff = "FF";
	var $s_end_phase = "00";
	var $s_end_vshift = "00";

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
