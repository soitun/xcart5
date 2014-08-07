{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Checkout widget body
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="checkout-block">
  <list IF="isCheckoutAvailable()" name="checkout.main" />
  <list IF="!isCheckoutAvailable()" name="signin.main" />
</div>
