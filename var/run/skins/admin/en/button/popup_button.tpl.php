<button type="button" class="<?php echo func_htmlspecialchars($this->getClass()); ?>">
  <?php echo func_htmlspecialchars($this->displayCommentedData($this->getURLParams())); ?>
<?php if ($this->getParam('icon-style')){?>
  <i class="button-icon <?php echo func_htmlspecialchars($this->getParam('icon-style')); ?>"></i>
<?php }?>
  <span><?php echo func_htmlspecialchars($this->t($this->getButtonContent())); ?></span>
</button>
