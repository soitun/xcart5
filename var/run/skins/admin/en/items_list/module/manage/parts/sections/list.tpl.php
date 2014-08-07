<?php $this->getWidget(array(), '\XLite\View\Form\Module\Manage', 'modules_manage_form')->display(); ?>
  <table cellspacing="0" cellpadding="0" class="data-table items-list modules-list">
    <?php $_foreach_var = $this->getPageData(); if (isset($_foreach_var)) { $this->moduleArraySize=count($_foreach_var); $this->moduleArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->idx => $this->module){ $this->moduleArrayPointer++; ?>
    <tr class="module-item module-<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?> module-<?php echo func_htmlspecialchars($this->get('module')->getName()); ?><?php if (!($this->get('module')->getEnabled())){?> disabled<?php }?>">
    <?php $this->displayInheritedViewListContent('columns', array('module' => $this->get('module'))); ?>
    </tr>
    <?php }?>
  </table>
  <div class="pager-bottom <?php echo func_htmlspecialchars($this->get('pager')->getCSSClasses()); ?>"><?php echo func_htmlspecialchars($this->get('pager')->display()); ?></div>
  <?php $this->getWidget(array(), 'XLite\View\StickyPanel\ItemsListForm')->display(); ?>
<?php $this->getWidget(array('end' => '1'), null, 'modules_manage_form')->display(); ?>
