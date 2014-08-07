{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Title
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.attachments.form", weight="100", zone="admin")
 *}
<tr class="title">
  <td class="label"><label for="attachmentName{attachment.getId()}">{t(#File title#)}</label></td>
  <td><input type="text" id="attachmentName{attachment.getId()}" name="data[{attachment.getId()}][title]" value="{attachment.getTitle()}" /></td>
</tr>
