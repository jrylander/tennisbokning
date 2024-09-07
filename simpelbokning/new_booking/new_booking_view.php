<form method="post" action="<?php admin_url( 'admin-post.php' ); ?>">
  <input type="hidden" name="action" value="process_form" />
  <p><?='datum'?>
  <p>
  <label for="name"><?=__('Name', 'simpelbokning')?>:</label> <input type="text" name="name" id="name" />
  <label for="email"><?=__('Email', 'simpelbokning')?>:</label><input type="text" name="email" id="email" />
  <input type="submit" name="submit" value="<?=__('Submit', 'simpelbokning')?> />
</form>
