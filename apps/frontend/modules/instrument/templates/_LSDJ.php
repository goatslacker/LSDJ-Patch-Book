<?
$T = unserialize($instrument->getObject());

switch ($instrument->getType()) {

	case "NOISE":
?>
		<div class="instrument"><p>
			<span>NAME<em><?=$T->name?></em></span>
			<span>TYPE<em><?=$instrument->getType()?></em></span>
			<br />
			<span>ENVELOPE<em><?=$T->envelope?></em></span>
			<span>OUTPUT<em><?=$T->output?></em></span>
			<span>LENGTH<em><?=$T->length?></em></span>
			<span>SHAPE<em><?=$T->shape?></em></span>
			<br />
			<span>AUTOMATE<em><?=$T->automate?></em></span>
			<span>TABLE<em><?=$T->table?></em></span>
		</p></div>

<?
	break;
	case "PULSE":
?>
		<div class="instrument"><p>
			<span>NAME<em><?=$T->name?></em></span>
			<span>TYPE<em><?=$instrument->getType()?></em></span>
			<br />
			<span>ENVELOPE<em><?=$T->envelope?></em></span>
			<span>WAVE<em><?=$T->wave?></em></span>
			<span>OUTPUT<em><?=$T->output?></em></span>
			<span>LENGTH<em><?=$T->length?></em></span>
			<span>SWEEP<em><?=$T->sweep?></em></span>
			<span>VIB.TYPE<em><?=$T->vib_type?></em></span>
			<br />
			<span>PU2 TUNE<em><?=$T->pu2_tune?></em></span>
			<span>PU FINE<em><?=$T->pu_fine?></em></span>
			<br />
			<span>AUTOMATE<em><?=$T->automate?></em></span>
			<span>TABLE<em><?=$T->table?></em></span>
		</p></div>
<?
	break;
	case "WAVE":
?>
		<div class="instrument"><p>
			<span>NAME<em><?=$T->name?></em></span>
			<span>TYPE<em><?=$instrument->getType()?></em></span>
			<br />
			<span>VOLUME<em><?=$T->volume?></em></span>
			<span>OUTPUT<em><?=$T->output?></em></span>
			<span>VIB.TYPE<em><?=$T->vib_type?></em></span>
			<br />
			<span>SYNTH<em><?=$T->synth?></em></span>
			<span>PLAY<em><?=$T->play?></em></span>
			<span>LENGTH<em><?=$T->length?></em></span>
			<span>REPEAT<em><?=$T->repeat?></em></span>
			<span>SPEED<em><?=$T->speed?></em></span>
			<br />
			<span>AUTOMATE<em><?=$T->automate?></em></span>
			<span>TABLE<em><?=$T->table?></em></span>
		</p></div>

		<div class="instrument"><p><strong>SYNTH</strong><br />
			<span>WAVE<em><?=$T->s_wave?></em></span>
			<span>FILTER<em><?=$T->s_filter?></em></span>
			<span>Q<em><?=$T->s_q?></em></span>
			<span>DIST<em><?=$T->s_dist?></em></span>
			<span>PHASE<em><?=$T->s_phase?></em></span>
			<br />
			<span>START:</span>
			<span>VOLUME<em><?=$T->s_start_volume?></em></span>
			<span>CUTOFF<em><?=$T->s_start_cutoff?></em></span>
			<span>PHASE<em><?=$T->s_start_phase?></em></span>
			<span>VSHIFT<em><?=$T->s_start_vshift?></em></span>
			<br />
			<span>END:</span>
			<span>VOLUME<em><?=$T->s_end_volume?></em></span>
			<span>CUTOFF<em><?=$T->s_end_cutoff?></em></span>
			<span>PHASE<em><?=$T->s_end_phase?></em></span>
			<span>VSHIFT<em><?=$T->s_end_vshift?></em></span>
		</p></div>
<?
	break;
	default:
		echo "";
	break;
}

if ($T->table == "ON") { ?>
<div class="table"><p><strong>TABLE</strong><br />
<table>
<tr><th></th><th>VOL</th><th>TSP</th><th>CMD</th><th>CMD</th></tr>
<?php for ($a=0; $a<15; $a++): ?>
<? $b = ($a > 8)? chr(88+$a) : $a; ?>
<tr>
  <td><?=strtoupper($b)?></td>
  <td><?=$T->_table[$a][0]?></td>
  <td><?=$T->_table[$a][1]?></td>
  <td><?=$T->_table[$a][2]?></td>
  <td><?=$T->_table[$a][3]?></td>
</tr>
<? endfor; ?>
</table>
</p></div>
<? }
?>
