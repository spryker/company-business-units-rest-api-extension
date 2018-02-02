<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyRole\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

class CompanyRoleRepository implements CompanyRoleRepositoryInterface, SprykerAwareRepositoryInterface
{
    /**
     * Specification:
     * - Set QueryContainer to Repository Object
     *
     * @deprecated
     *
     * @param \Spryker\Zed\Kernel\Persistence\AbstractQueryContainer $companyRoleQueryContainer
     *
     * @return $this
     */
    public function setQueryContainer(AbstractQueryContainer $companyRoleQueryContainer)
    {
        // TODO: Implement setQueryContainer() method.
    }

    /**
     * Specification:
     * - Set PersistenceFactory to Repository Object
     *
     * @deprecated
     *
     * @param \Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory $persistenceFactory
     *
     * @return $this
     */
    public function setPersistenceFactory(AbstractPersistenceFactory $persistenceFactory)
    {
        // TODO: Implement setPersistenceFactory() method.
    }
}
