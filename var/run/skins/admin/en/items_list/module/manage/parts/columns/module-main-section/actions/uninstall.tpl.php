<a class="uninstall fa fa-trash-o"
  href="<?php echo func_htmlspecialchars($this->buildURL('addons_list_installed','uninstall',array('moduleId'=>$this->get('module')->getModuleId(),\XLite::FORM_ID=>\XLite::getFormId()))); ?>"
  onclick="javascript: return confirm(confirmNote('uninstall', '<?php echo func_htmlspecialchars($this->get('module')->getModuleId()); ?>'));"></a>
