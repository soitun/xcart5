{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Customer's saved credit cards header
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="customer.account.add_new_card.address", weight="100")
 *}

<form method="post" action="cart.php?target=add_new_card" id="set_address">

  <input type="hidden" name="action" value="set_address">

  Address: 
  <select name="address" value="{getAddressId()}" id="address" style="width: 300px;">

    {foreach:getAddressesList(),address}
      {if:address.getAddressId()=getAddressId()}
        <option selected value="{address.getAddressId()}">
          {getAddressOption(address)}
        </option>
      {else:}
        <option value="{address.getAddressId()}">
          {getAddressOption(address)}
        </option>
      {end:}
    {end:}

  </select>


</form>

<br/>
