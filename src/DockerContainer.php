<?php

namespace CascadeEnergy\ExecutionEnvironment\MetaData;

use Symfony\Component\Filesystem\Filesystem;

class DockerContainer implements IdentifierProviderInterface
{
    const DEFAULT_CONTAINER_ID_PATH = '/tmp/container.id';

    /** @var string */
    private $containerIdPath;

    /** @var Filesystem */
    private $filesystem;

    public function __construct(Filesystem $filesystem, $containerIdPath = self::DEFAULT_CONTAINER_ID_PATH)
    {
        $this->filesystem = $filesystem;
        $this->containerIdPath = $containerIdPath;
    }

    /**
     * @return string The string which identifies a given segment of the execution environment
     */
    public function getIdentifier()
    {
        if (!$this->filesystem->exists($this->containerIdPath)) {
            return '';
        }

        return file_get_contents($this->containerIdPath);
    }
}
