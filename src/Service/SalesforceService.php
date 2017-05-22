<?php

namespace GenesisGlobal\Salesforce\SalesforceBundle\Service;


use GenesisGlobal\Salesforce\Client\SalesforceClientInterface;
use GenesisGlobal\Salesforce\SalesforceBundle\Sobject\SobjectInterface;

/**
 * Class SalesforceService
 * @package GenesisGlobal\Salesforce\SalesforceBundle\Service
 */
class SalesforceService implements SalesforceServiceInterface
{
    /**
     * constant for sobjects resources
     */
    const SOBJECTS_ACTION = 'sobjects';

    /**
     * @var SalesforceClientInterface
     */
    protected $client;

    /**
     * SalesforceService constructor.
     * @param SalesforceClientInterface $salesforceClient
     */
    public function __construct(SalesforceClientInterface $salesforceClient)
    {
        $this->client = $salesforceClient;
    }

    /**
     * @param SobjectInterface $sObject
     */
    public function create(SobjectInterface $sObject)
    {
        $response = $this->client->post(self::SOBJECTS_ACTION, $sObject->toArray());
        if (isset($response->body->id)) {
            $sObject->setId($response->body->id);
        }
    }
}
