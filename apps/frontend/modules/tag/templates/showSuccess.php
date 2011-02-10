<?php use_helper('Text','Global') ?>

<h1>Instruments tagged as "<?php echo $sf_params->get('tag') ?>"</h1>
<?php include_partial('instrument/list', array('instrument_pager' => $instrument_pager, 'rule' => '@tag?tag='.$sf_params->get('tag'))) ?>
