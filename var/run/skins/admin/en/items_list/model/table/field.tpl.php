<div class="plain-value">
  <?php if ($this->isLink($this->get('column'),$this->get('entity'))): ?><span  class="value">
    <a
      href="<?php echo func_htmlspecialchars($this->buildEntityURL($this->get('entity'),$this->get('column'))); ?>"
      <?php if ($this->getComplex('column.noWrap')){?> title="<?php echo func_htmlspecialchars($this->getColumnValue($this->get('column'),$this->get('entity'))); ?>"<?php }?>
      class="link"><?php echo func_htmlspecialchars($this->getColumnValue($this->get('column'),$this->get('entity'))); ?>
    </a>
  </span><?php endif; ?>
  <?php if (!($this->isLink($this->get('column'),$this->get('entity')))): ?><span  class="value"><?php echo $this->getColumnValue($this->get('column'),$this->get('entity')); ?></span><?php endif; ?>
  <?php if ($this->getComplex('column.noWrap')): ?><img  src="skins/admin/en/images/spacer.gif" class="right-fade" alt="" /><?php endif; ?>
</div>
