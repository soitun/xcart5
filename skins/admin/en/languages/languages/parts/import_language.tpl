{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Import language button widget template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="languages.add-language", weight="300")
 *}

<div class="or">{t(#or#)}</div>

<widget class="\XLite\View\Button\FileSelector" label="Import language from CSV file" object="language" fileObject="file" />

<widget class="\XLite\View\Button\ImportLanguage" IF="isImportActive()" />
