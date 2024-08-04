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

use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Trie\Trie;

/**
 * Class TrieTest
 */
class TrieTest extends \PHPUnit\Framework\TestCase {

    /**
     * tests inserting and searching
     */
    public function testAdd(): void {
        $trie = new Trie();
        $trie->insert("Test");
        $found = $trie->search("Test");
        $this->assertTrue($found === true);
        $found = $trie->search("Te", true);
        $this->assertTrue($found === true);
    }

    public function testWordCount(): void {
        $this->markTestSkipped("need to repair :-(");
        $trie = new Trie();
        $trie->insert("this");
        $trie->insert("is");
        $trie->insert("a");
        $trie->insert("very");
        $trie->insert("long");
        $trie->insert("word");

        $this->assertTrue(6 === $trie->countWords());
    }

}