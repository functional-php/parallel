<?php

namespace FunctionalPHP\Parallel;

/**
 * @param int $threads number of threads to use
 * @param callable $callable the callable used for mapping
 * @param array|\Traversable $collection the collection you want to map over
 * @return mixed the result
 */
function map($threads, callable $callable, $collection)
{
    $results = _parallel($threads, function(array $chunk) use($callable) {
        return array_map($callable, $chunk);
    }, $collection);

    return call_user_func_array('array_merge', $results);
}

/**
 * @param int $threads number of threads to use
 * @param callable $predicate the predicate used for filtering
 * @param array|\Traversable $collection the collection you want to filter
 * @return mixed the result
 */
function filter($threads, callable $predicate, $collection)
{
    $results = _parallel($threads, function(array $chunk) use($predicate) {
        return array_filter($chunk, $predicate);
    }, $collection);

    return call_user_func_array('array_merge', $results);
}

/**
 * @param int $threads number of threads to use
 * @param callable $callable the callable used for folding
 * @param array|\Traversable $collection the collection you want to fold
 * @param mixed $initial initial value for the fold
 * @return mixed the result
 */
function fold($threads, callable $callable, $collection, $initial)
{
    $func = function(array $chunk) use($callable, $initial) {
        return array_reduce($chunk, $callable, $initial);
    };

    $results = _parallel($threads, $func, $collection);

    return $func($results);
}

/**
 * @param int $threads
 * @param callable $callable
 * @param array|\Traversable $collection
 * @return array
 */
function _parallel($threads, callable $callable, $collection)
{
    $threads = array_map(function($chunk) use($callable) {
        return new Parallel($callable, $chunk);
    }, _chunks($threads, $collection));

    return array_map(function(Parallel $t) {
        return $t->get();
    }, $threads);
}

/**
 * @param int $size
 * @param array|\Traversable  $collection
 * @return array
 */
function _chunks($size, $collection)
{
    $collection = is_array($collection) ? $collection : iterator_to_array($collection);
    return array_chunk($collection, ceil(count($collection) / $size));
}
