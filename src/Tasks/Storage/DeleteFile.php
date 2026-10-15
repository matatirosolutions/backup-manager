<?php namespace BackupManager\Tasks\Storage;

use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use BackupManager\Tasks\Task;

/**
 * Class DeleteFile
 * @package BackupManager\Tasks\Storage
 */
class DeleteFile implements Task
{
    /** @var FilesystemOperator */
    private $filesystem;
    /** @var string */
    private $filePath;

    /**
     * @param FilesystemOperator $filesystem
     * @param $filePath
     */
    public function __construct(FilesystemOperator $filesystem, $filePath)
    {
        $this->filesystem = $filesystem;
        $this->filePath = $filePath;
    }

    /**
     * @return bool
     * @throws FilesystemException
     */
    public function execute()
    {
        $this->filesystem->delete($this->filePath);

        return true;
    }
}
