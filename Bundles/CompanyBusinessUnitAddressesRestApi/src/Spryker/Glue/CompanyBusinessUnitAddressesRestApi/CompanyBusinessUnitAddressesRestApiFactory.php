<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompanyBusinessUnitAddressesRestApi;

use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Dependency\Client\CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressClientInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\CompanyBusinessUnitAddressMapper;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\CompanyBusinessUnitAddressMapperInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\CompanyBusinessUnitAddressReader;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\CompanyBusinessUnitAddressReaderInterface;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\CompanyBusinessUnitAddressRestResponseBuilder;
use Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\CompanyBusinessUnitAddressRestResponseBuilderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

class CompanyBusinessUnitAddressesRestApiFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\CompanyBusinessUnitAddressReader
     */
    public function createCompanyBusinessUnitAddressReader(): CompanyBusinessUnitAddressReaderInterface
    {
        return new CompanyBusinessUnitAddressReader(
            $this->createCompanyBusinessUnitAddressMapper(),
            $this->getCompanyBusinessUnitAddressClient(),
            $this->createCompanyBusinessUnitAddressRestResponseBuilder()
        );
    }

    /**
     * @return \Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\CompanyBusinessUnitAddressMapperInterface
     */
    public function createCompanyBusinessUnitAddressMapper(): CompanyBusinessUnitAddressMapperInterface
    {
        return new CompanyBusinessUnitAddressMapper();
    }

    /**
     * @return \Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Processor\CompanyBusinessUnitAddress\CompanyBusinessUnitAddressRestResponseBuilderInterface
     */
    public function createCompanyBusinessUnitAddressRestResponseBuilder(): CompanyBusinessUnitAddressRestResponseBuilderInterface
    {
        return new CompanyBusinessUnitAddressRestResponseBuilder($this->getResourceBuilder());
    }

    /**
     * @return \Spryker\Glue\CompanyBusinessUnitAddressesRestApi\Dependency\Client\CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressClientInterface
     */
    public function getCompanyBusinessUnitAddressClient(): CompanyBusinessUnitAddressesRestApiToCompanyUnitAddressClientInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitAddressesRestApiDependencyProvider::CLIENT_COMPANY_UNIT_ADDRESS);
    }
}