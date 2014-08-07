<table class="list<?php if (!($this->hasResults())){?> list-no-items<?php }?>" cellspacing="0">

  <?php if ($this->isTableHeaderVisible()): ?><thead >
    <tr>
      <?php $column = isset($this->column) ? $this->column : null; $_foreach_var = $this->getColumns(); if (isset($_foreach_var)) { $this->columnArraySize=count($_foreach_var); $this->columnArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->column){ $this->columnArrayPointer++; ?><th  class="<?php echo func_htmlspecialchars($this->getHeadClass($this->get('column'))); ?>">
        <?php $this->display('items_list/model/table/parts/head.cell.tpl'); ?>
      </th>
<?php } $this->column = $column; ?>
    </tr>
  </thead><?php endif; ?>

  <?php if ($this->isHeadSearchVisible()): ?><tbody  class="head-search">
    <?php $this->display('items_list/model/table/parts/head_search.tpl'); ?>
  </tbody><?php endif; ?>

  <?php if ($this->isTopInlineCreation()): ?><tbody  class="create top-create">
    <?php $this->display('items_list/model/table/parts/create_box.tpl'); ?>
  </tbody><?php endif; ?>

  <tbody class="lines">
    <?php $_foreach_var = $this->getPageData(); if (isset($_foreach_var)) { $this->entityArraySize=count($_foreach_var); $this->entityArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->idx => $this->entity){ $this->entityArrayPointer++; ?>
      <tr class="<?php echo func_htmlspecialchars($this->getLineClass($this->get('idx'),$this->get('entity'))); ?>">
        <?php $column = isset($this->column) ? $this->column : null; $_foreach_var = $this->getColumns(); if (isset($_foreach_var)) { $this->columnArraySize=count($_foreach_var); $this->columnArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->column){ $this->columnArrayPointer++; ?><td  class="<?php echo func_htmlspecialchars($this->getColumnClass($this->get('column'),$this->get('entity'))); ?>">
          <div class="cell">
            <?php if ($this->isTemplateColumnVisible($this->get('column'),$this->get('entity'))):
  $this->getWidget(array('template' => $this->getComplex('column.template'), 'idx' => $this->get('idx'), 'entity' => $this->get('entity'), 'column' => $this->get('column'), 'editOnly' => $this->getComplex('column.editOnly')))->display();
endif; ?>
            <?php if ($this->isClassColumnVisible($this->get('column'),$this->get('entity'))):
  $this->getWidget(array('idx' => $this->get('idx'), 'entity' => $this->get('entity'), 'column' => $this->get('column'), 'itemsList' => $this->getSelf(), 'fieldName' => $this->getComplex('column.code'), 'fieldParams' => $this->getComplex('column.params'), 'editOnly' => $this->getComplex('column.editOnly')), $this->getComplex('column.class'))->display();
endif; ?>
            <?php $this->displayInheritedViewListContent($this->getCellListNamePart('cell',$this->get('column')), array('column' => $this->get('column'), 'entity' => $this->get('entity'))); ?>
          </div>
        </td>
<?php } $this->column = $column; ?>
      </tr>
      <?php $this->displayInheritedViewListContent('row', array('idx' => $this->get('idx'), 'entity' => $this->get('entity'))); ?>
    <?php }?>
  </tbody>

  <tbody class="no-items" <?php if ($this->hasResults()){?>style="display: none;"<?php }?>>
    <tr>
      <td colspan="<?php echo func_htmlspecialchars($this->getColumnsCount()); ?>"><?php $this->display($this->getEmptyListTemplate()); ?></td>
    </tr>
  </tbody>

  <?php if ($this->isBottomInlineCreation()): ?><tbody  class="create bottom-create">
    <?php $this->display('items_list/model/table/parts/create_box.tpl'); ?>
  </tbody><?php endif; ?>

</table>
