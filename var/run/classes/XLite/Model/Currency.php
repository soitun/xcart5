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
 * Currency
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Currency")
 * @Table (name="currencies",
 *      indexes = {
 *          @Index (name="code", columns={"code"})
 *      }
 * )
 */
class Currency extends \XLite\Model\Base\I18n
{
    /**
     * Currency unique id (ISO 4217 number)
     *
     * @var integer
     *
     * @Id
     * @Column (type="uinteger")
     */
    protected $currency_id;

    /**
     * Currency code (ISO 4217 alpha-3)
     *
     * @var string
     *
     * @Column (type="fixedstring", length=3, unique=true)
     */
    protected $code;

    /**
     * Symbol
     *
     * @var string
     *
     * @Column (type="string", length=16)
     */
    protected $symbol;

    /**
     * Prefix
     *
     * @var string
     *
     * @Column (type="string", length=32)
     */
    protected $prefix = '';

    /**
     * Suffix
     *
     * @var string
     *
     * @Column (type="string", length=32)
     */
    protected $suffix = '';

    /**
     * Number of digits after the decimal separator.
     *
     * @var integer
     *
     * @Column (type="smallint")
     */
    protected $e = 0;

    /**
     * Decimal part delimiter
     * @var string
     *
     * @Column (type="string", length=8)
     */
    protected $decimalDelimiter = '.';

    /**
     * Thousand delimier
     *
     * @var string
     *
     * @Column (type="string", length=8)
     */
    protected $thousandDelimiter = '';

    /**
     * Orders
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Model\Order", mappedBy="currency")
     */
    protected $orders;

    /**
     * Countries
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Model\Country", mappedBy="currency", cascade={"all"})
     */
    protected $countries;


    /**
     * Set currency Id
     *
     * @param integer $value Currency id
     * TODO - Doctrine is not generate setter for identifier. We must reworkt it
     *
     * @return void
     */
    public function setCurrencyId($value)
    {
        $this->currency_id = $value;
    }

    /**
     * Round value
     *
     * @param float $value Value
     *
     * @return float
     */
    public function roundValue($value)
    {
        return \XLite\Logic\Math::getInstance()->roundByCurrency($value, $this);
    }

    /**
     * Round value as integer
     *
     * @param float $value Value
     *
     * @return integer
     */
    public function roundValueAsInteger($value)
    {
        return intval(round($this->roundValue($value) * pow(10, $this->getE()), 0));
    }

    /**
     * Convert integer to float
     *
     * @param integer $value Value
     *
     * @return float
     */
    public function convertIntegerToFloat($value)
    {
        return $value / pow(10, $this->getE());
    }

    /**
     * Format value
     *
     * @param float $value Value
     *
     * @return string
     */
    public function formatValue($value)
    {
        return \XLite\Logic\Math::getInstance()->formatValue($value, $this);
    }

    /**
     * Get minimum value 
     *
     * @return float
     */
    public function getMinimumValue()
    {
        return $this->convertIntegerToFloat(1);
    }

    /**
     * Constructor
     *
     * @param array $data Entity properties OPTIONAL
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        $this->orders    = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

    /**
     * Format value as parts list
     * 
     * @param float $value Value
     *  
     * @return array
     */
    public function formatParts($value)
    {
        return \XLite\Logic\Math::getInstance()->formatParts($value, $this);
    }


    /**
     * Get currency_id
     *
     * @return uinteger 
     */
    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    /**
     * Set code
     *
     * @param fixedstring $code
     * @return Currency
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return fixedstring 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set symbol
     *
     * @param string $symbol
     * @return Currency
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * Get symbol
     *
     * @return string 
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     * @return Currency
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * Get prefix
     *
     * @return string 
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set suffix
     *
     * @param string $suffix
     * @return Currency
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * Get suffix
     *
     * @return string 
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * Set e
     *
     * @param smallint $e
     * @return Currency
     */
    public function setE($e)
    {
        $this->e = $e;
        return $this;
    }

    /**
     * Get e
     *
     * @return smallint 
     */
    public function getE()
    {
        return $this->e;
    }

    /**
     * Set decimalDelimiter
     *
     * @param string $decimalDelimiter
     * @return Currency
     */
    public function setDecimalDelimiter($decimalDelimiter)
    {
        $this->decimalDelimiter = $decimalDelimiter;
        return $this;
    }

    /**
     * Get decimalDelimiter
     *
     * @return string 
     */
    public function getDecimalDelimiter()
    {
        return $this->decimalDelimiter;
    }

    /**
     * Set thousandDelimiter
     *
     * @param string $thousandDelimiter
     * @return Currency
     */
    public function setThousandDelimiter($thousandDelimiter)
    {
        $this->thousandDelimiter = $thousandDelimiter;
        return $this;
    }

    /**
     * Get thousandDelimiter
     *
     * @return string 
     */
    public function getThousandDelimiter()
    {
        return $this->thousandDelimiter;
    }

    /**
     * Add orders
     *
     * @param XLite\Model\Order $orders
     * @return Currency
     */
    public function addOrders(\XLite\Model\Order $orders)
    {
        $this->orders[] = $orders;
        return $this;
    }

    /**
     * Get orders
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * Add countries
     *
     * @param XLite\Model\Country $countries
     * @return Currency
     */
    public function addCountries(\XLite\Model\Country $countries)
    {
        $this->countries[] = $countries;
        return $this;
    }

    /**
     * Get countries
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * Translations (relation). AUTOGENERATED
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Model\CurrencyTranslation", mappedBy="owner", cascade={"all"})
     */
    protected $translations;

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getName()
    {
        return $this->getSoftTranslation()->getName();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setName($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setName($value);
    }


}