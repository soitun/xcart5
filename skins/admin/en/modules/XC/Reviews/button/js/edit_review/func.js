/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Edit review button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonEditReview()
{
  PopupButtonEditReview.superclass.constructor.apply(this, arguments);
}

function PopupButtonEditReviewAutoload()
{
  core.autoload(PopupButtonEditReview);
}

extend(PopupButtonEditReview, PopupButton);

PopupButtonEditReview.prototype.pattern = '.edit-review';

PopupButtonEditReviewAutoload();
