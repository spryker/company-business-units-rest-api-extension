<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Collector\Business\Exporter\Writer\KeyValue;

use Spryker\Shared\Library\Storage\Adapter\KeyValue\ReadWriteInterface;
use Spryker\Zed\Collector\Business\Exporter\Writer\WriterInterface;

class RedisWriter implements WriterInterface
{

    /**
     * @var \Spryker\Shared\Library\Storage\Adapter\KeyValue\ReadWriteInterface|\Spryker\Shared\Library\Storage\Adapter\KeyValue\RedisReadWrite
     */
    protected $redis;

    /**
     * @param \Spryker\Shared\Library\Storage\Adapter\KeyValue\ReadWriteInterface $kvAdapter
     */
    public function __construct(ReadWriteInterface $kvAdapter)
    {
        $this->redis = $kvAdapter;
    }

    /**
     * @param array $dataSet
     * @param string $type
     *
     * @return bool
     */
    public function write(array $dataSet, $type = '')
    {
        return $this->redis->setMulti($dataSet);
    }

    /**
     * @param array $dataSet
     *
     * @return bool
     */
    public function delete(array $dataSet)
    {
        $dataSetAssociate = [];
        foreach ($dataSet as $redisKey) {
            $dataSetAssociate[$redisKey] = true;
        }

        return $this->redis->deleteMulti($dataSetAssociate);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'redis-writer';
    }

}