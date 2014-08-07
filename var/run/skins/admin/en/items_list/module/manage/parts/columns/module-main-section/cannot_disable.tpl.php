<?php if (!($this->get('module')->canDisable())): ?><div  class="note dependencies">

  <?php echo func_htmlspecialchars($this->t('Can\'t be disabled. The module is required by:')); ?>

  <ul>
    <?php $depend = isset($this->depend) ? $this->depend : null; $_foreach_var = $this->get('module')->getDependentModules(); if (isset($_foreach_var)) { $this->dependArraySize=count($_foreach_var); $this->dependArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->depend){ $this->dependArrayPointer++; ?><li >
      <a href="#<?php echo func_htmlspecialchars($this->get('depend')->getName()); ?>"><?php echo func_htmlspecialchars($this->get('depend')->getModuleName()); ?> (<?php echo func_htmlspecialchars($this->t('by')); ?> <?php echo func_htmlspecialchars($this->get('depend')->getAuthorName()); ?>)</a>
    </li>
<?php } $this->depend = $depend; ?>
  </ul>

</div><?php endif; ?>
