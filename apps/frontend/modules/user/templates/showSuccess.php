<? echo include_partial('userHeader', array('subscriber' => $subscriber)) ?>
 
<h2>Authored</h2>

<div class="home_instrument">
<ul>
  <li><strong>Name</strong></li>
  <li><strong>Type</strong></li>
  <li><strong>Author</strong></li>
</ul>
</div>
<?php foreach ($authored_instruments as $instrument): ?>
  <? echo include_partial('instrument/instrument_list', array('instrument' => $instrument)) ?>
<?php endforeach; ?>

<h2>Submissions</h2>
 
<div class="home_instrument">
<ul>
  <li><strong>Name</strong></li>
  <li><strong>Type</strong></li>
  <li><strong>Author</strong></li>
</ul>
</div>
<?php foreach ($instruments as $instrument): ?>
  <? echo include_partial('instrument/instrument_list', array('instrument' => $instrument)) ?>
<?php endforeach; ?>
