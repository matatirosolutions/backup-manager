<?php namespace BackupManager\Tasks\Storage;

use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use BackupManager\Tasks\Task;

/**
 * Class TransferFile
 * @package BackupManager\Tasks\Storage
 */
class TransferFile implements Task
{
    /** @var FilesystemOperator */
    private $sourceFilesystem;
    /** @var string */
    private $sourcePath;
    /** @var FilesystemOperator */
    private $destinationFilesystem;
    /** @var string */
    private $destinationPath;

    /**
     * @param FilesystemOperator $sourceFilesystem
     * @param $sourcePath
     * @param FilesystemOperator $destinationFilesystem
     * @param $destinationPath
     */
    public function __construct(FilesystemOperator $sourceFilesystem, $sourcePath, FilesystemOperator $destinationFilesystem, $destinationPath)
    {
        $this->sourceFilesystem = $sourceFilesystem;
        $this->sourcePath = $sourcePath;
        $this->destinationFilesystem = $destinationFilesystem;
        $this->destinationPath = $destinationPath;
    }

    /**
     * @throws FilesystemException
     */
    public function execute()
    {
        $this->destinationFilesystem->writeStream(
            $this->destinationPath,
            $this->sourceFilesystem->readStream($this->sourcePath)
        );
    }
}
