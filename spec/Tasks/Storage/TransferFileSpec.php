<?php

namespace spec\BackupManager\Tasks\Storage;

use League\Flysystem\FilesystemOperator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransferFileSpec extends ObjectBehavior
{
    public function it_is_initializable(FilesystemOperator $filesystem)
    {
        $this->beConstructedWith($filesystem, 'source', $filesystem, 'destination');
        $this->shouldHaveType('BackupManager\Tasks\Storage\TransferFile');
    }

    public function it_should_execute_the_transfer_file_command(FilesystemOperator $source, FilesystemOperator $destination)
    {
        $source->readStream('source')->willReturn('data');
        $destination->writeStream('destination', 'data')->shouldBeCalled();

        $this->beConstructedWith($source, 'source', $destination, 'destination');
        $this->execute();
    }
}
