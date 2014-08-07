<?php $this->displayViewListContent('modules-manage.top-controls'); ?>
<?php if ($this->isDisplayRequired(array('addons_list_installed'))):
  $this->getWidget(array(), '\XLite\View\ItemsList\Module\Manage')->display();
endif; ?>
