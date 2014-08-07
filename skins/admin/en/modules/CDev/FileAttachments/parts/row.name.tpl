{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Name
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.attachments.row", weight="400", zone="admin")
 *}
<a class="name" href="{attachment.storage.getAdminGetterURL()}">{attachment.storage.getFileName()}</a>
<span IF="attachment.storage.getSize()" class="size">({formatSize(attachment.storage.getSize())})</span>
