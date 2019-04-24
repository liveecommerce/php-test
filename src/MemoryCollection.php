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
     * Default file expires
     *
     * @var int Default in seconds
     */
    const EXPIRES = 60;

    /**
     * Collection data
     *
     * @var array
     */
    protected $data;

    /**
     * Expires in seconds
     *
     * @var string
     */
    protected $expires = self::EXPIRES;

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
    public function set(string $index, $value, int $expires = null)
    {
        if (empty($index) || empty($value)) {
            return ;
        }

        $this->setExpires($expires);

        $this->data[$index]['value'] = $value;
        $this->data[$index]['expires'] = $this->getExpires();
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $index)
    {
        if (!array_key_exists($index, $this->data)) {
            return false;
        }

        $data = $this->data[$index];

        $dateExpires = new \DateTime();
        $dateExpires->setTimestamp($data['expires']);
        $dateNow = new \DateTime();

        return $dateExpires >= $dateNow;
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

    /**
     * Set expiration
     *
     * @param int $seconds
     * @return void
     */
    protected function setExpires(int $seconds = null)
    {
        if (!is_null($seconds) && $seconds > 0) {
            $this->expires = $seconds;
        } else {
            $this->expires = self::EXPIRES;
        }
    }

    /**
     * Get expires
     *
     * @return int timestamp
     * @throws \Exception
     */
    protected function getExpires(): int
    {
        try {
            $date = new \DateTime();
            $date->add(new \DateInterval('PT' . $this->expires . 'S'));
            return $date->getTimestamp();
        } catch (\Exception $ex) {
            $date = new \DateTime();
            return $date->getTimestamp();
        }
    }
}
