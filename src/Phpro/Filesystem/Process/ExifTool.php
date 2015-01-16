<?php

namespace Phpro\Filesystem\Process;

use Phpro\Filesystem\File\FileInterface;
use Phpro\Filesystem\Options\ExifToolOptions;
use RuntimeException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class ExifTool
 */
class ExifTool
{
    /**
     * @var string
     */
    protected $executable;

    /**
     * @var ExifToolOptions
     */
    protected $options;

    /**
     * @param ExifToolOptions $options
     */
    public function __construct(ExifToolOptions $options)
    {
        $this->executable = $options->getExecutable();
        $this->options = $options;
    }

    /**
     * @param $executable
     * @throws
     */
    protected function guardIsExecutable($executable)
    {
        if (!file_exists($executable) || !is_executable($executable)) {
            throw new \RuntimeException('Configured exiftool location is not executable: '.$executable);
        }
    }

    /**
     * @param $tag
     * @throws
     */
    protected function guardIsValidTag($tag)
    {
        if (!in_array(strtolower($tag), $this->options->getAllowedTags())) {
            throw new \RuntimeException('Invalid tag: ', $tag);
        }
    }

    /**
     * @return ProcessBuilder
     */
    protected function createProcessBuilder()
    {
        $this->guardIsExecutable($this->executable);

        $processBuilder = new ProcessBuilder();
        $processBuilder->setPrefix($this->executable);

        return $processBuilder;
    }

    /**
     * @param Process $process
     *
     * @return array
     */
    protected function runProcess(Process $process)
    {
        $process->run();
        if (!$process->isSuccessful()) {
            throw new \RuntimeException('Could not load the exiftool data: '.$process->getErrorOutput());
        }

        return json_decode($process->getOutput(), true);
    }

    /**
     * @param FileInterface $file
     * @param string        $tag
     *
     * @return mixed
     */
    public function scanFile(FileInterface $file, $tag = null)
    {
        // Create process
        $processBuilder = $this->createProcessBuilder();
        // Add basic parameters:
        $processBuilder->setArguments(['-g', '-json', '-struct']);

        // Set tag if it is configured
        if ($tag) {
            $this->guardIsValidTag($tag);
            $processBuilder->add('-'.strtolower($tag).':all');
        }

        // Add the file
        $processBuilder->add($file->getPath());

        // Run process:
        $process = $processBuilder->getProcess();

        $result = $this->runProcess($process);

        return $result[0];
    }
}
