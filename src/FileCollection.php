<?php

namespace Live\Collection;

/**
 * Memory collection
 *
 * @package Live\Collection
 */
class FileCollection implements CollectionInterface
{    
    /**
     * Collection data
     *
     * @var array
     */
    protected $data;
    protected $dataFile;
    
    /**
     * Constructor
     */
    public function __construct(string $dataFile)
    {
        $this->dataFile = $dataFile;
        
        $file = fopen($this->dataFile, 'r+');

        if (filesize($this->dataFile) > 0) {
            $stringArray = fread($file, filesize($this->dataFile));
            $array = json_decode($stringArray, true);
            $this->data = $array;
        }
        fclose($file);
    }
     
    /**
     * {@inheritDoc}
     */
    public function get(string $index, $defaultValue = null)
    {     
        if (!$this->has($index)) {
            return $defaultValue;
        }
        return $this->data[$index];
    }
    
    /**
     * {@inheritDoc}
     */
    public function set(string $index, $value)
    {
        $this->data[$index] = $value;
        $file = fopen($this->dataFile, 'w');
        $json1 = json_encode($this->data);
        fwrite($file, $json1);
        fclose($file);
        return $this->data;
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $index): bool
    {
        return array_key_exists($index, $this->data); 
    }

    /**
     * {@inheritDoc}
     */
    public function count(): int
    {
        return count($this->data);
    }
    
    /**
     * {@inheritDoc}
     */
    public function clean()
    {
        $this->data = [];
    }
}
