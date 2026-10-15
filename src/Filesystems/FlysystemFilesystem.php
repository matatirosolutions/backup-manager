<?php namespace BackupManager\Filesystems;

use League\Flysystem\FilesystemOperator;

/**
 * Class FlysystemFilesystem
 * @package BackupManager\Filesystems
 */
class FlysystemFilesystem implements Filesystem
{
    /**
     * @var array|FilesystemOperator[]
     */
    private $filesystems;

    public function __construct(/* iterable */ $filesystems = [])
    {
        $this->filesystems = $filesystems;
    }

    /**
     * @param $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') === 'flysystem';
    }

    public function get(array $config)
    {
        return $this->filesystems[$config['name']];
    }
}
