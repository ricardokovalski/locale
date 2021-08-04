<?php

namespace RicardoKovalski\Locale;

/**
 *
 */
final class MyIterator implements \Iterator
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var int $position
     */
    protected $position = 0;

    /**
     * MyIterator constructor.
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->collection->getChar($this->position);
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
        return $this->position < $this->collection->count();
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = 0;
    }
}
