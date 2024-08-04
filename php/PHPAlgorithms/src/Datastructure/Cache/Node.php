<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
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

namespace doganoo\PHPAlgorithms\Datastructure\Cache;

use doganoo\PHPAlgorithms\Common\Interfaces\INode;

/**
 * Class Node
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Cache
 */
class Node implements INode {

    private $key;
    private $value;
    private $previous;
    private $next;

    /**
     * Node constructor.
     *
     * @param null $key
     * @param null $value
     */
    public function __construct($key = null, $value = null) {
        $this->key   = $key;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getPrevious() {
        return $this->previous;
    }

    /**
     * @param mixed $previous
     */
    public function setPrevious($previous): void {
        $this->previous = $previous;
    }

    /**
     * @return mixed
     */
    public function getNext() {
        return $this->next;
    }

    /**
     * @param mixed $next
     */
    public function setNext($next): void {
        $this->next = $next;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey($key): void {
        $this->key = $key;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof Node) {
            if ($this->getValue() === $object->getValue()) return 0;
            if ($this->getValue() < $object->getValue()) return -1;
            if ($this->getValue() > $object->getValue()) return 1;
        }
        return -1;
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
            "value"      => $this->value
            , "key"      => $this->key
            , "next"     => $this->next
            , "previous" => $this->previous,
        ];
    }

}