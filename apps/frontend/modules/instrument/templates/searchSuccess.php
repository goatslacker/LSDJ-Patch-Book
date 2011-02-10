<?php use_helper('Global') ?>
 
<h1>instruments matching "<?php echo htmlspecialchars($sf_params->get('search')) ?>"</h1>

<?php foreach($instruments as $instrument): ?>
  <?php include_partial('instrument/instrument_list', array('instrument' => $instrument)) ?>
<?php endforeach ?>
 
<?php if ($sf_params->get('page') > 1 && !count($instruments)): ?>
  <div>There is no more result for your search.</div>
<?php elseif (!count($instruments)): ?>
  <div>Sorry, there are no instruments matching your search terms.</div>
<?php endif ?>
 
<?php if (count($instruments) == sfConfig::get('app_search_results_max')): ?>
  <div class="right">
    <?php echo link_to('more results &raquo;', '@search_instrument?search='.$sf_params->get('search').'&page='.($sf_params->get('page', 1) + 1)) ?>
  </div>
<?php endif ?>
