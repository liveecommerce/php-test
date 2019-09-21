<?php

namespace Live\Collection;

/**
 * Memory collection
 *
 * @package Live\Collection\
 */
class FileCollection implements CollectionInterface
{

     /**
     * Collection data
     *
     * @var array
     */
    protected $data;
    protected $arquivoTexto;
    protected $filename;
    
    /**
     * Constructor
     */
    public function __construct(string $filename)
    {
 
        $this->filename = $filename;
        $this->data =[];
        $fp = fopen($this->filename, 'r+');
        //Pa
        
        if (filesize($this->filename) > 0) {
            $stringArray = fread($fp, filesize($this->filename));
            //Passo 3 - corrigir
            $array = json_decode($stringArray, true);
            //Passo 4

            $this->data = $array;
        }
        fclose($fp);
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
        $fp = fopen($this->filename, 'w');
        $json1 = json_encode($this->data);
        fwrite($fp, $json1);
        fclose($fp);
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
