<?php

namespace FunctionalPHP\Parallel;

class Parallel extends \Thread
{
    private $collection;
    private $callable;

    private $result;

    public function __construct(callable $callable, $collection)
    {
        $this->callable = $callable;
        $this->collection = $collection;

        $this->start();
    }


    public function run()
    {
        $this->result = call_user_func($this->callable, $this->collection);
    }

    public function get()
    {
        if(! $this->isJoined()) {
            $this->join();
        }

        return $this->result;
    }
}