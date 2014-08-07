<div id="topMenu">
  <ul id="menuOuter">
    <li class="root">
      <ul>
        <?php $_foreach_var = $this->getItems(); if (isset($_foreach_var)) { $this->itemArraySize=count($_foreach_var); $this->itemArrayPointer=0; } if (isset($_foreach_var)) foreach ($_foreach_var as $this->item){ $this->itemArrayPointer++; ?>
          <?php echo func_htmlspecialchars($this->get('item')->display()); ?>
        <?php }?>
        <?php $this->displayViewListContent('menus'); ?>
      </ul>
    </li>
  </ul>
</div>
