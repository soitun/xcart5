<?php if ($this->hasResults()): ?><div  class="widget items-list widgetclass-<?php echo func_htmlspecialchars($this->getWidgetClass()); ?> widgettarget-<?php echo func_htmlspecialchars($this->getWidgetTarget()); ?> sessioncell-<?php echo func_htmlspecialchars($this->getSessionCell()); ?>">

  <?php echo func_htmlspecialchars($this->displayCommentedData($this->getItemsListParams())); ?>

  <?php if ($this->get('pager')->isVisible()): ?><div  class="table-pager pager-top <?php echo func_htmlspecialchars($this->get('pager')->getCSSClasses()); ?>"><?php echo func_htmlspecialchars($this->get('pager')->display()); ?></div><?php endif; ?>

  <?php if ($this->isHeaderVisible()): ?><div  class="list-header"><?php $this->displayInheritedViewListContent('header'); ?></div><?php endif; ?>

  <?php $this->display($this->getPageBodyTemplate()); ?>

  <?php if ($this->get('pager')->isVisibleBottom()): ?><div  class="table-pager pager-bottom <?php echo func_htmlspecialchars($this->get('pager')->getCSSClasses()); ?>"><?php echo func_htmlspecialchars($this->get('pager')->display()); ?></div><?php endif; ?>

  <?php if ($this->isFooterVisible()): ?><div  class="list-footer"><?php $this->displayInheritedViewListContent('footer'); ?></div><?php endif; ?>

</div><?php endif; ?>

<?php if ($this->isEmptyListTemplateVisible()):
  $this->display($this->getEmptyListTemplate());
endif; ?>
