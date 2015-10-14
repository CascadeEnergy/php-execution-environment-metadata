<?php

namespace CascadeEnergy\ExecutionEnvironment\MetaData;

/**
 * The interface which must be implemented by all classes that provide execution environment identifiers
 */
interface IdentifierProviderInterface
{
    /**
     * @return string The string which identifies a given segment of the execution environment
     */
    public function getIdentifier();
}
