<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Tax\Business;

use Spryker\Zed\Tax\Business\Model\TaxWriter;
use Spryker\Zed\Tax\Business\Model\TaxReader;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\Tax\TaxConfig getConfig()
 * @method \Spryker\Zed\Tax\Persistence\TaxQueryContainer getQueryContainer()
 */
class TaxBusinessFactory extends AbstractBusinessFactory
{

    /**
     * @return \Spryker\Zed\Tax\Business\Model\TaxReaderInterface
     */
    public function createReaderModel()
    {
        return new TaxReader(
            $this->getQueryContainer()
        );
    }

    /**
     * @return \Spryker\Zed\Tax\Business\Model\TaxWriterInterface
     */
    public function createWriterModel()
    {
        return new TaxWriter(
            $this->getQueryContainer(),
            $this->getTaxChangePlugins()
        );
    }

    /**
     * @return \Spryker\Zed\Tax\Dependency\Plugin\TaxChangePluginInterface[]
     */
    public function getTaxChangePlugins()
    {
        return [];
    }

}