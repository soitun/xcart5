{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Common pager
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
 
<ul IF="isPagerVisible()" class="pagination">

  <li class="{getBorderLinkClassName(#first#)}">
    <a href="{buildURLByPageId(getPageIdByNotation(#first#))}" class="{getLinkClassName(#first#)}"><img src="images/spacer.gif" alt="First" /></a>
  </li>
  <li class="{getBorderLinkClassName(#previous#)}">
    <a href="{buildURLByPageId(getPageIdByNotation(#previous#))}" class="{getLinkClassName(#previous#)}"><img src="images/spacer.gif" alt="Previous" /></a>
  </li>

  <li FOREACH="getPageURLs(),num,pageURL" class="{getPageClassName(num)}">
    <a href="{pageURL}" class="{getLinkClassName(num)}">{inc(num)}</a>
  </li>

  <li class="{getBorderLinkClassName(#next#)}">
    <a href="{buildURLByPageId(getPageIdByNotation(#next#))}" class="{getLinkClassName(#next#)}"><img src="images/spacer.gif" alt="Next" /></a>
  </li>
  <li class="{getBorderLinkClassName(#last#)}">
    <a href="{buildURLByPageId(getPageIdByNotation(#last#))}" class="{getLinkClassName(#last#)}"><img src="images/spacer.gif" alt="Last" /></a>
  </li>

</ul>
