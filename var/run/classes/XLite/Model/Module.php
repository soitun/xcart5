<?php

namespace XLite\Model;

/**
 * Module
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Module")
 * @Table  (name="modules",
 *      uniqueConstraints={
 *          @UniqueConstraint (name="moduleVersion", columns={"author","name","majorVersion","minorVersion","fromMarketplace"})
 *      },
 *      indexes={
 *          @Index (name="enabled", columns={"enabled"}),
 *          @Index (name="date", columns={"date"}),
 *          @Index (name="downloads", columns={"downloads"}),
 *          @Index (name="rating", columns={"rating"})
 *      }
 * )
 * 
 */
class Module extends \XLite\Module\CDev\XPaymentsConnector\Model\Module
{
}