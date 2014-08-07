{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Field : button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="customer.signin.fields", weight="400")
 * @ListChild (list="customer.signin.popup.fields", weight="400")
 *}

<tr>
    <td>&nbsp;</td>
    <td>
        <widget class="\XLite\View\Button\Submit" label="{t(#Sign in#)}" />
        <list name="customer.signin.popup.links" />
    </td>
</tr>

