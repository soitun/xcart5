<?php if ($this->get('head')): ?><h2 ><?php echo func_htmlspecialchars($this->t($this->get('head'))); ?></h2><?php endif; ?>

<div class="<?php echo func_htmlspecialchars($this->getDialogCSSClass()); ?>">
  <?php $this->display($this->get('body')); ?>
</div>
