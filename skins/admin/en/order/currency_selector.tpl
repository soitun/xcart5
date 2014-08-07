{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Currency selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="\XLite\View\Form\Order\CurrencySelector" name="selector" />

  <select name="currency" onchange="javascript: jQuery(this.form).submit();">
    <option FOREACH="getCurrencies(),c" value="{c.getCurrencyId():h}" selected="{isCurrencySelected(c)}">{c.getCode()}{if:c.getSymbol()} ({c.getSymbol():h}){end:}</option>
  </select>

<widget name="selector" end />
