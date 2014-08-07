<?php $data = isset($this->data) ? $this->data : null; $_foreach_var = $this->getFormFieldsForDisplay(); if (isset($_foreach_var)) { $this->dataArraySize=count($_foreach_var); $this->dataArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->section => $this->data){ $this->dataArrayPointer++; ?><div  class="section <?php echo func_htmlspecialchars($this->get('section')); ?>-section">
  <?php if ($this->isShowSectionHeader($this->get('section'))): ?><div class="header <?php echo func_htmlspecialchars($this->get('section')); ?>-header" ><?php echo func_htmlspecialchars($this->getComplex('data.sectionParamWidget')->display()); ?></div><?php endif; ?>
  <ul class="table <?php echo func_htmlspecialchars($this->get('section')); ?>-table">
    <?php $field = isset($this->field) ? $this->field : null; $_foreach_var = $this->getComplex('data.sectionParamFields'); if (isset($_foreach_var)) { $this->fieldArraySize=count($_foreach_var); $this->fieldArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->field){ $this->fieldArrayPointer++; ?><li  class="<?php echo func_htmlspecialchars($this->getItemClass($this->get('fieldArrayPointer'),$this->get('fieldArraySize'),$this->get('field'))); ?>">
      <?php echo func_htmlspecialchars($this->get('field')->display()); ?>
      <?php echo func_htmlspecialchars($this->displayViewSubList('field',array('section'=>$this->get('section'),'field'=>$this->get('field')))); ?>
    </li>
<?php } $this->field = $field; ?>
  </ul>
</div>
<?php } $this->data = $data; ?>
