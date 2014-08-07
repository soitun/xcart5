{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{* :TODO: divide into parts *}
<form action="{buildURL()}" method="post" class="no-popup-ajax-submit">
  <input type="hidden" name="target" value="upgrade" />
  <input type="hidden" name="action" value="install_addon_force" />
  <widget class="\XLite\View\FormField\Input\FormId" />
  {foreach:getModuleIds(),id}
  <input type="hidden" name="moduleIds[]" value="{id}" />
  {end:}

  <div class="module-license">

    <div class="form">
      <div class="license-block">
        <table>
          <tr>
            <td class="license-text">
              <textarea class="license-area" id="license-area" readonly="readonly">{getLicense():h}</textarea>
            </td>
            <td class="switch-button">
          <widget class="\XLite\View\Button\SwitchButton" first="makeSmallHeight" second="makeLargeHeight" />
          </td>
          </tr>
        </table>
      </div>

      <table class="agree">
        <tr>
          <td>
            <label>
              <input type="checkbox" name="agree" value="Y" checked="checked" />
              {t(#Yes, I agree with License agreements#)}
            </label>
          </td>
        </tr>
      </table>

      <table class="install-addon">
        <tr>
          <td>
          <list name="install-addon.buttons" />
          </td>
        </tr>
      </table>
    </div>
  </div>

</form>
