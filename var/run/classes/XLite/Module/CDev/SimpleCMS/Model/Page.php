<?php

namespace XLite\Module\CDev\SimpleCMS\Model;

/**
 * Page
 *
 * @Entity (repositoryClass="\XLite\Module\CDev\SimpleCMS\Model\Repo\Page")
 * @Table  (name="pages",
 *      indexes={
 *          @Index (name="enabled", columns={"enabled"}),
 *          @Index (name="cl", columns={"cleanURL"})
 *      }
 * )
 */
class Page extends \XLite\Module\CDev\GoSocial\Model\Page
{
}