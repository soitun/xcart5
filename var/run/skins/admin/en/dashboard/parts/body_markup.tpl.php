<div class="center-block">
  <?php $this->displayViewListContent('dashboard-center'); ?>
</div>

<div class="sidebar <?php if ($this->isAdminWelcomeBlockVisible()){?>admin-welcome-indent<?php }?>">
  <?php $this->displayViewListContent('dashboard-sidebar'); ?>
</div>

<div class="clear"></div>
