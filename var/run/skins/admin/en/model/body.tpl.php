<?php if ($this->getTopInlineJSCode()): ?><script  type="text/javascript"><?php echo str_replace('"', '&quot;',$this->getTopInlineJSCode()); ?></script><?php endif; ?>
<?php $this->display($this->getDir().'/header.tpl'); ?>

  <?php $this->getWidget(array(), $this->getFormClass(), $this->getFormName())->display(); ?>

    <div class="<?php echo func_htmlspecialchars($this->getContainerClass()); ?>">
      <?php $this->display($this->getDir().'/form_content.tpl'); ?>
      <?php if (!($this->useButtonPanel())):
  $this->display($this->getDir().'/'.$this->getFormTemplate('buttons'));
endif; ?>   
      <?php if ($this->useButtonPanel()):
  $this->getWidget(array(), $this->getButtonPanelClass())->display();
endif; ?>
    </div>

  <?php $this->getWidget(array('end' => '1'), null, $this->getFormName())->display(); ?>

<?php $this->display($this->getDir().'/footer.tpl'); ?>

<?php if ($this->getBottomInlineJSCode()): ?><script  type="text/javascript"><?php echo str_replace('"', '&quot;',$this->getBottomInlineJSCode()); ?></script><?php endif; ?>
