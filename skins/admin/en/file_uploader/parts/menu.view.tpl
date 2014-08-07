{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * File uploader menu
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="file-uploader.menu", weight="20")
 *}

{if:hasView()}
  <li role="presentation">
    <a role="menuitem" tabindex="-1" href="{object.getFrontURL()}" target="_blank">
      <i class="button-icon fa fa-picture-o"></i>
      <span>{t(#View image#)}</span>
    </a>
  </li>
  <li role="presentation" class="divider"></li>
{end:}
