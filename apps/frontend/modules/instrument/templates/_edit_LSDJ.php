<?php
switch ($type) {

	case "NOISE":
		$T = ($INS)? $INS:new LSDJ_Noise;
?>
        <div class="instrument"><p>
            <span>NAME<em><?php echo input_tag('lsdj_name', $T->name, array ('maxlength'=>'5', 'size'=>'5')) ?></em></span>
            <span>TYPE<em><?=($sf_params->get('type'))? $sf_params->get('type'):$type?></em></span>
            <br />
            <span>ENVELOPE<?=hexinput_tag('envelope',$T->envelope,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>OUTPUT<?=select_tag('output',options_for_select(array('LR'=>'LR','L'=>'L','R'=>'R'),$T->output))?></span>
            <span>LENGTH<?=hex1input_tag('length',$T->length,array('size'=>'4','maxlength'=>'5'))?></span>
            <span>SHAPE<?=hexinput_tag('shape',$T->shape,array('size'=>'2','maxlength'=>'2'))?></span>
            <br />
            <span>AUTOMATE<?=select_tag('automate',options_for_select(array('ON'=>'ON','OFF'=>'OFF'),$T->automate))?></span>
            <span>TABLE<?=select_tag('table',options_for_select(array('ON'=>'ON','OFF'=>'OFF'),$T->table),array('onchange'=>'if (this.options[this.selectedIndex].value == "ON") { $("INST_Table").style.display="block"; } else { $("INST_Table").style.display="none"; }'))?></span>
        </p></div>
<?
	break;
	case "WAVE":
		$T = ($INS)? $INS:new LSDJ_Wave;
?>
		<div class="instrument"><p>
            <span>NAME<em><?php echo input_tag('lsdj_name', $T->name, array ('maxlength'=>'5', 'size'=>'5')) ?></em></span>
            <span>TYPE<em><?=($sf_params->get('type'))? $sf_params->get('type'):$type?></em></span>
			<br />
            <span>VOLUME<?=select_tag('volume',options_for_select(array('0'=>'0','1'=>'1','2'=>'2','3'=>'3'),$T->volume))?></span>
            <span>OUTPUT<?=select_tag('output',options_for_select(array('LR'=>'LR','L'=>'L','R'=>'R'),$T->output))?></span>
            <span>VIB.TYPE<?=select_tag('vib_type',options_for_select(array('HF'=>'HF','SIN'=>'SIN','TRI'=>'TRI','SQR'=>'SQR'),$T->vib_type))?></span>
			<br />
			<span>SYNTH<em><?=$T->synth?></em></span>
            <span>PLAY<?=select_tag('play',options_for_select(array('ONCE'=>'ONCE','LOOP'=>'LOOP','PINGPONG'=>'PINGPONG','MANUAL'=>'MANUAL'),$T->play))?></span>
            <span>LENGTH<?=hex1input_tag('length',$T->length,array('size'=>'1','maxlength'=>'1'))?></span>
            <span>REPEAT<?=hex1input_tag('repeat',$T->repeat,array('size'=>'1','maxlength'=>'1'))?></span>
            <span>SPEED<?=hex1input_tag('speed',$T->speed,array('size'=>'1','maxlength'=>'1'))?></span>
			<br />
            <span>AUTOMATE<?=select_tag('automate',options_for_select(array('ON'=>'ON','OFF'=>'OFF'),$T->automate))?></span>
            <span>TABLE<?=select_tag('table',options_for_select(array('ON'=>'ON','OFF'=>'OFF'),$T->table),array('onchange'=>'if (this.options[this.selectedIndex].value == "ON") { $("INST_Table").style.display="block"; } else { $("INST_Table").style.display="none"; }'))?></span>
		</p></div>

		<div class="instrument"><p><strong>SYNTH</strong><br />
            <span>WAVE<?=select_tag('wave',options_for_select(array('SIN'=>'SIN','SQR'=>'SQR','TRI'=>'TRI'),$T->s_wave))?></span>
            <span>FILTER<?=select_tag('filter',options_for_select(array('LOWP'=>'LOWP','HIGHP'=>'HIGHP','BANDP'=>'BANDP','ALLP'=>'ALLP'),$T->s_filter))?></span>
            <span>Q<?=hex1input_tag('q',$T->s_q,array('size'=>'1','maxlength'=>'1'))?></span>
            <span>DIST<?=select_tag('dist',options_for_select(array('CLIP'=>'CLIP','WRAP'=>'WRAP'),$T->s_dist))?></span>
            <span>PHASE<?=select_tag('phase',options_for_select(array('NORMAL'=>'NORMAL','RESYNC'=>'RESYNC','RESYN2'=>'RESYN2'),$T->s_phase))?></span>
			<br />
			<span>START:</span>
            <span>VOLUME<?=hexinput_tag('start_volume',$T->s_start_volume,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>CUTOFF<?=hexinput_tag('start_cutoff',$T->s_start_cutoff,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>PHASE<?=hex1input_tag('start_phase',$T->s_start_phase,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>VSHIFT<?=hexinput_tag('start_vshift',$T->s_start_vshift,array('size'=>'2','maxlength'=>'2'))?></span>
			<br />
			<span>END:</span>
            <span>VOLUME<?=hexinput_tag('end_volume',$T->s_end_volume,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>CUTOFF<?=hexinput_tag('end_cutoff',$T->s_end_cutoff,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>PHASE<?=hex1input_tag('end_phase',$T->s_end_phase,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>VSHIFT<?=hexinput_tag('end_vshift',$T->s_end_vshift,array('size'=>'2','maxlength'=>'2'))?></span>
		</p></div>
<?
	break;
	default:
		$T = ($INS)? $INS:new LSDJ_Pulse;
?>
		<div class="instrument"><p>
            <span>NAME<em><?php echo input_tag('lsdj_name', $T->name, array ('maxlength'=>'5', 'size'=>'5')) ?></em></span>
            <span>TYPE<em><?=($sf_params->get('type'))? $sf_params->get('type'):$type?></em></span>
            <br />
            <span>ENVELOPE<?=hexinput_tag('envelope',$T->envelope,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>WAVE<?=select_tag('wave',options_for_select(array('12.5'=>'12.5%','25'=>'25%','50'=>'50%','75'=>'75%'),$T->wave))?></span>
            <span>OUTPUT<?=select_tag('output',options_for_select(array('LR'=>'LR','L'=>'L','R'=>'R'),$T->output))?></span>
            <span>LENGTH<?=hex1input_tag('length',$T->length,array('size'=>'4','maxlength'=>'5'))?></span>
            <span>SWEEP<?=hexinput_tag('sweep',$T->sweep,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>VIB.TYPE<?=select_tag('vib_type',options_for_select(array('HF'=>'HF','SIN'=>'SIN','TRI'=>'TRI','SQR'=>'SQR'),$T->vib_type))?></span>
            <br />
            <span>PU2 TUNE<?=hexinput_tag('pu2_tune',$T->pu2_tune,array('size'=>'2','maxlength'=>'2'))?></span>
            <span>PU FINE<?=hex1input_tag('pu_fine',$T->pu_fine,array('size'=>'1','maxlength'=>'1'))?></span>
            <br />
            <span>AUTOMATE<?=select_tag('automate',options_for_select(array('ON'=>'ON','OFF'=>'OFF'),$T->automate))?></span>
            <span>TABLE<?=select_tag('table',options_for_select(array('ON'=>'ON','OFF'=>'OFF'),$T->table),array('onchange'=>'if (this.options[this.selectedIndex].value == "ON") { $("INST_Table").style.display="block"; } else { $("INST_Table").style.display="none"; }'))?></span>
        </p></div>
<?
	break;
}
?>

<div id="INST_Table" class="table"><p><strong>TABLE</strong><br />
<table>
<tr><th></th><th>VOL</th><th>TSP</th><th>CMD</th><th>CMD</th></tr>
<?php for ($a=0; $a<15; $a++): ?>
<? $b = ($a > 8)? chr(88+$a) : $a; ?>
<tr>
  <td><?=strtoupper($b)?></td>
  <td><?=hexinput_tag("t{$b}0",@$T->_table[$a][0]?$T->_table[$a][0]:'00')?></td>
  <td><?=hexinput_tag("t{$b}1",@$T->_table[$a][1]?$T->_table[$a][1]:'00')?></td>
  <td><?=input_tag("t{$b}2",@$T->_table[$a][2]?$T->_table[$a][2]:'-00',array('onfocus'=>'this.title=this.value','onchange'=>'validateLsdjTable(this)','onkeyup'=>'lsdj_table(event,this)','maxlength'=>'3'))?></td>
  <td><?=input_tag("t{$b}3",@$T->_table[$a][3]?$T->_table[$a][3]:'-00',array('onfocus'=>'this.title=this.value','onchange'=>'validateLsdjTable(this)','onkeyup'=>'lsdj_table(event,this)','maxlength'=>'3'))?></td>
</tr>
<? endfor; ?>
</table>
</p></div>
  </td>
</tr>
<?
if ($T->table == "ON") { 
  echo "<script>$('INST_Table').style.display='block';</script>";
}
?>
