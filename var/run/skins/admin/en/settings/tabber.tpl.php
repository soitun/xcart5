<?php if ($this->isDisplayRequired(array('settings'))):
  $this->getWidget(array('body' => $this->getPageTemplate(), 'switch' => 'page'), '\XLite\View\Tabber')->display();
endif; ?>
