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
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Model\Payment;

/**
 * @MappedSuperClass (repositoryClass="\XLite\Model\Repo\Payment\Method")
 */
abstract class MethodAbstract extends \XLite\Model\Base\I18n
{
    /**
     * Type codes
     */
    const TYPE_ALLINONE    = 'A';
    const TYPE_CC_GATEWAY  = 'C';
    const TYPE_ALTERNATIVE = 'N';
    const TYPE_OFFLINE     = 'O';


    /**
     * Payment method unique id
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
    protected $method_id;

    /**
     * Method service name (gateway or API name)
     *
     * @var string
     *
     * @Column (type="string", length=128)
     */
    protected $service_name;

    /**
     * Process class name
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $class;

    /**
     * Specific module family name
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $moduleName = '';

    /**
     * Position
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $orderby = 0;

    /**
     * Enabled status
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $enabled = false;

    /**
     * Module enabled status
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $moduleEnabled = true;

    /**
     * Added status
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $added = false;

    /**
     * Type
     *
     * @var string
     *
     * @Column (type="fixedstring", length=1)
     */
    protected $type = self::TYPE_OFFLINE;

    /**
     * Settings
     *
     * @var \XLite\Model\Payment\MethodSetting
     *
     * @OneToMany (targetEntity="XLite\Model\Payment\MethodSetting", mappedBy="payment_method", cascade={"all"})
     */
    protected $settings;

    /**
     * Transactions
     *
     * @var \XLite\Model\Payment\Transaction
     *
     * @OneToMany (targetEntity="XLite\Model\Payment\Transaction", mappedBy="payment_method", cascade={"all"})
     */
    protected $transactions;

    /**
     * Get processor
     *
     * @return \XLite\Model\Payment\Base\Processor
     */
    public function getProcessor()
    {
        $class = '\XLite\\' . $this->getClass();

        return \XLite\Core\Operator::isClassExists($class) ? $class::getInstance() : null;
    }

    /**
     * Check - enabled method or not
     * FIXME - must be removed
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return ($this->getEnabled() || $this->isForcedEnabled())
            && $this->getAdded()
            && $this->getModuleEnabled()
            && $this->getProcessor()
            && $this->getProcessor()->isConfigured($this);
    }

    /**
     * Set class
     *
     * @return void
     */
    public function setClass($class)
    {
        $this->class = preg_replace('/^\\\?(?:XLite\\\)?\\\?/Sis', '', $class);

        if (preg_match('/^Module/Sis', $class) > 0) {

            list($modulePrefix, $author, $name) = explode('\\', $class, 4);

            $this->setModuleName($author . '_' . $name);
        }
    }

    /**
     * Get setting value by name
     *
     * @param string $name Name
     *
     * @return string|void
     */
    public function getSetting($name)
    {
        $entity = $this->getSettingEntity($name);

        return $entity ? $entity->getValue() : null;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->getOrderby();
    }

    /**
     * Set position
     *
     * @param integer $position Position
     *
     * @return integer
     */
    public function setPosition($position)
    {
        return $this->setOrderby($position);
    }

    /**
     * Get setting by name
     *
     * @param string $name Name
     *
     * @return \XLite\Model\Payment\MethodSetting
     */
    public function getSettingEntity($name)
    {
        $result = null;

        foreach ($this->getSettings() as $setting) {
            if ($setting->getName() == $name) {
                $result = $setting;
                break;
            }
        }

        return $result;
    }

