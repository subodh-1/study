<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\PHPAlgorithms\Datastructure\Stackqueue;

use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use JsonSerializable;
use function array_diff;
use function count;

/**
 * PHP implementation of a Queue
 * See here for more information: https://www.geeksforgeeks.org/queue-set-1introduction-and-array-implementation/
 *
 * Queues work according to the FIFO principe (FIRST IN FIRST OUT). This means, that the first element
 * pushed to the enqueued is dequeued first as well (imagine a ticket line for concerts where people are
 * waiting to buy a ticket).
 *
 *
 * Class Queue
 *
 * @package StackQueue
 */
class Queue implements IComparable, JsonSerializable {

    private array $queue = [];
    private int   $head  = 0;
    private int   $tail  = 0;

    /**
     * this methods adds an item to the queue to the last index
     *
     * @param $item
     * @return bool
     */
    public function enqueue($item): bool {
        if (!$this->isValid()) return false;

        $this->queue[$this->head] = $item;
        $this->head++;
        return true;
    }

    /**
     * checks if the stack element (the array) is valid
     *
     * @return bool
     */
    protected function isValid(): bool {
        return true;
    }

    /**
     * this method removes the first element from the queue and returns it
     *
     * @return mixed|null
     */
    public function dequeue() {
        if ($this->tail > $this->head) return null;
        $item = $this->queue[$this->tail];
        $this->tail++;
        return $item;
    }

    /**
     * returns the first element from the queue
     *
     * @return mixed|null
     */
    public function front() {
        if ($this->tail > $this->head) return null;
        return $this->queue[$this->tail];
    }

    /**
     * returns the last item from the queue
     *
     * @return mixed|null
     */
    public function rear() {
        if (!isset($this->queue[$this->head])) return null;
        return $this->queue[$this->head];
    }

    /**
     * returns a boolean which indicates whether the queue is empty or not
     *
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->tail === $this->head;
    }

    /**
     * wrapper function for queueSize()
     *
     * @return int
     */
    public function size(): int {
        if ($this->tail > $this->head) return 0;
        return $this->head - $this->tail;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof Queue) {
            if (count(array_diff($this->queue, $object->queue)) === 0) return IComparable::EQUAL;
            if (count($this->queue) < count($object->queue)) return IComparable::IS_LESS;
            if (count($this->queue) > count($object->queue)) return IComparable::IS_GREATER;
        }
        return IComparable::IS_LESS;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(): array {
        return [
            "queue"  => $this->queue
            , "head" => $this->head
            , "tail" => $this->tail
        ];
    }

}