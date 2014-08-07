<?php if ($this->get('module')->getPageURL()): ?><div class="module-url" >
  <a href="<?php echo func_htmlspecialchars($this->get('module')->getPageURL()); ?>" target="_blank" class="module-page-link form-external-link" data-store-url="<?php echo func_htmlspecialchars($this->getStoreURL()); ?>" data-email="<?php echo func_htmlspecialchars($this->getUserEmail()); ?>"><?php echo func_htmlspecialchars($this->t('Module page')); ?><i class="icon fa fa-external-link"></i></a>
</div><?php endif; ?>
