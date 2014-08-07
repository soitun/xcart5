<?php if ($this->isVisibleAddonFilters()): ?><div  class="addons-filters">

  <div class="addons-selectors">

  <form name="addons-filter" method="GET" action="<?php echo func_htmlspecialchars($this->buildURL()); ?>">
  <?php $this->getWidget(array(), '\XLite\View\FormField\Input\FormId')->display(); ?>
  <?php $value = isset($this->value) ? $this->value : null; $_foreach_var = $this->getURLParams(); if (isset($_foreach_var)) { $this->valueArraySize=count($_foreach_var); $this->valueArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->name => $this->value){ $this->valueArrayPointer++; ?><input  type="hidden" name="<?php echo func_htmlspecialchars($this->get('name')); ?>" value="<?php echo func_htmlspecialchars($this->get('value')); ?>" />
<?php } $this->value = $value; ?>

  <div class="addons-sort-box combine-selector">
    <?php $this->getWidget(array('fieldId' => 'addons-sort', 'fieldName' => 'addonsSort', 'disableSearch' => 'true', 'options' => $this->getSortOptionsForSelector(), 'value' => $this->getSortOptionsValueForSelector(), 'attributes' => array('data-classes'=>'addons-sort','data-height'=>'100%'), 'label' => $this->t('Sort by')), '\XLite\View\FormField\Select\AddonsSort')->display(); ?>
  </div>

  <div class="tag-filter-box combine-selector">
    <?php $this->getWidget(array('fieldId' => 'tag-filter', 'fieldName' => 'tag', 'options' => $this->getTagOptionsForSelector(), 'value' => $this->getTagOptionsValueForSelector(), 'attributes' => array('data-classes'=>'tag-filter','data-height'=>'100%'), 'label' => $this->t('Tags')), '\XLite\View\FormField\Select\AddonsSort')->display(); ?>
  </div>

  </form>

  </div>

  <?php $this->displayViewListContent('marketplace.addons-filters'); ?>

  <div class="clear"></div>

</div><?php endif; ?>
