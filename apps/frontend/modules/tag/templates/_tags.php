<?php foreach($tags as $tag): ?>
  <li><?php echo link_to($tag, '@tag?tag='.$tag, 'rel=tag') ?></li>
<?php endforeach; ?>
