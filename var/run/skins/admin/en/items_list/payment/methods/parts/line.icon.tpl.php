<?php if ($this->hasAdminIcon($this->get('method'))): ?><div  class="icon"><img src="<?php echo func_htmlspecialchars($this->get('method')->getAdminIconURL()); ?>" alt="" /></div><?php endif; ?>
