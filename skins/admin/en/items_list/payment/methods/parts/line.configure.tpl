{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Payment methods list : line : configure button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="payment.methods.list.line", weight=300)
 *}

<widget IF="isSeparateConfigureButtonVisible(method)" class="XLite\View\Button\Link" label="{t(#Configure#)}" location="{method.getConfigurationURL()}" style="configure"/>
