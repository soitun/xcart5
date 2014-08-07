{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add offline method
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="payment.method.add.offline")
 *}

<widget class="XLite\View\Form\Payment\Method\Admin\AddOfflineMethod" name="add_offline_method" className="add-offline-method validationEngine" />

  <ul class="table">
    <li><widget class="XLite\View\FormField\Input\Text" fieldName="name" label="{t(#Name#)}" required="true" /></li>
    <li><widget class="XLite\View\FormField\Textarea\Simple" fieldName="instruction" label="{t(#Payment instructions#)}" help="{t(#These instructions will appear below the order invoice on the page which customers see after they confirm their order.#)}" /></li>
    <li><widget class="XLite\View\FormField\Textarea\Simple" fieldName="description" label="{t(#Description#)}" help="{t(#Here you can define how your payment methods will look in customer area.#)}" /></li>
  </ul>

  <widget class="XLite\View\Button\Submit" label="{t(#Add#)}" style="action" />

<widget name="add_offline_method" end />
