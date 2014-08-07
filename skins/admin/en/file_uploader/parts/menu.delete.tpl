{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * File uploader menu
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="file-uploader.menu", weight="100")
 *}

{if:hasFile()}
  <li role="presentation" class="divider"></li>
  <li role="presentation">
    <a role="menuitem" tabindex="-1" href="#" class="delete">
      <i class="button-icon fa fa-trash-o"></i>
      <span>{t(#Delete#)}</span>
    </a>
  </li>
  <li role="presentation" class="undelete">
    <a role="menuitem" tabindex="-1" href="#" class="delete">
      <div class="diagonal"></div>
      <i class="button-icon fa fa-trash-o"></i>
      <span>{t(#Undelete#)}</span>
    </a>
  </li>
{end:}
