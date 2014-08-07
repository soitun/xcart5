<?php if ($this->get('module')->getAuthorEmail()): ?><div class="author" >
  <span><?php echo func_htmlspecialchars($this->t('Support')); ?>:</span>
  <a href="mailto:<?php echo func_htmlspecialchars($this->get('module')->getAuthorEmail()); ?>"><?php echo func_htmlspecialchars($this->get('module')->getAuthorEmail()); ?></a>
</div><?php endif; ?>
