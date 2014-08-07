<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * X-Cart
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the software license agreement
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.x-cart.com/license-agreement.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to licensing@x-cart.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not modify this file if you wish to upgrade X-Cart to newer versions
 * in the future. If you wish to customize X-Cart for your needs please
 * refer to http://www.x-cart.com/ for more information.
 *
 * @category  X-Cart 5
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Model;

/**
 * Language label
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\LanguageLabel")
 * @Table (name="language_labels",
 *      uniqueConstraints={
 *          @UniqueConstraint (name="name", columns={"name"})
 *      }
 * )
 */
class LanguageLabel extends \XLite\Model\Base\I18n
{
    /**
     * Unique id
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column (type="integer")
     */
    protected $label_id;

    /**
     * Label name
     *
     * @var string
     *
     * @Column (type="varbinary", length=255)
     */
    protected $name;

    /**
     * Get label translation 
     * 
     * @param string $code Language code OPTIONAL
     *  
     * @return \XLite\Model\LanguageLabelTranslation
     */
    public function getLabelTranslation($code = null)
    {
        $result = null;

        $query = \XLite\Core\Translation::getLanguageQuery($code);
        foreach ($query as $code) {
            $result = $this->getTranslation($code, true);
            if (isset($result) || 'en' == $code) {
                break;
            }
        }

        return $result;
    }
}
