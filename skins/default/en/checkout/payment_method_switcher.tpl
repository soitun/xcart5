{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Payment methods details forms switcher
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<widget template="{cart.paymentMethod.formTemplate}" IF="cart.paymentMethod.formTemplate" />

<widget module="CDev\GoogleCheckout" template="modules/CDev/GoogleCheckout/google_checkout.tpl" IF="{cart.paymentMethod.payment_method=#google_checkout#}">
