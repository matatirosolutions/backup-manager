<?php
namespace BackupManager\Filesystems;

use League\Flysystem\Filesystem as Flysystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;

/**
 * @package BackupManager\Filesystems
 */
class DropboxV2Filesystem implements Filesystem
{
    /**
     * Test fitness of visitor.
     * @param $type
     * @return bool
     */
    public function handles($type)
    {
        return strtolower($type ?? '') == 'dropboxv2';
    }

    /**
     * @param array $config
     * @return Flysystem
     */
    public function get(array $config)
    {
        $client = new Client($config['token']);
        return new Flysystem(new DropboxAdapter($client, $config['root']));
    }
}
