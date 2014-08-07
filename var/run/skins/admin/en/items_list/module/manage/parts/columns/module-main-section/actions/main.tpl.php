<?php if ($this->get('module')->getEnabled()): ?><span class="disable" >
  <input type="hidden" name="switch[<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>][old]" value="1" />
  
  <?php if (!($this->get('module')->canDisable())): ?><input  type="hidden" name="switch[<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>][new]" value="1" /><?php endif; ?>
  <label for="switch<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>">
  <input
    type="checkbox"
    name="switch[<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>][new]"
    <?php if (!($this->get('module')->canDisable())){?> disabled="disabled"<?php }?>
    checked="checked"
    id="switch<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>" />
  <?php echo func_htmlspecialchars($this->t('Enabled')); ?></label>
</span><?php endif; ?>

<?php if (!($this->get('module')->getEnabled())): ?><span class="enable" >
  <input type="hidden" name="switch[<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>][old]" value="0" />
  <label for="switch<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>">
  <input
    type="checkbox"
    name="switch[<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>][new]"
    <?php if (!($this->getParam('canEnable'))){?> disabled="disabled"<?php }?>
    id="switch<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>" />
  <?php echo func_htmlspecialchars($this->t('Enabled')); ?></label>
</span><?php endif; ?>
