{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Skripp register note
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="payment.methods.body", zone="admin", weight="150")
 *}
<p IF="!config.CDev.Moneybookers.email" class="mb-register-note">{t(#To process your customers' payments with Skrill, you need a Skrill account. If you do not have one yet, you can sign up for free at http://www.skrill.com#):h}</p>
