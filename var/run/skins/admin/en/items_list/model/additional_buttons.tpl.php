<div class="additional-buttons">
<?php if ($this->isDisplayORLabel()): ?><span class="or" ><?php echo func_htmlspecialchars($this->t('or')); ?></span><?php endif; ?>
<div class="btn-group dropup">
<button type="button" class="btn regular-button toggle-list-action dropdown-toggle<?php if ($this->hasMoreActionsButtons()){?> more-actions<?php }?>" data-toggle="dropdown">
  <?php echo $this->getMoreActionsText(); ?>
  <span class="caret"></span>
  <span class="sr-only"></span>
</button>
<ul class="dropdown-menu" role="menu">
  <?php $_foreach_var = $this->getAdditionalButtons(); if (isset($_foreach_var)) { $this->buttonArraySize=count($_foreach_var); $this->buttonArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->i => $this->button){ $this->buttonArrayPointer++; ?>
  <?php if (!($this->get('button')->isDivider())): ?><li  class="<?php echo func_htmlspecialchars($this->getSubcellClass($this->get('buttonArrayPointer'),$this->get('i'),$this->get('button'))); ?>"><?php echo $this->get('button')->display(); ?></li><?php endif; ?>
  <?php if ($this->get('button')->isDivider()): ?><li  class="divider"></li><?php endif; ?>
  <?php }?>
</ul>
</div>
</div>
