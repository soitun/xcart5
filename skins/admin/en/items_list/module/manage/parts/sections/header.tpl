{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="modules-manage.top-controls", weight="100")
 *}

<div class="addons-filters">
  <div class="addons-search-box">

    <widget class="\XLite\View\Form\Module\ManageSearch" formMethod="GET" className="search-form" name="manage_search" />
      <div class="substring">
        <widget
          class="\XLite\View\FormField\Input\Text"
          fieldOnly=true
          fieldName="substring"
          value="{getSubstring()}"
          defaultValue="{t(#Search for modules#)}" />
        <widget class="\XLite\View\Button\Submit" label="" />
      </div>
    <widget name="manage_search" end />

  </div>
</div>
