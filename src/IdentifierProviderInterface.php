<?php

namespace CascadeEnergy\ExecutionEnvironment\MetaData;

interface IdentifierProviderInterface
{
    /**
     * @return string The string which identifies a given segment of the execution environment
     */
    public function getIdentifier();
}
