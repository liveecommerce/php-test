<?php

namespace Live\Collection;

/**
 * Memory collection
 *
 * @package Live\Collection
 */
class MemoryCollection implements CollectionInterface
{
    /**
     * Collection data
     *
     * @var array
     */
    protected $data;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $index, $defaultValue = null)
    {
        if (!$this->has($index)) {
            return $defaultValue;
        }

        return $this->data[$index]['value'];
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $index, $value, $secondsToExpire = 5)
    {

        $this->data[$index] = ['value'=> $value, 'expires'=> time() + $secondsToExpire ];
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $index)
    {
        return array_key_exists($index, $this->data) && time() <= $this->data[$index]['expires'];
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
