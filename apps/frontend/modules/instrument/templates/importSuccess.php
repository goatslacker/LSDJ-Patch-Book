<h1>Import SAV</h1>
<p>This tool uses <a href="http://www.goatslacker.com/lsdj2xml/">LSDJ2XML II</a>.</p>
    <?php echo form_tag('instrument/import', 'multipart=true') ?>
      <span><?php //echo form_error('file') ?></span><br />
      <?php echo input_file_tag('file',array('size'=>'12')) ?><br />
      <?php echo submit_tag('Import') ?>
    </form>
Data:
<? var_dump($xml); ?>
