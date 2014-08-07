<div class="addons-filters">
  <div class="addons-search-box">

    <?php $this->getWidget(array('formMethod' => 'GET', 'className' => 'search-form'), '\XLite\View\Form\Module\ManageSearch', 'manage_search')->display(); ?>
      <div class="substring">
        <?php $this->getWidget(array('fieldOnly' => 'true', 'fieldName' => 'substring', 'value' => $this->getSubstring(), 'defaultValue' => $this->t('Search for modules')), '\XLite\View\FormField\Input\Text')->display(); ?>
        <?php $this->getWidget(array('label' => ''), '\XLite\View\Button\Submit')->display(); ?>
      </div>
    <?php $this->getWidget(array('end' => '1'), null, 'manage_search')->display(); ?>

  </div>
</div>
