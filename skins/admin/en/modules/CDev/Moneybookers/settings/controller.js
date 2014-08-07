/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Moneybookers settings widget controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function() {
    jQuery('.mb-activation .mb-email button').click(
      function() {
        this.form.elements.namedItem('action').value = 'checkEmail';
        
        return true;
      }
    );
  }
);

