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

namespace doganoo\PHPAlgorithmsTest\Table;

use doganoo\PHPAlgorithms\Common\Interfaces\IHashable;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayList\ArrayList;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use doganoo\PHPAlgorithmsTest\Table\Entity\HashableObject;
use doganoo\PHPAlgorithmsTest\Util\HashTableUtil;
use PHPUnit\Framework\TestCase;
use stdClass;

class HashTableTest extends TestCase {

    /**
     * tests adding new elements to the map
     */
    public function testAddition(): void {
        $class   = stdClass::class;
        $hashMap = new HashTable();
        $boolean = $hashMap->add(1, $class);
        $has     = $hashMap->getNodeByValue($class);
        $this->assertTrue($boolean);
        $this->assertTrue(null !== $has);
    }

    public function testSize(): void {
        $class   = stdClass::class;
        $hashMap = new HashTable();
        $hashMap->add(1, $class);
        $hashMap->add(2, $class);
        $hashMap->add(3, $class);
        $hashMap->add(4, $class);
        $hashMap->add(5, $class);

        $this->assertTrue($hashMap->size() === 5);
    }

    /**
     * tests querying the map for a value
     */
    public function testContains(): void {
        $class   = stdClass::class;
        $hashMap = new HashTable();
        $hashMap->add(1, $class);
        $boolean = $hashMap->containsValue($class);
        $this->assertTrue($boolean);
    }

    /**
     * tests retrieving a node from the map
     */
    public function testGetNodeByValue(): void {
        $class   = stdClass::class;
        $hashMap = new HashTable();
        $hashMap->add(1, $class);
        $node = $hashMap->getNodeByValue($class);
        $this->assertTrue($node !== null);
    }

    /**
     * tests removing a value from the map
     */
    public function testRemove(): void {
        $hashTable = new HashTable();
        $hashTable->put("about", new class {

        });
        $hashTable->put("account", new class {

        });
        $hashTable->put("apps", new class {

        });
        $hashTable->put("calorie_tracker", new class {

        });
        $hashTable->put("tnc", new class {

        });
        $hashTable->put("forgot_password", new class {

        });
        $hashTable->put("general_api", new class {

        });
        $hashTable->put("install", new class {

        });
        $hashTable->put("login", new class {

        });
        $hashTable->put("logout", new class {

        });
        $hashTable->put("maintenance", new class {

        });
        $hashTable->put("password_manager", new class {

        });
        $hashTable->put("promotion", new class {

        });
        $hashTable->put("register", new class {

        });
        $hashTable->put("users", new class {

        });
        $this->assertTrue(null !== $hashTable->get("calorie_tracker"));
        $hashTable->remove("calorie_tracker");
        $this->assertTrue(null === $hashTable->get("calorie_tracker"));
    }

    /**
     * tests adding different key types to the map
     */
    public function testKeyTypes(): void {
        $hashMap = new HashTable();
        $added   = $hashMap->add(new stdClass(), "stdClass");
        $this->assertTrue($added);
    }

    /**
     * tests adding different key types to the map
     */
    public function testFromIterable(): void {
        $array     = [1, 2, 3];
        $hashTable = HashTable::fromIterable($array);

        $this->assertTrue($hashTable->size() === 3);
        $this->assertTrue($hashTable->get(0) === 1);
        $this->assertTrue($hashTable->get(1) === 2);
        $this->assertTrue($hashTable->get(2) === 3);
    }

    /**
     * tests adding different key types to the map
     */
    public function testFromIterableArrayList(): void {
        $arrayList = new ArrayList();
        $arrayList->add(1);
        $arrayList->add(2);
        $arrayList->add(3);
        $hashTable = HashTable::fromIterable($arrayList);

        $this->assertTrue($hashTable->size() === 3);
        $this->assertTrue($hashTable->get(0) === 1);
        $this->assertTrue($hashTable->get(1) === 2);
        $this->assertTrue($hashTable->get(2) === 3);
    }

    /**
     * tests retrieving all keys from the map
     */
    public function testKeySet(): void {
        $hashMap = HashTableUtil::getHashTable(10);
        $keySet  = $hashMap->keySet();
        $this->assertTrue(count($keySet) == 10);
    }

    public function testClosure(): void {
        $hashMap = new HashTable();
        $added   = $hashMap->add("test", function () {
            return new stdClass();
        });
        $this->assertTrue($added);
        $added = $hashMap->add("test2", new class {

            public function x(): void {
            }

        });
        $this->assertTrue($added);
    }

    public function testHashableObject(): void {
        $obj   = new HashableObject("1");
        $table = new HashTable();
        $table->put($obj, "1");

        $this->assertTrue($table->size() === 1 && $table->get($obj) === "1");

        $obj2 = new HashableObject("1");
        $table->put($obj2, "2");
        $this->assertTrue($table->size() === 1 && $table->get($obj) === "2");

        $table->put("1", "3");
        $this->assertTrue(
            $table->size() === 2
            && $table->get($obj) === "2"
            && $table->get("1") === "3"
        );

        $this->assertInstanceOf(IHashable::class, $table->keySet()[0]);
        $this->assertTrue(is_string($table->keySet()[1]));
    }

}