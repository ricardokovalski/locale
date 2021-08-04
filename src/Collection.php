<?php

namespace RicardoKovalski\Locale;

/**
 * Class Collection
 * @package RicardoKovalski\Locale
 */
final class Collection implements \Countable, \Iterator
{
    /**
     * @var array
     */
    private $chars = [];

    /**
     * @var int $position
     */
    protected $position = 0;

    /**
     * @param array $chars
     */
    public function __construct(array $chars)
    {
        foreach ($chars as $char) {
            $this->appendChar($char);
        }
    }

    /**
     * @param $char
     * @return $this
     */
    public function appendChar($char)
    {
        array_push($this->chars, $char);
        return $this;
    }

    /**
     * @param $char
     * @return mixed
     */
    public function getChar($char)
    {
        return $this->chars[$char];
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->chars);
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->getChar($this->position);
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->position++;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return $this->position < $this->count();
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = 0;
    }
}
