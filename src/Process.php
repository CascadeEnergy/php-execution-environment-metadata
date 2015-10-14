<?php

namespace CascadeEnergy\ExecutionEnvironment\MetaData;

/**
 * This provider returns the OS-level process ID
 */
class Process implements IdentifierProviderInterface
{
    /**
     * @return string The string which identifies a given segment of the execution environment
     */
    public function getIdentifier()
    {
        return posix_getpid();
    }
}
