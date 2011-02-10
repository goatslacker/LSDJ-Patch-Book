<?php

// i dislike this object, but I don't have a better way of doing this right now.

class editInstrument {
  public static function LSDJ($_this) {
	switch ($_this->getRequestParameter('type')) {
        case "PULSE":
          $OB = new LSDJ_Pulse;

          $OB->envelope = $_this->getRequestParameter('envelope');
          $OB->wave = $_this->getRequestParameter('wave');
          $OB->output = $_this->getRequestParameter('output');
          $OB->length = $_this->getRequestParameter('length');
          $OB->sweep = $_this->getRequestParameter('sweep');
          $OB->vib_type = $_this->getRequestParameter('vib_type');

          $OB->pu2_tune = $_this->getRequestParameter('pu2_tune');
          $OB->pu_fine = $_this->getRequestParameter('pu_fine');

          $OB->automate = $_this->getRequestParameter('automate');
          $OB->table = $_this->getRequestParameter('table');
        break;
        case "NOISE":
          $OB = new LSDJ_Noise;

          $OB->envelope = $_this->getRequestParameter('envelope');
          $OB->output = $_this->getRequestParameter('output');
          $OB->length = $_this->getRequestParameter('length');
          $OB->shape = $_this->getRequestParameter('shape');

          $OB->automate = $_this->getRequestParameter('automate');
          $OB->table = $_this->getRequestParameter('table');
        break;
        case "WAVE":
          $OB = new LSDJ_Wave;

          $OB->volume = $_this->getRequestParameter('volume');
          $OB->output = $_this->getRequestParameter('output');
          $OB->vib_type = $_this->getRequestParameter('vib_type');

          $OB->synth = $_this->getRequestParameter('synth');
          $OB->play = $_this->getRequestParameter('play');
          $OB->length = $_this->getRequestParameter('length');
          $OB->repeat = $_this->getRequestParameter('repeat');
          $OB->speed = $_this->getRequestParameter('speed');

          $OB->automate = $_this->getRequestParameter('automate');
          $OB->table = $_this->getRequestParameter('table');

          $OB->s_wave = $_this->getRequestParameter('wave');
          $OB->s_filter = $_this->getRequestParameter('filter');
          $OB->s_q = $_this->getRequestParameter('q');
          $OB->s_dist = $_this->getRequestParameter('dist');
          $OB->s_phase = $_this->getRequestParameter('phase');

          $OB->s_start_volume = $_this->getRequestParameter('start_volume');
          $OB->s_start_cutoff = $_this->getRequestParameter('start_cutoff');
          $OB->s_start_phase = $_this->getRequestParameter('start_phase');
          $OB->s_start_vshift = $_this->getRequestParameter('start_vshift');

          $OB->s_end_volume = $_this->getRequestParameter('end_volume');
          $OB->s_end_cutoff = $_this->getRequestParameter('end_cutoff');
          $OB->s_end_phase = $_this->getRequestParameter('end_phase');
          $OB->s_end_vshift = $_this->getRequestParameter('end_vshift');
        break;
      }
      if ($OB->table == "ON") {
        $OB->setTable();
$OB->_table[0]=array($_this->getRequestParameter('t00'),$_this->getRequestParameter('t01'),$_this->getRequestParameter('t02'),$_this->getRequestParameter('t03'));
$OB->_table[1]=array($_this->getRequestParameter('t10'),$_this->getRequestParameter('t11'),$_this->getRequestParameter('t12'),$_this->getRequestParameter('t13'));
$OB->_table[2]=array($_this->getRequestParameter('t20'),$_this->getRequestParameter('t21'),$_this->getRequestParameter('t22'),$_this->getRequestParameter('t23'));
$OB->_table[3]=array($_this->getRequestParameter('t30'),$_this->getRequestParameter('t31'),$_this->getRequestParameter('t32'),$_this->getRequestParameter('t33'));
$OB->_table[4]=array($_this->getRequestParameter('t40'),$_this->getRequestParameter('t41'),$_this->getRequestParameter('t42'),$_this->getRequestParameter('t43'));
$OB->_table[5]=array($_this->getRequestParameter('t50'),$_this->getRequestParameter('t51'),$_this->getRequestParameter('t52'),$_this->getRequestParameter('t53'));
$OB->_table[6]=array($_this->getRequestParameter('t60'),$_this->getRequestParameter('t61'),$_this->getRequestParameter('t62'),$_this->getRequestParameter('t63'));
$OB->_table[7]=array($_this->getRequestParameter('t70'),$_this->getRequestParameter('t71'),$_this->getRequestParameter('t72'),$_this->getRequestParameter('t73'));
$OB->_table[8]=array($_this->getRequestParameter('t80'),$_this->getRequestParameter('t81'),$_this->getRequestParameter('t82'),$_this->getRequestParameter('t83'));
$OB->_table[9]=array($_this->getRequestParameter('ta0'),$_this->getRequestParameter('ta1'),$_this->getRequestParameter('ta2'),$_this->getRequestParameter('ta3'));
$OB->_table[10]=array($_this->getRequestParameter('tb0'),$_this->getRequestParameter('tb1'),$_this->getRequestParameter('tb2'),$_this->getRequestParameter('tb3'));
$OB->_table[11]=array($_this->getRequestParameter('tc0'),$_this->getRequestParameter('tc1'),$_this->getRequestParameter('tc2'),$_this->getRequestParameter('tc3'));
$OB->_table[12]=array($_this->getRequestParameter('td0'),$_this->getRequestParameter('td1'),$_this->getRequestParameter('td2'),$_this->getRequestParameter('td3'));
$OB->_table[13]=array($_this->getRequestParameter('te0'),$_this->getRequestParameter('te1'),$_this->getRequestParameter('te2'),$_this->getRequestParameter('te3'));
$OB->_table[14]=array($_this->getRequestParameter('tf0'),$_this->getRequestParameter('tf1'),$_this->getRequestParameter('tf2'),$_this->getRequestParameter('tf3'));
      }

	return $OB;
  }

  public static function FamiTracker($_this) {
	$OB = new FamiTracker;
	$OB->volume = str_replace(","," ",$_this->getRequestParameter('volume'));
	$OB->arpeggio = str_replace(","," ",$_this->getRequestParameter('arpeggio'));
	$OB->pitch = str_replace(","," ",$_this->getRequestParameter('pitch'));
	$OB->hi_pitch = str_replace(","," ",$_this->getRequestParameter('hi_pitch'));
	$OB->duty_noise = str_replace(","," ",$_this->getRequestParameter('duty_noise'));

	return $OB;
  }
}

?>
