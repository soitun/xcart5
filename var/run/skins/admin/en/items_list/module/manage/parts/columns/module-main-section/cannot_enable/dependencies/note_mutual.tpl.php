<?php if ($this->getEnabledMutualModules($this->get('module'))){?>
  <?php echo func_htmlspecialchars($this->t('The following add-on(s) must be disabled')); ?>:
<?php }?>
