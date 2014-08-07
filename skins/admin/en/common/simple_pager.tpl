{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Simple pager
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<form class="simple-pager" action="{getParam(#url#)}" method="get" name="simple_pager_form">
  <widget class="\XLite\View\FormField\Input\FormId" />
  {t(#Pages#)}:
  <a IF="isPrevPage()" href="{getPrevURL()}" class="arrow previous"><img src="images/spacer.gif" alt="" /></a>
  <input type="text" name="page" value="{getParam(#page#)}" />
  <a IF="isNextPage()" href="{getNextURL()}" class="arrow next"><img src="images/spacer.gif" alt="" /></a>
  {t(#of#)}
  <a href="{getLastURL()}" class="total">{getParam(#pages#)}</a>
</form>
