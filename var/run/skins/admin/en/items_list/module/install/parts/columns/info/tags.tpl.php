<?php if ($this->get('module')->getTags()): ?><div class="module-tags" >
<ul class="module-tags-list">
  <?php $value = isset($this->value) ? $this->value : null; $_foreach_var = $this->get('module')->getTags(); if (isset($_foreach_var)) { $this->valueArraySize=count($_foreach_var); $this->valueArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->value){ $this->valueArrayPointer++; ?><li >
    <a href="<?php echo func_htmlspecialchars($this->buildURL('addons_list_marketplace','',array('tag'=>$this->get('value')))); ?>"><?php echo func_htmlspecialchars($this->getTagName($this->get('value'))); ?><div class="circle"></div></a>
  </li>
<?php } $this->value = $value; ?>
</ul>
</div><?php endif; ?>
