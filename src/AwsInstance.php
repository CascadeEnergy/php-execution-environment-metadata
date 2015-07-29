<?php

namespace CascadeEnergy\ExecutionEnvironment\MetaData;

use GuzzleHttp\Client;

class AwsInstance implements IdentifierProviderInterface
{
    private $guzzleClient;
    private $instanceIdentityDocument = null;

    public function __construct(Client $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * @return string The string which identifies a given segment of the execution environment
     */
    public function getIdentifier()
    {
        if (is_null($this->instanceIdentityDocument)) {
            $this->getInstanceIdentityDocument();
        }

        if (!array_key_exists('instanceId', $this->instanceIdentityDocument)) {
            return '';
        }

        return $this->instanceIdentityDocument['instanceId'];
    }

    private function getInstanceIdentityDocument()
    {
        try {
            $result = $this->guzzleClient->get('http://169.254.169.254/latest/dynamic/instance-identity/document');
            $this->instanceIdentityDocument = json_decode((string)$result->getBody(), true);
        } catch (\Exception $exception) {
            $this->instanceIdentityDocument = [];
        }
    }
}
