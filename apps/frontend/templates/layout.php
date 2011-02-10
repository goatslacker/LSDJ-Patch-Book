<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php echo auto_discovery_link_tag('rss', 'feed/popular') ?>
<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />
</head>
<? use_helper('Global') ?>
<body>

<div id="container">
	<div id="header">
		<ul id="navigation">			
			<li <? echo ($sf_context->getActionName() == "list" && $sf_context->getModuleName() == "instrument")? 'class="active"':'' ?>>
			  <? echo link_to('Home', '/') ?> 
			</li>

			<li <? echo ($sf_context->getActionName() == "popular" && $sf_context->getModuleName() == "instrument")? 'class="active"':'' ?>>
			  <? echo link_to('Instruments', '@popular') ?>
			</li>

			<li <? echo ($sf_context->getActionName() == "list" && $sf_context->getModuleName() == "bank")? 'class="active"':''; ?>>
			  <? echo link_to('Banks', '/bank') ?>
			</li>

			<li <? echo ($sf_context->getActionName() == "popularAuthor" && $sf_context->getModuleName() == "user")? 'class="active"':'' ?>>
			  <? echo link_to('Authors', '@top_authors') ?>
			</li>
	
			<li <? echo ($sf_context->getActionName() == "popularUser" && $sf_context->getModuleName() == "user")? 'class="active"':'' ?>>
			  <? echo link_to('Contributors', '@top_users') ?>
			</li>
	
			<?php if ($sf_user->isAuthenticated()): ?>
			  <li><?php echo link_to('Logout', 'user/logout') ?></li>
			<?php else: ?>
			  <li <? echo ($sf_context->getActionName() == "login" && $sf_context->getModuleName() == "user")? 'class="active"':'' ?>>
				<?php echo link_to('Login', 'user/login') ?>
			  </li>
			<?php endif ?>
		</ul>
	</div>
	<div id="content">
		<div id="indicator" style="display: none"></div>
		<div id="search">
			<?php include_partial('instrument/search') ?>
		</div>

		<?php echo $sf_data->getRaw('sf_content') ?>
				
		<br class="clearFloat" />

		<hr />
		<? echo link_to('[+] New Instrument', 'instrument/create',array('class' => 'newInstrument')) ?>
		<div id="license"><a rel="license" href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons 3.0 Unported"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by/3.0/80x15.png" /></a></div>
		<br class="clearFloat" />
	</div>
</div>
</body>
</html>
