<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\CompaniesRestApi\Processor\Company\RestResponseBuilder;

use Generated\Shared\Transfer\RestCompanyAttributesTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\CompaniesRestApi\CompaniesRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class CompanyRestResponseBuilder implements CompanyRestResponseBuilderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(RestResourceBuilderInterface $restResourceBuilder)
    {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param string $companyUuid
     * @param \Generated\Shared\Transfer\RestCompanyAttributesTransfer $restCompanyAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCompanyRestResponse(
        string $companyUuid,
        RestCompanyAttributesTransfer $restCompanyAttributesTransfer
    ): RestResponseInterface {
        return $this->restResourceBuilder->createRestResponse()
            ->addResource($this->buildCompanyRestResponse($restCompanyAttributesTransfer, $companyUuid));
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCompanyIdMissingError(): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_COMPANY_ID_IS_MISSING)
            ->setStatus(Response::HTTP_BAD_REQUEST)
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAIL_COMPANY_ID_IS_MISSING);

        return $this->restResourceBuilder->createRestResponse()->addError($restErrorTransfer);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createCompanyNotFoundError(): RestResponseInterface
    {
        $restErrorTransfer = (new RestErrorMessageTransfer())
            ->setCode(CompaniesRestApiConfig::RESPONSE_CODE_COMPANY_NOT_FOUND)
            ->setStatus(Response::HTTP_NOT_FOUND)
            ->setDetail(CompaniesRestApiConfig::RESPONSE_DETAIL_COMPANY_NOT_FOUND);

        return $this->restResourceBuilder->createRestResponse()->addError($restErrorTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestCompanyAttributesTransfer $restCompanyAttributesTransfer
     * @param string $companyUuid
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected function buildCompanyRestResponse(
        RestCompanyAttributesTransfer $restCompanyAttributesTransfer,
        string $companyUuid
    ): RestResourceInterface {
        return $this->restResourceBuilder->createRestResource(
            CompaniesRestApiConfig::RESOURCE_COMPANIES,
            $companyUuid,
            $restCompanyAttributesTransfer
        );
    }
}