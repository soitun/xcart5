<div class="addon-icon">
  <?php if ($this->get('module')->hasIcon()): ?><img  src="<?php echo func_htmlspecialchars($this->get('module')->getIconURL()); ?>" class="addon-icon" alt="<?php echo func_htmlspecialchars($this->get('module')->getModuleName()); ?>" /><?php endif; ?>
  <?php if (!($this->get('module')->hasIcon())): ?><img  src="skins/admin/en/images/spacer.gif" class="addon-icon addon-default-icon" alt="<?php echo func_htmlspecialchars($this->get('module')->getModuleName()); ?>" /><?php endif; ?>
</div>
