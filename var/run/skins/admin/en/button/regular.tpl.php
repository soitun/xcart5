<button <?php echo $this->printTagAttributes($this->getAttributes()); ?>>
<?php if ($this->getParam('icon-style')){?>
  <i class="button-icon <?php echo func_htmlspecialchars($this->getParam('icon-style')); ?>"></i>
<?php }?>
  <span><?php echo func_htmlspecialchars($this->t($this->getButtonLabel())); ?></span>
</button>
