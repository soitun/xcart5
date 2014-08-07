<div class="<?php echo func_htmlspecialchars($this->getContainerClass()); ?>">
  <?php if ($this->hasSeparateView()): ?><div  class="view"><?php $this->display($this->getViewTemplate()); ?></div><?php endif; ?>
  <?php if ($this->isEditable()): ?><div  class="field"><?php $this->display($this->getFieldTemplate()); ?></div><?php endif; ?>
</div>
