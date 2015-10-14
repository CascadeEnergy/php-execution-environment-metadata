<?php

namespace CascadeEnergy\ExecutionEnvironment\MetaData;

/**
 * This provider accepts any number of other providers via the `addIdentifierProvider` method and returns a string
 * which concatenates the results of the other providers (separated by the `:` character)
 */
class CompositeIdentifier implements IdentifierProviderInterface
{
    /** @var IdentifierProviderInterface[] */
    private $identifierProviderList = [];

    /**
     * @return string The string which identifies a given segment of the execution environment
     */
    public function getIdentifier()
    {
        $identifierList = [];

        foreach ($this->identifierProviderList as $identifierProvider) {
            $identifierList[] = $identifierProvider->getIdentifier();
        }

        return implode(':', $identifierList);
    }

    public function addIdentifierProvider(IdentifierProviderInterface $identifierProvider)
    {
        $this->identifierProviderList[] = $identifierProvider;
    }
}
