<?php if (!$sf_user->isAuthenticated()): ?>
  <h1>Login</h1> 
  <?php echo include_partial('login') ?>
<?php else : ?>
  <h1>You're already logged in. o_0</h1>
<?php endif ?>
