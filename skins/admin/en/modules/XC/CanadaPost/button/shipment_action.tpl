{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipment action button template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<button type="button" class="{getClass()}"{if:getId()} id="{getId()}"{end:}{if:isDisabled()} disabled="disabled"{end:}>
  {displayCommentedData(getJSParams())}
  <span>{t(getButtonLabel())}</span>
</button>
