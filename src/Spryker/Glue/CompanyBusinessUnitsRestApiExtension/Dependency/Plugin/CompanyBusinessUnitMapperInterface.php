<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompanyBusinessUnitsRestApiExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAttributesTransfer;

interface CompanyBusinessUnitMapperInterface
{
    /**
     * Specification:
     * - Maps company business unit transfer to rest company business unit attributes transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     * @param \Generated\Shared\Transfer\RestCompanyBusinessUnitAttributesTransfer $companyBusinessUnitsAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAttributesTransfer
     */
    public function map(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer,
        RestCompanyBusinessUnitAttributesTransfer $companyBusinessUnitsAttributesTransfer
    ): RestCompanyBusinessUnitAttributesTransfer;
}
