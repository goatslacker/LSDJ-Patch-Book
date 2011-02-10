<?php use_helper('Global') ?>
<h1><?=$instruments[0]->getAuthor()?> <span><?php echo link_to_feed('User', 'feed/user?username='.$instruments[0]->getAuthor())?></span></h1>

<h2>Authored</h2>

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
