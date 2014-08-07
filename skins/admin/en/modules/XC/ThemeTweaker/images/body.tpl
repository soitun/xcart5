{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Images 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:getImages()}
<div class="items-list-table items-list">
  <table class="list" cellspacing="0">
    <thead>
      <tr>
        <th>{t(#Image#)}</th>
        <th>{t(#Path for using in custom CSS#)}</th>
        <th>{t(#URL#)}</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody class="lines">
      <tr FOREACH="getImages(),image" class="line">
        <td class="image"><a href="{getImageUrl(image)}" target="_blank"><img src="{getImageUrl(image)}" alt="" /></a></td>
        <td>images/{image}</td>
        <td>{getImageUrl(image)}</td>
        <td class="actions right">
          <div class="separator"></div>
          <div class="action">
            <widget class="XLite\View\Button\Remove" buttonName="delete[{image}]" />
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
{else:}
<div class="no-images">{t(#No images uploaded#)}</div>
{end:}
