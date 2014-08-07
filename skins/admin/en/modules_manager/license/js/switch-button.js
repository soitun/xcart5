/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Switch button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function makeSmallHeight(button)
{
  switchHeight('.license-area');
}

function makeLargeHeight(button)
{
  switchHeight('.license-area');
}

function switchHeight(area)
{
  var max = "400px";

  if ("undefined" === typeof(jQuery(area).attr("old_height"))) {
    jQuery(area).attr("old_height", jQuery(area).css("height"));
  }

  if (max === jQuery(area).css("height")) {
    jQuery(area).css("height", jQuery(area).attr("old_height"));
  } else {
    jQuery(area).css("height", max);
  }
}

function LicenseAgreement()
{
  jQuery(this.pattern).each(
    function ()
    {
      var licenseBlock;
      licenseBlock = this;

      jQuery('input[name="agree"]', this).bind(
        'click',
        function (event)
        {
          var button;
          button = jQuery('button.submit-button', licenseBlock);

          if (jQuery(this).prop('checked')) {

            button
            .removeClass('disabled')
            .prop('disabled', '');

          } else {

            button
            .addClass('disabled')
            .prop('disabled', 'disabled');

          }
        }
      );

    }
  );
}

LicenseAgreement.prototype.pattern = 'div.module-license';

core.autoload(LicenseAgreement);
