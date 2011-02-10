<div id="form-wrapper">
<?php echo form_tag('user/login') ?>
<div id="login-form">
<?php use_helper('Validation') ?>
 	<table>
		<tr>
			<td></td>
			<td colspan="2"><?php echo form_error('username') ?></td>
		</tr>
		<tr>
			<td><label for="username">Username:</label></td>
			<td><?php echo input_tag('username', $sf_params->get('username')) ?></td>
		</tr>
		<tr>
			<td></td>
			<td><?php echo form_error('password') ?></td>
		</tr>
		<tr>
			<td><label for="password">Password:</label></td>
			<td><?php echo input_password_tag('password') ?></td>
		</tr>
	</table>

</div>
 
  <?php echo input_hidden_tag('referer', $sf_request->getReferer()) ?>
  <div class="submit"><?php echo submit_tag('Login') ?></div>
</form>
</div>

<div id="eightbc-connect">
	<h1>8bc Connect</h1>
	<p>In order to use this application you will need an account at <a href="http://www.8bitcollective.com">8bitcollective.com</a>. Registration is free and grants you access to the Patch Book and the 8bitcollective community; <a href="http://www.8bitcollective.com/register.php">Click here</a> to register.</p>
</div>
