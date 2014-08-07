<a name="<?php echo func_htmlspecialchars($this->getAnchorName()); ?>" class="list-anchor"></a>
<div <?php echo $this->getContainerAttributesAsString(); ?>>
  <?php echo func_htmlspecialchars($this->displayCommentedData($this->getItemsListParams())); ?>
  <?php if ($this->isHeaderVisible()): ?><div  class="list-header">
    <?php $tpl = isset($this->tpl) ? $this->tpl : null; $_foreach_var = $this->getTopActions(); if (isset($_foreach_var)) { $this->tplArraySize=count($_foreach_var); $this->tplArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->tpl){ $this->tplArrayPointer++; ?><div  class="button-container"><?php $this->display($this->get('tpl')); ?></div>
<?php } $this->tpl = $tpl; ?>
    <?php $this->displayInheritedViewListContent('header'); ?>
  </div><?php endif; ?>

  <?php if ($this->isPageBodyVisible()):
  $this->display($this->getPageBodyTemplate());
endif; ?>
  <?php if (!($this->isPageBodyVisible())): ?><div  class="no-items">
    <?php $this->display($this->getEmptyListTemplate()); ?>
  </div><?php endif; ?>
  <?php if ($this->isPagerVisible()): ?><div  class="table-pager"><?php echo func_htmlspecialchars($this->get('pager')->display()); ?></div><?php endif; ?>

  <?php if ($this->isFooterVisible()): ?><div  class="list-footer">
    <?php $tpl = isset($this->tpl) ? $this->tpl : null; $_foreach_var = $this->getBottomActions(); if (isset($_foreach_var)) { $this->tplArraySize=count($_foreach_var); $this->tplArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->tpl){ $this->tplArrayPointer++; ?><div  class="button-container"><?php $this->display($this->get('tpl')); ?></div>
<?php } $this->tpl = $tpl; ?>
    <?php $this->displayInheritedViewListContent('footer'); ?>
  </div><?php endif; ?>

</div>

<?php if ($this->isPanelVisible()):
  $this->getWidget(array(), $this->getPanelClass())->display();
endif; ?>
