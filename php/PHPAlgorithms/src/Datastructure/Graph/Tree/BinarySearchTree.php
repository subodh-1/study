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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree;

use doganoo\PHPAlgorithms\Algorithm\Sorting\MergeSort;
use doganoo\PHPAlgorithms\Common\Abstracts\AbstractTree;
use doganoo\PHPAlgorithms\Common\Exception\InvalidSearchComparisionException;
use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree\BinarySearchNode;
use function count;

/**
 * Class BinarySearchTree
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Graph\Tree
 */
class BinarySearchTree extends AbstractTree {

    private int $size = 0;

    /**
     * inserts a value that is not a BinarySearchNode instance
     *
     * @param $value
     * @return bool
     */
    public function insertValue($value): bool {
        return $this->insert(new BinarySearchNode($value));
    }

    /**
     * inserts a new value
     *
     * @param IBinaryNode|null $node
     * @return bool
     */
    public function insert(?IBinaryNode $node): bool {
        if (null === $node) return false;

        /** @var BinarySearchNode $root */
        $root = $this->getRoot();

        if (null === $root) {
            $this->setRoot($node);
            $this->size++;
            return true;
        }

        if (Comparator::lessThan($node->getValue(), $root->getValue())) {
            while (null !== $root->getLeft()) {
                $root = $root->getLeft();
            }
            $root->setLeft($node);
            $this->size++;
            return true;
        } else if (Comparator::greaterThan($node->getValue(), $root->getValue())) {
            while (null !== $root->getRight()) {
                $root = $root->getRight();
            }
            $root->setRight($node);
            $this->size++;
            return true;
        }

        return false;
    }

    /**
     * converts an array to an BST. Be careful using this method. If you have an ordered array
     * you will get an non-optimal BST! Use createFromArrayWithMinimumHeight() if you want an
     * BST with minimum height.
     *
     * @param array|null $array
     * @return BinarySearchTree|null
     */
    public static function createFromArray(?array $array): ?BinarySearchTree {
        $tree = new BinarySearchTree();
        if (null === $array) {
            return null;
        }

        if (0 === count($array)) {
            return $tree;
        }

        foreach ($array as $element) {
            if (null === $element) {
                continue;
            }
            $tree->insertValue($element);
        }

        return $tree;
    }

    /**
     * converts an array to a BST with minimum height.
     *
     * @param array|null $array
     * @return BinarySearchTree|null
     */
    public static function createFromArrayWithMinimumHeight(?array $array): ?BinarySearchTree {
        if (null === $array) {
            return null;
        }
        $tree = new BinarySearchTree();
        if (0 === count($array)) {
            return $tree;
        }
        $sort  = new MergeSort();
        $array = $sort->sort($array);
        $root  = BinarySearchTree::_createFromArrayWithMinimumHeight($array, 0, count($array) - 1);
        $tree  = new BinarySearchTree();
        $tree->setRoot($root);
        return $tree;
    }

    /**
     * helper method for createFromArrayWithMinimumHeight()
     *
     * @param array $array
     * @param int   $start
     * @param int   $end
     * @return IBinaryNode|null
     */
    private static function _createFromArrayWithMinimumHeight(array $array, int $start, int $end): ?IBinaryNode {
        if ($end < $start) {
            return null;
        }
        $middle = (int) (($start + $end) / 2);
        $value  = $array[$middle];

        if (null === $value) {
            return null;
        }
        $node      = new BinarySearchNode($array[$middle]);
        $leftNode  = BinarySearchTree::_createFromArrayWithMinimumHeight($array, $start, $middle - 1);
        $rightNode = BinarySearchTree::_createFromArrayWithMinimumHeight($array, $middle + 1, $end);
        $node->setLeft($leftNode);
        $node->setRight($rightNode);
        return $node;
    }

    /**
     * searches a value
     *
     * @param $value
     * @return BinarySearchNode|null
     * @throws InvalidSearchComparisionException
     */
    public function search($value): ?BinarySearchNode {
        /** @var BinarySearchNode $node */
        $node = $this->getRoot();
        while (null !== $node) {
            if (Comparator::equals($value, $node->getValue())) {
                return $node;
            } else if (Comparator::lessThan($value, $node->getValue())) {
                $node = $node->getLeft();
            } else if (Comparator::greaterThan($value, $node->getValue())) {
                $node = $node->getRight();
            } else {
                throw new InvalidSearchComparisionException("no comparision returned true. Maybe you passed different data types (scalar, object)?");
            }
        }
        return null;
    }

    /**
     * returns the number of nodes in the tree
     *
     * @return int
     */
    public function getSize(): int {
        return $this->size;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array {
        return
            parent::jsonSerialize() +
            [
                "root"   => $this->getRoot()
                , "size" => $this->getSize()
            ];
    }

}