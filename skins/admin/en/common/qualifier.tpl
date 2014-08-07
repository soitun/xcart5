{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<select name="text_qualifier">
    <option value="double_quote" selected="{text_qualifier=#double_quote#}">{t(#Double quote#)}</option>
    <option value="single_quote" selected="{text_qualifier=#single_quote#}">{t(#Single quote#)}</option>
    <option value="" selected="{action&text_qualifier=##}">- {t(#empty#)} -</option>
</select>
