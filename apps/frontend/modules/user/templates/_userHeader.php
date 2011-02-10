<?php use_helper('Global') ?>

<?php if ($subscriber->getAvatar()): ?>
  <img src="<?=$subscriber->getAvatar()?>" alt="<?=$subscriber?>" style="float: left" />
<?php endif ?>
<h1><? echo link_to($subscriber,'http://8bitcollective.com/members/'.$subscriber, array('style'=>'color: #000;')) ?> <span><?php echo link_to_feed('User', 'feed/user?username='.$subscriber)?></span></h1>
<h3><?=$subscriber->getLocation()?></h3>
<p><?=$subscriber->getDescription()?></p>

<br class="clearFloat" />
