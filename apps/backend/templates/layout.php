<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

<div id="container">
    <div id="header">
        <ul id="navigation">
<li><?php echo link_to('Home','../') ?></li>
<li><?php echo link_to('Instrument','/instrument') ?></li>
<li><?php echo link_to('Bank','/bank') ?></li>
<li><?php echo link_to('Comment','/comment') ?></li>
<li><?php echo link_to('Tags','/tags') ?></li>
<li><?php echo link_to('User','/user') ?></li>
</ul>
</div>

<?php echo $sf_data->getRaw('sf_content') ?>
</div>
</body>
</html>
