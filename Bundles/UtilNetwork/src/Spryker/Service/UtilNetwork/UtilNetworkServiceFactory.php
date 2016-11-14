<?php
/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\UtilNetwork;

use Spryker\Service\Kernel\AbstractServiceFactory;
use Spryker\Service\UtilNetwork\Model\Host;

class UtilNetworkServiceFactory extends AbstractServiceFactory
{

    /**
     * @return \Spryker\Service\UtilNetwork\Model\HostInterface
     */
    public function createHost()
    {
        return new Host();
    }
}
