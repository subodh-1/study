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

namespace doganoo\PHPAlgorithmsTest\Util;

use doganoo\PHPAlgorithms\Datastructure\Lists\LinkedList\DoublyLinkedList;
use doganoo\PHPAlgorithms\Datastructure\Lists\LinkedList\SinglyLinkedList;
use doganoo\PHPAlgorithms\Datastructure\Lists\Node;
use stdClass;

/**
 * Class LinkedListUtil - utility class for testing linked lists
 */
class LinkedListUtil {

    /**
     * LinkedListUtil constructor is private in order to ensure
     * that the class is not instantiable.
     */
    private function __construct() {
    }

    /**
     * returns a doubly linked list containing three elements
     *
     * @return DoublyLinkedList
     */
    public static function getDoublyLinkedList(): DoublyLinkedList {
        $list = new DoublyLinkedList();
        $list->add(1, "one");
        $list->add(2, 1);
        $list->add(3, new stdClass());
        return $list;
    }

    /**
     * returns a doubly linked list with $n elements
     *
     * @param int $n the number of elements
     * @return DoublyLinkedList
     */
    public static function getCustomDoublyLinkedList(int $n): DoublyLinkedList {
        $list = new DoublyLinkedList();
        for ($i = 0; $i < $n; $i++) {
            $list->add($i + 1, md5((string) ($i + 1)));
        }
        return $list;
    }

    /**
     * returns a singly linked list containing three elements
     *
     * @return SinglyLinkedList
     */
    public static function getSinglyLinkedList(): SinglyLinkedList {
        $list = new SinglyLinkedList();
        $list->add(1, "one");
        $list->add(2, 1);
        $list->add(3, new stdClass());
        return $list;
    }

    /**
     * returns a singly linked list containing three elements with a loop
     *
     * @return DoublyLinkedList
     */
    public static function getDoublyLinkedListWithLoop(): DoublyLinkedList {
        $list  = new DoublyLinkedList();
        $one   = LinkedListUtil::getNode(1, "one");
        $two   = LinkedListUtil::getNode(1, 2);
        $three = LinkedListUtil::getNode(1, new stdClass());

        $one->setNext($two);
        $one->setPrevious(null);
        $two->setNext($three);
        $two->setPrevious($one);
        $three->setNext($one);
        $three->setPrevious($two);

        $list->setHead($one);
        return $list;
    }

    /**
     * creates a node instance with the given parameters
     *
     * @param mixed $key
     * @param mixed $value
     * @param null  $next
     * @param null  $prev
     * @return Node
     */
    public static function getNode($key, $value, $next = null, $prev = null): Node {
        $node = new Node();
        $node->setKey($key);
        $node->setValue($value);
        $node->setNext($next);
        $node->setPrevious($prev);
        return $node;
    }

    public static function createSinglyLinkedListFromArray(array $array): SinglyLinkedList {
        $list = new SinglyLinkedList();
        foreach ($array as $key => $value) {
            $list->add($key, $value);
        }
        return $list;
    }

    public static function createDoublyLinkedListFromArray(array $array): DoublyLinkedList {
        $list = new DoublyLinkedList();
        foreach ($array as $key => $value) {
            $list->add($key, $value);
        }
        return $list;
    }

}