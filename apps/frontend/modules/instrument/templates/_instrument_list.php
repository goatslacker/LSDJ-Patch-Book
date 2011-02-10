<div class="home_instrument">
	<ul>
      <li><? echo $instrument->getLink() ?></li>
	  <li><? echo link_to($instrument->getType(),'@type?type='.$instrument->getType().'&page=1')?></li>
      <li><? echo link_to($instrument->getAuthor(),'@author?author='.$instrument->getAuthorStrip()) ?><!-- @ <?=$instrument->getUpdatedAt()?>--></li>
	</ul>
</div>
