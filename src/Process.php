<?php

namespace CascadeEnergy\ExecutionEnvironment\MetaData;

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
