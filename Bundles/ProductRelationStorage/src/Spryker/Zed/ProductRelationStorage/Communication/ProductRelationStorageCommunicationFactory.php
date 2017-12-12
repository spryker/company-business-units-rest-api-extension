<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductRelationStorage\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\ProductRelationStorage\Dependency\Facade\ProductRelationStorageToEventBehaviorFacadeInterface;
use Spryker\Zed\ProductRelationStorage\Dependency\Service\ProductRelationStorageToUtilSanitizeServiceInterface;
use Spryker\Zed\ProductRelationStorage\ProductRelationStorageDependencyProvider;

/**
 * @method \Spryker\Zed\ProductRelationStorage\Persistence\ProductRelationStorageQueryContainer getQueryContainer()
 * @method \Spryker\Zed\ProductRelationStorage\ProductRelationStorageConfig getConfig()
 */
class ProductRelationStorageCommunicationFactory extends AbstractCommunicationFactory
{

    /**
     * @return ProductRelationStorageToUtilSanitizeServiceInterface
     */
    public function getUtilSanitizeService()
    {
        return $this->getProvidedDependency(ProductRelationStorageDependencyProvider::SERVICE_UTIL_SANITIZE);
    }

    /**
     * @return ProductRelationStorageToEventBehaviorFacadeInterface
     */
    public function getEventBehaviorFacade()
    {
        return $this->getProvidedDependency(ProductRelationStorageDependencyProvider::FACADE_EVENT_BEHAVIOR);
    }
    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    public function getStore()
    {
        return $this->getProvidedDependency(ProductRelationStorageDependencyProvider::STORE);
    }

}
