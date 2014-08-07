{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Export begin section : settings : files setting
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="export.begin.options", weight="100")
 *}

<li class="files-option">
  <widget class="XLite\View\FormField\Select\ExportFiles" fieldName="options[files]" label="{t(#Export public files as#)}" value="{config.Export.files}" help="{t(#Choosing "URLs" will link the exported data to your public files (product and category images, downloadable files shown on product pages, and so on) through direct URLs#)}" />
</li>
