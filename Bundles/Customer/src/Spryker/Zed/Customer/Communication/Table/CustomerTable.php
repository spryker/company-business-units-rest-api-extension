<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Customer\Communication\Table;

use Propel\Runtime\Collection\ObjectCollection;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerAddressTableMap;
use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Orm\Zed\Customer\Persistence\SpyCustomer;
use Spryker\Zed\Customer\Persistence\CustomerQueryContainer;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class CustomerTable extends AbstractTable
{

    const FORMAT = 'Y-m-d G:i:s';
    const ACTIONS = 'Actions';

    const COL_ZIP_CODE = 'zip_code';
    const COL_CITY = 'city';
    const COL_FK_COUNTRY = 'country';
    const COL_CREATED_AT = 'created_at';
    const COL_ID_CUSTOMER = 'id_customer';
    const COL_EMAIL = 'email';
    const COL_FIRST_NAME = 'first_name';
    const COL_LAST_NAME = 'last_name';

    /**
     * @var \Spryker\Zed\Customer\Persistence\CustomerQueryContainer
     */
    protected $customerQueryContainer;

    /**
     * @param \Spryker\Zed\Customer\Persistence\CustomerQueryContainer $customerQueryContainer
     */
    public function __construct(CustomerQueryContainer $customerQueryContainer)
    {
        $this->customerQueryContainer = $customerQueryContainer;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            self::COL_ID_CUSTOMER => '#',
            self::COL_CREATED_AT => 'Registration Date',
            self::COL_EMAIL => 'Email',
            self::COL_LAST_NAME => 'Last Name',
            self::COL_FIRST_NAME => 'First Name',
            self::COL_ZIP_CODE => 'Zip Code',
            self::COL_CITY => 'City',
            self::COL_FK_COUNTRY => 'Country',
            self::ACTIONS => self::ACTIONS,
        ]);

        $config->setSortable([
            self::COL_ID_CUSTOMER,
            self::COL_CREATED_AT,
            self::COL_EMAIL,
            self::COL_LAST_NAME,
            self::COL_FIRST_NAME,
            self::COL_ZIP_CODE,
            self::COL_CITY,
        ]);

        $config->setUrl('table');

        $config->setSearchable([
            SpyCustomerTableMap::COL_ID_CUSTOMER,
            SpyCustomerTableMap::COL_EMAIL,
            SpyCustomerTableMap::COL_CREATED_AT,
            SpyCustomerAddressTableMap::COL_FIRST_NAME,
            SpyCustomerAddressTableMap::COL_LAST_NAME,
            SpyCustomerAddressTableMap::COL_ZIP_CODE,
            SpyCustomerAddressTableMap::COL_CITY,
        ]);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Propel\Runtime\Collection\ObjectCollection
     */
    protected function prepareData(TableConfiguration $config)
    {
        $query = $this->prepareQuery();

        $customersCollection = $this->runQuery($query, $config, true);

        if ($customersCollection->count() < 1) {
            return [];
        }

        return $this->formatCustomerCollection($customersCollection);
    }

    /**
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer $customer
     *
     * @return string
     */
    protected function buildLinks(SpyCustomer $customer = null)
    {
        if ($customer === null) {
            return '';
        }

        $buttons = [];
        $buttons[] = $this->generateViewButton('/customer/view/?id-customer=' . $customer->getIdCustomer(), 'View');
        $buttons[] = $this->generateEditButton('/customer/edit/?id-customer=' . $customer->getIdCustomer(), 'Edit');
        $buttons[] = $this->generateViewButton('/customer/address/?id-customer=' . $customer->getIdCustomer(), 'Manage Addresses');

        return implode(' ', $buttons);
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $customersCollection
     *
     * @return array
     */
    protected function formatCustomerCollection(ObjectCollection $customersCollection)
    {
        $customersList = [];

        foreach ($customersCollection as $customer) {
            $customersList[] = $this->hydrateCustomerListRow($customer);
        }

        return $customersList;
    }

    /**
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer $customer
     *
     * @return array
     */
    protected function hydrateCustomerListRow(SpyCustomer $customer)
    {
        $customerRow = $customer->toArray();

        $customerRow[self::COL_FK_COUNTRY] = $this->getCountryNameByCustomer($customer);
        $customerRow[self::COL_CREATED_AT] = $customer->getCreatedAt(self::FORMAT);
        $customerRow[self::ACTIONS] = $this->buildLinks($customer);

        return $customerRow;
    }

    /**
     * @param \Orm\Zed\Customer\Persistence\SpyCustomer $customer
     *
     * @return string
     */
    protected function getCountryNameByCustomer(SpyCustomer $customer)
    {
        $countryName = '';

        if ($customer->getAddresses()->count() > 0) {
            $address = $customer->getAddresses()->get(0);
            $countryName = $address->getCountry()->getName();
        }

        return $countryName;
    }

    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    protected function prepareQuery()
    {
        $query = $this->customerQueryContainer->queryCustomers()
            ->leftJoinBillingAddress()
            ->withColumn(SpyCustomerAddressTableMap::COL_ZIP_CODE, self::COL_ZIP_CODE)
            ->withColumn(SpyCustomerAddressTableMap::COL_CITY, self::COL_CITY)
            ->withColumn(SpyCustomerAddressTableMap::COL_FK_COUNTRY, self::COL_FK_COUNTRY);

        return $query;
    }

}