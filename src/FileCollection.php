<?php

namespace Live\Collection;

/**
 * File collection
 *
 * @package Live\Collection
 */
class FileCollection
{
    /**
     * Index
     *
     * @var string
     */
    const INDEX = 'file_collection';

    /**
     * @var MemoryCollection
     */
    protected $memoryCollection;

    /**
     * FileCollection constructor.
     * @param string $file
     * @param int $expires In seconds
     * @return void
     */
    public function __construct(string $file, int $expires)
    {
        $this->memoryCollection = new MemoryCollection();

        $this->set($file, $expires);
    }

    /**
     * Get
     *
     * @param mixed|null $defaultValue
     * @return string|null
     */
    public function get($defaultValue = null)
    {
        return $this->memoryCollection->get(self::INDEX, $defaultValue);
    }

    /**
     * Set file
     *
     * @param string $file
     * @param int $expires
     */
    public function set(string $file, int $expires)
    {
        if (empty($file)) {
            return ;
        }
        $this->memoryCollection->set(self::INDEX, $file, $expires);
    }

    /**
     * Count
     *
     * @return int
     */
    public function count()
    {
        return $this->memoryCollection->count();
    }

    /**
     * Clean
     *
     * @return void
     */
    public function clean()
    {
        $this->memoryCollection->clean();
    }

    /**
     * File available
     *
     * @return bool
     */
    public function has()
    {
        return $this->memoryCollection->has(self::INDEX);
    }
}
