<?php

namespace spec\BackupManager\Filesystems;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocalFilesystemSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('BackupManager\Filesystems\LocalFilesystem');
    }

    public function it_should_recognize_its_type_with_case_insensitivity()
    {
        foreach (['local', 'LOCAL', 'LocaL'] as $type) {
            $this->handles($type)->shouldBe(true);
        }

        foreach ([null, 'foo'] as $type) {
            $this->handles($type)->shouldBe(false);
        }
    }

    public function it_should_provide_an_instance_of_a_local_filesystem()
    {
        $this->get($this->getConfig())->shouldHaveType('League\Flysystem\FilesystemOperator');
    }

    public function getConfig()
    {
        return [
            'root' => __DIR__,
        ];
    }

    public function it_should_read_and_write_files_beneath_its_root()
    {
        $root = sys_get_temp_dir() . '/bm-local-spec-' . uniqid();
        $filesystem = $this->get(['root' => $root]);

        $filesystem->write('file.txt', 'contents');
        $filesystem->read('file.txt')->shouldBe('contents');

        $filesystem->delete('file.txt');
        $filesystem->fileExists('file.txt')->shouldBe(false);
        rmdir($root);
    }
}
