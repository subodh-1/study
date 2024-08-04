<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * @author Eugene Kirillov <eug.krlv@gmail.com>
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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Graph;

use doganoo\PHPAlgorithms\Common\Interfaces\INode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayList\ArrayList;

/**
 * Class Node
 *
 * @package doganoo\PHPAlgorithms\Graph
 */
class Node implements INode {

    /** @var mixed $value */
    private           $value;
    private ArrayList $adjacent;
    private int       $inbound;


    /**
     * Node constructor.
     *
     * @param $value
     */
    public function __construct($value) {
        $this->value    = $value;
        $this->adjacent = new ArrayList();
        $this->inbound  = 0;
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function addAdjacent(Node $node): bool {
        return $this->adjacent->add($node);
    }

    /**
     * @return void
     */
    public function incrementInbound(): void {
        $this->inbound++;
    }

    /**
     * @return void
     */
    public function decrementInbound(): void {
        $this->inbound--;
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function hasAdjacent(Node $node): bool {
        /**
         * @var      $key
         * @var Node $value
         */
        foreach ($this->adjacent as $key => $value) {
            if (Comparator::equals($value->getValue(), $node->getValue())) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function equals(Node $node): bool {
        return $this->compareTo($node) === 0;
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
     * @return ArrayList
     */
    public function getAdjacents(): ArrayList {
        return $this->adjacent;
    }

    /**
     * @return int
     */
    public function countInbound(): int {
        return $this->inbound;
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
            , "adjacent" => $this->adjacent
            , "inbound"  => $this->inbound,
        ];
    }

}