<?php

namespace RicardoKovalski\Locale;

/**
 *
 */
final class Collection implements \Countable, \IteratorAggregate
{
    /**
     * @var array
     */
    private $chars = [];

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
     * @return MyIterator
     */
    public function getIterator()
    {
        return new MyIterator($this);
    }
}
