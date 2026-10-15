<?php

namespace spec\BackupManager\Filesystems;

use BackupManager\Filesystems\FlysystemFilesystem;
use League\Flysystem\FilesystemOperator;
use PhpSpec\ObjectBehavior;

class FlysystemFilesystemSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(FlysystemFilesystem::class);
    }

    public function it_should_recognize_its_type_with_case_insensitivity()
    {
        foreach (['flysystem', 'Flysystem', 'FlySystem'] as $type) {
            $this->handles($type)->shouldBe(true);
        }

        foreach ([null, 'foo'] as $type) {
            $this->handles($type)->shouldBe(false);
        }
    }

    public function it_should_provide_an_instance_of_an_flysystem_filesystem(FilesystemOperator $filesystem)
    {
        $name = 's3_backup';
        $this->beConstructedWith([$name => $filesystem]);
        $this->get(['name' => $name])->shouldHaveType(FilesystemOperator::class);
    }
}
