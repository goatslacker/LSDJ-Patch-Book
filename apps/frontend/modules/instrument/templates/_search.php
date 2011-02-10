<?php echo form_tag('@search') ?>    
  <div style="float: left;"><?php echo input_tag('search', htmlspecialchars($sf_params->get('search')), array('style' => 'width: 200px')) ?></div>
  <div style="float: right;"><?php echo submit_tag('Search', 'class=small') ?></div>
</form>
