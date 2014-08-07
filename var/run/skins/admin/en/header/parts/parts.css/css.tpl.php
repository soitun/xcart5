<?php if (!($this->doCSSAggregation())){?>
<?php $file = isset($this->file) ? $this->file : null; $_foreach_var = $this->getCSSResources(); if (isset($_foreach_var)) { $this->fileArraySize=count($_foreach_var); $this->fileArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->file){ $this->fileArrayPointer++; ?><link  href="<?php echo func_htmlspecialchars($this->getResourceURL($this->getComplex('file.url'))); ?>" rel="stylesheet" type="text/css" media="<?php echo func_htmlspecialchars($this->getComplex('file.media')); ?>" />
<?php } $this->file = $file; ?>
<?php }?>
