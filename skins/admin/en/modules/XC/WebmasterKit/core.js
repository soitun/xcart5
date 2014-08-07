/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Core
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

(function() {
  var tmp = core.trigger;

  core.trigger = function(name, params)
  {
    var result = tmp.apply(this, arguments);

    if ('undefined' != typeof(console.groupCollapsed) && (params || 'undefined' != typeof(console.trace))) {
      console.groupCollapsed('Fire \'' + name + '\' mediator\'s event');
      if (params) {
        console.log(params);
      }
      if ('undefined' != typeof(console.trace)) {
        console.trace();
      }
      console.groupEnd();

    } else {
      console.log('Fire \'' + name + '\' mediator\'s event');
    }

    return result;
  }
})();

