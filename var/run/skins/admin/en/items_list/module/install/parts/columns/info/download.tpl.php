<?php if ($this->get('module')->getDownloads()): ?><li class="downloads-counter<?php echo func_htmlspecialchars($this->getDownloadsCSSClass($this->get('module'))); ?>" >
  <?php echo func_htmlspecialchars($this->t('Popularity')); ?>: <span class="counter"><?php echo func_htmlspecialchars($this->get('module')->getDownloads()); ?></span>
</li><?php endif; ?>