    /**
     * Set setting value by name
     *
     * @param string $name  Name
     * @param string $value Value
     *
     * @return boolean
     */
    public function setSetting($name, $value)
    {
        $result = false;

        // Update settings which is already stored in database
        $setting = $this->getSettingEntity($name);

        if ($setting) {
            $setting->setValue(strval($value));
            $result = true;

        } else {

            // Create setting which is not in database but specified in the processor class

            $processor = $this->getProcessor();

            if ($processor && method_exists($processor, 'getAvailableSettings')) {
                $availableSettings = $processor->getAvailableSettings();

                if (in_array($name, $availableSettings)) {
                    $setting = new \XLite\Model\Payment\MethodSetting();
                    $setting->setName($name);
                    $setting->setValue(strval($value));
                    $setting->setPaymentMethod($this);

                    \XLite\Core\Database::getEM()->persist($setting);
                }
            }
        }

        return $result;
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
        $this->settings     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->transactions = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

    /**
     * Call processor methods
     *
     * @param string $method    Method name
     * @param array  $arguments Arguments OPTIONAL
     *
     * @return mixed
     */
    public function __call($method, array $arguments = array())
    {
        array_unshift($arguments, $this);

        return $this->getProcessor()
            ? call_user_func_array(array($this->getProcessor(), $method), $arguments)
            : null;
    }

    /**
     * Get warning note
     *
     * @return string
     */
    public function getWarningNote()
    {
        $message = null;

        if ($this->getProcessor() && !$this->getProcessor()->isConfigured($this)) {
            $message = static::t('The method is not configured and cannot be used');
        }

        if (!$message) {
            $message = $this->getProcessor() ? $this->getProcessor()->getWarningNote($this) : null;
        }

        return $message;
    }

    /**
     * Get payment method admin zone icon URL
     *
     * @return string
     */
    public function getAdminIconURL()
    {
        $url = $this->getProcessor() ? $this->getProcessor()->getAdminIconURL($this) : null;

        if (true === $url) {
            $module = $this->getProcessor()->getModule();
            $url = $module
                ? \XLite\Core\Layout::getInstance()->getResourceWebPath('modules/' . $module->getAuthor() . '/' . $module->getName() . '/method_icon.png')
                : null;
        }

        return $url;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled Property value
     *
     * @return \XLite\Model\Payment\Method
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        if ($this->getProcessor()) {
            $this->getProcessor()->enableMethod($this);
        }

        return $this;
    }

    /**
     * Set 'added' property
     *
     * @param boolean $added Property value
     *
     * @return \XLite\Model\Payment\Method
     */
    public function setAdded($added)
    {
        $this->added = $added;

        if (!$added) {
            $this->setEnabled(false);
        }

        return $this;
    }

    /**
     * Get method_id
     *
     * @return integer 
     */
    public function getMethodId()
    {
        return $this->method_id;
    }

    /**
     * Set service_name
     *
     * @param string $serviceName
     * @return Method
     */
    public function setServiceName($serviceName)
    {
        $this->service_name = $serviceName;
        return $this;
    }

    /**
     * Get service_name
     *
     * @return string 
     */
    public function getServiceName()
    {
        return $this->service_name;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set moduleName
     *
     * @param string $moduleName
     * @return Method
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
        return $this;
    }

    /**
     * Get moduleName
     *
     * @return string 
     */
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * Set orderby
     *
     * @param integer $orderby
     * @return Method
     */
    public function setOrderby($orderby)
    {
        $this->orderby = $orderby;
        return $this;
    }

    /**
     * Get orderby
     *
     * @return integer 
     */
    public function getOrderby()
    {
        return $this->orderby;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set moduleEnabled
     *
     * @param boolean $moduleEnabled
     * @return Method
     */
    public function setModuleEnabled($moduleEnabled)
    {
        $this->moduleEnabled = $moduleEnabled;
        return $this;
    }

    /**
     * Get moduleEnabled
     *
     * @return boolean 
     */
    public function getModuleEnabled()
    {
        return $this->moduleEnabled;
    }

    /**
     * Get added
     *
     * @return boolean 
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * Set type
     *
     * @param fixedstring $type
     * @return Method
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return fixedstring 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add settings
     *
     * @param XLite\Model\Payment\MethodSetting $settings
     * @return Method
     */
    public function addSettings(\XLite\Model\Payment\MethodSetting $settings)
    {
        $this->settings[] = $settings;
        return $this;
    }

    /**
     * Get settings
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Add transactions
     *
     * @param XLite\Model\Payment\Transaction $transactions
     * @return Method
     */
    public function addTransactions(\XLite\Model\Payment\Transaction $transactions)
    {
        $this->transactions[] = $transactions;
        return $this;
    }

    /**
     * Get transactions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * Translations (relation). AUTOGENERATED
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Model\Payment\MethodTranslation", mappedBy="owner", cascade={"all"})
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

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getSoftTranslation()->getTitle();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setTitle($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setTitle($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getSoftTranslation()->getDescription();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setDescription($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setDescription($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getAdminDescription()
    {
        return $this->getSoftTranslation()->getAdminDescription();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setAdminDescription($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setAdminDescription($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getInstruction()
    {
        return $this->getSoftTranslation()->getInstruction();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setInstruction($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setInstruction($value);
    }


}