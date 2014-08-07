{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Manage languages widget template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="languages">

  <widget class="\XLite\View\Form\Translations\Languages" name="languages_form" />
  <widget class="XLite\View\ItemsList\Model\Translation\Languages" />
  <widget name="languages_form" end />

  <div class="language-list-bottom">
    <list name="languages.bottom-list" />
  </div>

  <widget class="\XLite\View\Button\ImportLanguage" IF="isImportActive()" />

</div>
