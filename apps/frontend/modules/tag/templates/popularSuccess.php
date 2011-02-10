<h1>popular tags</h1>
 
<ul id="tag_cloud">
  <?php foreach($tags as $tag => $count): ?>
  <li class="weight_<?php echo $count ?>"><?php echo link_to($tag, '@tag?tag='.$tag, 'rel=tag') ?></li>
  <?php endforeach; ?>
</ul>
