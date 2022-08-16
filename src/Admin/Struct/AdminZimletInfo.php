<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{ZimletConfigInfo, ZimletContextInterface, ZimletDesc, ZimletInterface};

/**
 * AdminZimletInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AdminZimletInfo implements ZimletInterface
{
    /**
     * Zimlet context
     * 
     * @var ZimletContextInterface
     */
    #[Accessor(getter: 'getZimletContext', setter: 'setZimletContext')]
    #[SerializedName(name: 'zimletContext')]
    #[Type(name: AdminZimletContext::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $zimletContext;

    /**
     * Zimlet description
     * 
     * @var ZimletDesc
     */
    #[Accessor(getter: 'getZimlet', setter: 'setZimlet')]
    #[SerializedName(name: 'zimlet')]
    #[Type(name: AdminZimletDesc::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $zimlet;

    /**
     * Zimlet config
     * 
     * @var ZimletConfigInfo
     */
    #[Accessor(getter: 'getZimletConfig', setter: 'setZimletConfig')]
    #[SerializedName(name: 'zimletConfig')]
    #[Type(name: AdminZimletConfigInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $zimletConfig;

    /**
     * Constructor
     * 
     * @param AdminZimletContext $zimletContext
     * @param AdminZimletDesc $zimlet
     * @param AdminZimletConfigInfo $zimletConfig
     * @return self
     */
    public function __construct(
        ?AdminZimletContext $zimletContext = NULL,
        ?AdminZimletDesc $zimlet = NULL,
        ?AdminZimletConfigInfo $zimletConfig = NULL
    )
    {
        if ($zimletContext instanceof AdminZimletContext) {
            $this->setZimletContext($zimletContext);
        }
        if ($zimlet instanceof AdminZimletDesc) {
            $this->setZimlet($zimlet);
        }
        if ($zimletConfig instanceof AdminZimletConfigInfo) {
            $this->setZimletConfig($zimletConfig);
        }
    }

    /**
     * Get zimletContext
     *
     * @return ZimletContextInterface
     */
    public function getZimletContext(): ?ZimletContextInterface
    {
        return $this->zimletContext;
    }

    /**
     * Set zimletContext
     *
     * @param  ZimletContextInterface $zimletContext
     * @return self
     */
    public function setZimletContext(ZimletContextInterface $zimletContext): self
    {
        if ($zimletContext instanceof AdminZimletContext) {
            $this->zimletContext = $zimletContext;
        }
        return $this;
    }

    /**
     * Get zimlet
     *
     * @return ZimletDesc
     */
    public function getZimlet(): ?ZimletDesc
    {
        return $this->zimlet;
    }

    /**
     * Set zimlet
     *
     * @param  ZimletDesc $zimlet
     * @return self
     */
    public function setZimlet(ZimletDesc $zimlet): self
    {
        if ($zimlet instanceof AdminZimletDesc) {
            $this->zimlet = $zimlet;
        }
        return $this;
    }

    /**
     * Get zimletConfig
     *
     * @return ZimletConfigInfo
     */
    public function getZimletConfig(): ?ZimletConfigInfo
    {
        return $this->zimletConfig;
    }

    /**
     * Set zimletConfig
     *
     * @param  ZimletConfigInfo $zimletConfig
     * @return self
     */
    public function setZimletConfig(ZimletConfigInfo $zimletConfig): self
    {
        if ($zimletConfig instanceof AdminZimletConfigInfo) {
            $this->zimletConfig = $zimletConfig;
        }
        return $this;
    }
}
