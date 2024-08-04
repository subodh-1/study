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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Trie;

use doganoo\PHPAlgorithms\Common\Interfaces\INode;

/**
 * Class RootNode
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Trie
 */
class RootNode extends Node implements INode {

    /**
     * @const ROOT_NODE
     */
    public const ROOT_NODE = "ROOT_NODE";

    /**
     * RootNode constructor.
     */
    public function __construct() {
        $this->setValue(self::ROOT_NODE);
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof RootNode) {
            if ($this->getValue() === $object->getValue()) return 0;
            if ($this->getValue() < $object->getValue()) return -1;
            if ($this->getValue() > $object->getValue()) return 1;
        }
        return -1;
    }

    public function jsonSerialize(): array {
        $serializable         = parent::jsonSerialize();
        $serializable["type"] = RootNode::ROOT_NODE;
        return $serializable;
    }

}