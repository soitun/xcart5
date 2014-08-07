<?php if ($this->canPurchase($this->get('module'))):
  $this->getWidget(array('moduleObj' => $this->get('module'), 'style' => 'main-button'), '\XLite\View\Button\Addon\Purchase')->display();
endif; ?>

<?php if ($this->canPurchase($this->get('module'))): ?><div  class="or-activate"><?php echo func_htmlspecialchars($this->t('or')); ?><?php $this->getWidget(array('label' => 'Activate key'), '\XLite\View\Button\ActivateKey')->display(); ?></div><?php endif; ?>
