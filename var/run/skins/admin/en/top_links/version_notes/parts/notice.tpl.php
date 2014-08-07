<?php if ($this->isNoticeActive()): ?><li  class="notice">
  <?php $this->getWidget(array(), '\XLite\View\Button\ActivateKey')->display(); ?>
  <?php if ($this->isTrialNoticeAutoDisplay()):
  $this->getWidget(array(), '\XLite\View\Button\TrialNotice')->display();
endif; ?>
</li><?php endif; ?>
