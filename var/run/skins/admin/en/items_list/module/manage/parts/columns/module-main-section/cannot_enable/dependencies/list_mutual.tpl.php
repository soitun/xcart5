<?php if ($this->getEnabledMutualModules($this->get('module'))): ?><ul >
  <?php $depend = isset($this->depend) ? $this->depend : null; $_foreach_var = $this->getEnabledMutualModules($this->get('module')); if (isset($_foreach_var)) { $this->dependArraySize=count($_foreach_var); $this->dependArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->depend){ $this->dependArrayPointer++; ?><li >
    <?php $this->displayNestedViewListContent('details', array('depend' => $this->get('depend'))); ?>
  </li>
<?php } $this->depend = $depend; ?>
</ul><?php endif; ?>
