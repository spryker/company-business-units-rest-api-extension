<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Payone\Communication\Plugin\Condition;

use Generated\Shared\Transfer\OrderTransfer;

/**
 * @method \Spryker\Zed\Payone\Business\PayoneFacade getFacade()
 * @method \Spryker\Zed\Payone\Communication\PayoneCommunicationFactory getFactory()
 */
class AuthorizationIsErrorPlugin extends AbstractPlugin
{

    const NAME = 'AuthorizationIsErrorPlugin';

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return bool
     */
    protected function callFacade(OrderTransfer $orderTransfer)
    {
        return $this->getFacade()->isAuthorizationError($orderTransfer);
    }

}