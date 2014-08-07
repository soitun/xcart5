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

namespace XLite\Module\CDev\GoSocial\Model;

/**
 * Page
 *
 * @LC_Dependencies ("CDev\SimpleCMS")
 * @MappedSuperClass
 */
abstract class Page extends \XLite\Module\CDev\SimpleCMS\Model\PageAbstract implements \XLite\Base\IDecorator
{
    /**
     * Custom Open grasph meta tags
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $ogMeta = '';

    /**
     * Show Social share buttons or not
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $showSocialButtons = false;

    /**
     * Get Open Graph meta tags
     *
     * @param boolean $preprocessed Preprocessed OPTIONAL
     *
     * @return string
     */
    public function getOpenGraphMetaTags($preprocessed = true)
    {
        $tags = $this->getOgMeta() ?: $this->generateOpenGraphMetaTags();

        return $preprocessed ? $this->preprocessOpenGraphMetaTags($tags) : $tags;
    }

    /**
     * Set showSocialButtons
     *
     * @param boolean $showSocialButtons
     * @return Page
     */
    public function setShowSocialButtons($showSocialButtons)
    {
        $this->showSocialButtons = $showSocialButtons ? 1 : 0;
        return $this;
    }

    /**
     * Define Open Graph meta tags
     *
     * @return array
     */
    protected function defineOpenGraphMetaTags()
    {
        $language = \XLite\Core\Session::getInstance()->getLanguage();

        $list = array(
            'og:title'       => $this->getName(),
            'og:type'        => 'article',
            'og:url'         => '[PAGE_URL]',
            'og:site_name'   => \XLite\Core\Config::getInstance()->Company->company_name,
            'og:description' => $this->getTeaser(),
            'og:locale'      => 'en_US',
        );

        if ($this->getImage()) {
            $list['og:image'] = '[IMAGE_URL]';
        }

        if (\XLite\Core\Config::getInstance()->CDev->GoSocial->fb_app_id) {
            $list['fb:app_id'] = \XLite\Core\Config::getInstance()->CDev->GoSocial->fb_app_id;

        } elseif (\XLite\Core\Config::getInstance()->CDev->GoSocial->fb_admins) {
            $list['fb:admins'] = \XLite\Core\Config::getInstance()->CDev->GoSocial->fb_admins;
        }

        return $list;
    }

    /**
     * Get generated Open Graph meta tags
     *
     * @return void
     */
    protected function generateOpenGraphMetaTags()
    {
        $list = $this->defineOpenGraphMetaTags();

        $html = array();
        foreach ($list as $k => $v) {
            $html[] = '<meta property="' . $k . '" content="' . htmlentities($v, ENT_COMPAT, 'UTF-8') . '" />';
        }

        return implode("\n", $html);
    }

    /**
     * Preprocess Open Graph meta tags
     *
     * @param string $tags Tags content
     *
     * @return string
     */
    protected function preprocessOpenGraphMetaTags($tags)
    {
        return str_replace(
            array(
                '[PAGE_URL]',
                '[IMAGE_URL]',
            ),
            array(
                $this->getFrontURL(),
                $this->getImage() ? $this->getImage()->getFrontURL() : '',
            ),
            $tags
        );
    }

    /**
     * Set ogMeta
     *
     * @param text $ogMeta
     * @return Page
     */
    public function setOgMeta($ogMeta)
    {
        $this->ogMeta = $ogMeta;
        return $this;
    }

    /**
     * Get ogMeta
     *
     * @return text 
     */
    public function getOgMeta()
    {
        return $this->ogMeta;
    }

    /**
     * Get showSocialButtons
     *
     * @return boolean 
     */
    public function getShowSocialButtons()
    {
        return $this->showSocialButtons;
    }
}