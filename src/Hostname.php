<?php

namespace CascadeEnergy\ExecutionEnvironment\MetaData;

/**
 * This provider simply returns the result of `gethostname()`.
 */
class Hostname implements IdentifierProviderInterface
{
    /**
     * @return string The string which identifies a given segment of the execution environment
     */
    public function getIdentifier()
    {
        return gethostname();
    }
}
