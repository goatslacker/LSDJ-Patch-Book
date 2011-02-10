<h1>Top Contributors</h1>

<ol>
<?php foreach($popular as $user): ?>
  <li><?php echo link_to($user->getUsername(),'@user?username='.$user->getStripped()) ?></li>
<?php endforeach ?>
</ol>
