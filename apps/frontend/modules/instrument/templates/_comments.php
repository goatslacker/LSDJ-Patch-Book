<? $class = ""; ?>
<? if ($comments) { ?>
<h2>Comments</h2>

<ul id="comments">
<?php foreach($comments as $comment): ?>
  <? $class = ($class == "")? " class='alt'":""; ?>
  <li<?=$class?>>
	<?php echo link_to($comment->getAuthor(), '@user?username='.$comment->getAuthor()) ?>
	(<?php echo date('m-d-y',strtotime($comment->getCreatedAt())); ?>) :
	<?php echo $comment->getComment(); ?>
  </li>
<?php endforeach; ?>
</ul>
<? } ?>
