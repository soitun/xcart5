/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Top menu controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function() {
    var activeItem = jQuery('#topMenu li.root li.active');

    if (activeItem.length) {

      var selectedTab = activeItem.parents('li.menu-item:first');

      if (selectedTab.length) {

        selectedTab.addClass('current');
        jQuery('div', selectedTab).clone().attr('id','topMenuLine').prependTo('#content');

        var paddingTop = parseInt(jQuery('#content').css('padding-top'));
        var menuHeight = parseInt(jQuery('#topMenuLine').css('height'));

        jQuery('#content')
          .css('background-position', 'left ' + (paddingTop + menuHeight - 10) + 'px');
      }

    }

  }
);



