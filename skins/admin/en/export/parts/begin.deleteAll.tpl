{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Export completed section : files
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="export.completed.content", weight="50")
 *}

<div class="delete-all" IF="!isCompletedSection()">
  <a href="{buildURL(#export#,#deleteFiles#)}"><i class="icon-trash"></i> <span>{t(#Delete all files#)}</span></a>
</div>
