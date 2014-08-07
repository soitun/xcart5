<div class="dashboard <?php if ($this->isAdminWelcomeBlockVisible()){?>dashboard-visible<?php }else{ ?>dashboard-invisible<?php }?>">
  <?php $this->displayViewListContent('dashboard'); ?>
</div>
<?php $this->displayViewListContent('dashboard.footer'); ?>
