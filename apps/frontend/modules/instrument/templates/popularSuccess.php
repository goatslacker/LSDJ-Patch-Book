<?php use_helper('Text', 'Global') ?>

<h1>Top Instruments</h1> 
<?php include_partial('list', array('instrument_pager' => $instrument_pager, 'rule' => 'instrument/popular')) ?>
