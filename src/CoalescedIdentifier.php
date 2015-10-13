<?php

namespace CascadeEnergy\ExecutionEnvironment\MetaData;

/**
 * This provider accepts any number of other providers and returns the first non-empty value from the list of providers
 */
class CoalescedIdentifier implements IdentifierProviderInterface
{
    /** @var IdentifierProviderInterface[] */
    private $identifierProviderList = [];

    /**
     * @return string The string which identifies a given segment of the execution environment
     */
    public function getIdentifier()
    {
        foreach ($this->identifierProviderList as $identifierProvider) {
            $identifier = $identifierProvider->getIdentifier();

            if (!empty($identifier)) {
                return $identifier;
            }
        }

        return '';
    }

    public function addIdentifierProvider(IdentifierProviderInterface $identifierProvider)
    {
        $this->identifierProviderList[] = $identifierProvider;
    }
}
