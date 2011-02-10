<div class="home_instrument">
<ul>
  <li><strong>Name</strong></li>
  <li><strong>Type</strong></li>
  <li><strong>Author</strong></li>
</ul>
</div>

<?php foreach($instrument_pager->getResults() as $instrument): ?>
  <? echo include_partial('instrument/instrument_list', array('instrument' => $instrument)) ?>
<?php endforeach ?>

<div id="pager">
  <?php echo pager_navigation($instrument_pager, $rule) ?>
</div>
