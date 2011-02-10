<h1>Top Authors</h1>

<ol>
<?php foreach($popular as $author): ?>
  <li><?php echo link_to($author->getAuthor(),'@author?author='.$author->getAuthorStrip()) ?></li>
<?php endforeach ?>
</ol>
