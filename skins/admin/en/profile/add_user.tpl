{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add user button. Admin area.
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.profile.search.footer", weight="20")
 *}

<widget class="\XLite\View\Button\AddUser" label="{t(#Add user#)}" location="{buildURL(#profile#,##,_ARRAY_(#mode#^#register#))}" />
