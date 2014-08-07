{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Create return :: form :: products :: column :: name
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="capost_create_return.form.columns", weight="20")
 *}

<a IF="!item.isDeleted()" href="{item.getURL()}">{item.getName()}</a>
<span IF="item.isDeleted()">{item.getName()}</span>
