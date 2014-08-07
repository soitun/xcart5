<?php if ($this->isSeparateConfigureButtonVisible($this->get('method'))):
  $this->getWidget(array('label' => $this->t('Configure'), 'location' => $this->get('method')->getConfigurationURL(), 'style' => 'configure'), 'XLite\View\Button\Link')->display();
endif; ?>
