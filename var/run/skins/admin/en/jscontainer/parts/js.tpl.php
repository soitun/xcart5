<?php if (!($this->doJSAggregation())){?>
<?php $file = isset($this->file) ? $this->file : null; $_foreach_var = $this->getJSResources(); if (isset($_foreach_var)) { $this->fileArraySize=count($_foreach_var); $this->fileArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->file){ $this->fileArrayPointer++; ?><script  type="text/javascript" src="<?php echo func_htmlspecialchars($this->getResourceURL($this->getComplex('file.url'))); ?>"></script>
<?php } $this->file = $file; ?>
<?php }?>
