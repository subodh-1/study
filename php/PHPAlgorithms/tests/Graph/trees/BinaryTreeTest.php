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

namespace doganoo\PHPAlgorithmsTest\Graph\trees;

use doganoo\PHPAlgorithms\Algorithm\Traversal\InOrder;
use doganoo\PHPAlgorithms\Algorithm\Traversal\PostOrder;
use doganoo\PHPAlgorithms\Algorithm\Traversal\PreOrder;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree;
use doganoo\PHPAlgorithmsTest\Util\TreeUtil;
use PHPUnit\Framework\TestCase;

class BinaryTreeTest extends TestCase {

    /**
     * tests addition and height
     */
    public function testAdd() {
        /** @var BinaryTree $bst */
        $bst  = TreeUtil::getBinaryTree();
        $node = $bst->search(1);
        $this->assertTrue($node !== null);
    }

    /**
     * tests in order Traversal
     */
    public function testInOrder() {
        /** @var BinaryTree $bst */
        $bst       = TreeUtil::getBinaryTree();
        $array     = [];
        $traversal = new InOrder($bst);
        $traversal->setCallable(function ($value) use (&$array) {
            $array[] = $value;
        });
        $traversal->traverse();
        $this->assertTrue($array === [1, 2, 5, 6]);
    }

    /**
     * tests pre order Traversal
     */
    public function testPreOrder() {
        /** @var BinaryTree $bst */
        $bst       = TreeUtil::getBinaryTree();
        $array     = [];
        $traversal = new PreOrder($bst);
        $traversal->setCallable(function ($value) use (&$array) {
            $array[] = $value;
        });
        $traversal->traverse();
        $this->assertTrue($array === [5, 2, 1, 6]);
    }

    /**
     * tests post order Traversal
     */
    public function testPostOrder() {
        /** @var BinaryTree $bst */
        $bst       = TreeUtil::getBinaryTree();
        $array     = [];
        $traversal = new PostOrder($bst);
        $traversal->setCallable(function ($value) use (&$array) {
            $array[] = $value;
        });
        $traversal->traverse();
        $this->assertTrue($array === [1, 2, 6, 5]);
    }

}