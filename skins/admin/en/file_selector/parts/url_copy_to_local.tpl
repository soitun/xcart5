{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="file_select_dialog.file_selections", weight="700")
 *}

<li class="url-copy-to-local input-field">
  <label for="url-copy-to-local">
    <widget
      class="\XLite\View\FormField\Input\Checkbox"
      value="Y"
      isChecked="false"
      attributes={_ARRAY_(#disabled#^#disabled#)}
      fieldName="url_copy_to_local"
      fieldOnly="true" />
    <span class="label">{t(#Copy file to local server#)}</span>
  </label>
</li>
