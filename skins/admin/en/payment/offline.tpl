{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Offline method common configuration page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<ul class="table">
  <li><widget class="XLite\View\FormField\Input\Text" fieldName="properties[name]" label="{t(#Service name#)}" required="true" value="{paymentMethod.getName()}" /></li>
  <li><widget class="XLite\View\FormField\Input\Text" fieldName="properties[title]" label="{t(#Title#)}" required="true" value="{paymentMethod.getTitle()}" help="{t(#Here you can define how your payment methods will look in customer area.#)}" /></li>
  <li><widget class="XLite\View\FormField\Textarea\Simple" fieldName="properties[instruction]" label="{t(#Payment instructions#)}" value="{paymentMethod.getInstruction()}" help="{t(#These instructions will appear below the order invoice on the page which customers see after they confirm their order.#)}" /></li>
  <li><widget class="XLite\View\FormField\Textarea\Simple" fieldName="properties[description]" label="{t(#Description#)}" value="{paymentMethod.getDescription()}" help="{t(#Here you can define how your payment methods will look in customer area.#)}" /></li>
</ul>
