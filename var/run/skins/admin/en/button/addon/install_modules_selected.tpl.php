<div class="modules-not-selected<?php if ($this->countModulesSelected()){?> hide-selected<?php }?>"><?php echo func_htmlspecialchars($this->t('Not selected')); ?></div>
<div class="modules-selected-box actions<?php if ($this->countModulesSelected()==0){?> hide-selected<?php }?>">
<div class="module-box clone">
  <div class="remove-action"><span class="info"></span></div>
  <span class="module-name"></span>
</div>
<?php $_foreach_var = $this->getModulesToInstall(); if (isset($_foreach_var)) { $this->moduleIdArraySize=count($_foreach_var); $this->moduleIdArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->moduleId){ $this->moduleIdArrayPointer++; ?>
<div class="always-enabled module-box" id="module-box-<?php echo func_htmlspecialchars($this->get('moduleId')); ?>">
  <div class="remove-action"><span class="info"><?php echo func_htmlspecialchars($this->get('moduleId')); ?></span></div>
  <span class="module-name"><?php echo func_htmlspecialchars($this->getModuleName($this->get('moduleId'))); ?></span>
</div>
<?php }?>
</div>
