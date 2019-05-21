<?php

namespace Live\Collection;

use Exception;

/**
 * File collection
 *
 * @package Live\Collection
 */
class FileCollection implements CollectionInterface
{
    /**
     * Collection files
     *
     * @var array
     */
    protected $files;

    /**
     * Constructor
     */
    public function __construct(string $completePath, string $index, int $secondsToExpire = 5)
    {
        if (file_exists($completePath) !== false && is_writable($completePath) && is_readable($completePath)) {
            $this->files[$index] = ['value'=> $completePath, 'expires'=> time() + $secondsToExpire];
        } else {
            throw new Exception('File Not Exists : ');
        }
    }

    /**
     * Open file when specifies the index of collection
     * @param string $index
     * @param string $mode the same mode using fopen
     * @return resource If $index is not found,
     * open will throw Exception.
     * @throws Exception if not found index
     */
    public function open(string $index, string $mode = 'r')
    {
        if ($this->has($index)) {
            $fileResource = $this->get($index);
            return is_string($fileResource) ? fopen($fileResource, $mode) : $fileResource;
        }
        throw new Exception('FileAccessException : do not have permission to open this file, check permissions');
    }

    /**
     * Read a file in collection
     * @param string $index
     * @param string $mode the same mode using fopen
     * @return string contains all contents of file
     * @throws Exception if not found index or file is not readable
     */
    public function read($index) : string
    {
        $fileResource = $this->open($index, 'r');
        $allFileContent= '';
        while (($line = fgets($fileResource)) !== false) {
            $allFileContent.= $line;
        }
        return $allFileContent;
    }

    /**
     * Read a file in collection
     * @param string $index
     * @param string $mode the same mode using fopen
     * @return string contains all contents of file
     * @throws Exception if not found index or file is not readable
     */
    public function write($index, $stringToWrite) : bool
    {
        $fileResource = $this->open($index, 'w');
        fwrite($fileResource, $stringToWrite);
        fclose($fileResource);
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $index, $defaultValue = null)
    {
        if (!$this->has($index)) {
            return $defaultValue;
        }

        return $this->files[$index]['value'];
    }
    
    /**
     * {@inheritDoc}
     */
    public function set(string $completePath, $index, $secondsToExpire = 5)
    {
        $this->files[$index] = ['value'=> $completePath, 'expires'=> $secondsToExpire ];
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $index)
    {
        return array_key_exists($index, $this->files) && time() <= $this->files[$index]['expires'];
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return count($this->files);
    }

    /**
     * {@inheritDoc}
     */
    public function clean()
    {
        $this->files = [];
    }
}
