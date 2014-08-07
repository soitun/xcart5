<script type="text/javascript">
  depends[<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>] = [];
  <?php $_foreach_var = $this->get('module')->getDependencyModules(); if (isset($_foreach_var)) { $this->mArraySize=count($_foreach_var); $this->mArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->k => $this->m){ $this->mArrayPointer++; ?>
    <?php if ($this->get('m')->getEnabled()){?>
      depends[<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>]['<?php echo func_htmlspecialchars($this->get('k')); ?>'] = '<?php echo func_htmlspecialchars($this->get('m')->getModuleName()); ?> (<?php echo func_htmlspecialchars($this->t('by')); ?> <?php echo func_htmlspecialchars($this->get('m')->getAuthorName()); ?>)';
    <?php }?>
  <?php }?>
</script>
