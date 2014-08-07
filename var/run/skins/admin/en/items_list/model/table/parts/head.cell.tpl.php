<?php if ($this->getComplex('column.headTemplate')){?>
  <?php $this->getWidget(array('template' => $this->getComplex('column.headTemplate'), 'column' => $this->get('column')))->display(); ?>
<?php }else{ ?>
<?php if ($this->getComplex('column.sort')){?>
  <a
    href="<?php echo func_htmlspecialchars($this->buildURL($this->getTarget(),'',array('sortBy'=>$this->getComplex('column.sort'),'sortOrder'=>$this->getSortDirectionNext($this->get('column'))))); ?>"
    data-sort="<?php echo func_htmlspecialchars($this->getComplex('column.sort')); ?>"
    data-direction="<?php echo func_htmlspecialchars($this->getSortOrder()); ?>"
    class="<?php echo func_htmlspecialchars($this->getSortLinkClass($this->get('column'))); ?>"><?php echo func_htmlspecialchars($this->getComplex('column.name')); ?></a>
  <?php if ($this->isColumnSorted($this->get('column'))){?>
  <?php if ('desc'==$this->getSortOrder()): ?><span  class="dir desc-order">&uarr;</span><?php endif; ?>
  <?php if ('asc'==$this->getSortOrder()): ?><span  class="dir asc-order">&darr;</span><?php endif; ?>
  <?php }?>
<?php }else{ ?>
  <?php echo func_htmlspecialchars($this->getComplex('column.name')); ?>
<?php }?>
  <?php if ($this->getComplex('column.headHelp')): ?><div class="column-header-help" >
    <?php $this->getWidget(array('id' => 'menu-links-help-text', 'text' => $this->getComplex('column.headHelp'), 'isImageTag' => 'true', 'className' => 'help-small-icon'), '\XLite\View\Tooltip')->display(); ?>
  </div><?php endif; ?>
<?php }?>
<?php if ($this->getComplex('column.subheader')): ?><div  class="subheader"><?php echo func_htmlspecialchars($this->getComplex('column.subheader')); ?></div><?php endif; ?>
<?php $this->displayInheritedViewListContent($this->getCellListNamePart('head',$this->get('column')), array('column' => $this->get('column'))); ?>
<?php if ($this->getComplex('column.columnSelector')): ?><input  type="checkbox" class="selectAll not-significant" /><?php endif; ?>
