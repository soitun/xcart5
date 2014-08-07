<button
  type="button"
  <?php echo $this->getJSCode(); ?>
  class="<?php echo func_htmlspecialchars($this->getClass()); ?>">
  <span><?php echo func_htmlspecialchars($this->t($this->getButtonLabel())); ?></span>
</button>
