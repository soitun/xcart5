<label for="install-<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>" class="install-module-button">
  <input
    id="install-<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>"
    type="checkbox"
    data="<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>"
    name="selectToInstall[<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>]"
    <?php if ($this->isModuleSelected($this->get('module')->getModuleId())){?>checked="checked"<?php }?>
    class="install-module-action" />
  <?php echo func_htmlspecialchars($this->t('Install')); ?>
</label>
