<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Transfer\Business\Model\Generator\Transfer;

use Spryker\Zed\Transfer\Business\Model\Generator\AbstractDefinitionBuilder;
use Spryker\Zed\Transfer\Business\Model\Generator\MergerInterface;
use Spryker\Zed\Transfer\Business\Model\Generator\TransferDefinitionLoader;

class TransferDefinitionBuilder extends AbstractDefinitionBuilder
{

    /**
     * @var \Spryker\Zed\Transfer\Business\Model\Generator\TransferDefinitionLoader
     */
    private $loader;

    /**
     * @var \Spryker\Zed\Transfer\Business\Model\Generator\TransferDefinitionMerger
     */
    private $merger;

    /**
     * @var \Spryker\Zed\Transfer\Business\Model\Generator\Transfer\ClassDefinition
     */
    private $classDefinition;

    /**
     * @param \Spryker\Zed\Transfer\Business\Model\Generator\TransferDefinitionLoader $loader
     * @param \Spryker\Zed\Transfer\Business\Model\Generator\MergerInterface $merger
     * @param \Spryker\Zed\Transfer\Business\Model\Generator\Transfer\ClassDefinition $classDefinition
     */
    public function __construct(TransferDefinitionLoader $loader, MergerInterface $merger, ClassDefinition $classDefinition)
    {
        $this->loader = $loader;
        $this->merger = $merger;
        $this->classDefinition = $classDefinition;
    }

    /**
     * @return \Spryker\Zed\Transfer\Business\Model\Generator\Transfer\ClassDefinition[]
     */
    public function getDefinitions()
    {
        $definitions = $this->loader->getDefinitions();
        $definitions = $this->merger->merge($definitions);

        return $this->buildDefinitions($definitions, $this->classDefinition);
    }

}