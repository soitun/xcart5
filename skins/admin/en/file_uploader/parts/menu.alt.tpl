{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * File uploader menu
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="file-uploader.menu", weight="50")
 *}

{if:hasAlt()}
  <li role="presentation" class="divider"></li>
  <li role="presentation" class="alt-text">
    <div class="value">
      <b>{t(#Alt#)}:</b>
      <span>{object.alt}</span>
      <div class="right-fade"></div>
    </div>
    <div class="input-group input-group-sm">
      <span class="input-group-addon">{t(#Alt#)}:</span>
      <input type="text" name="{getName()}[alt]" value="{object.alt}" class="form-control input-alt" />
    </div>
  </li>
{end:}
