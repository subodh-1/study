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

namespace doganoo\PHPAlgorithms\Common\Abstracts;

use doganoo\PHPAlgorithms\Common\Interfaces\ISet;
use function crc32;
use function spl_object_hash;

/**
 * Class AbstractSet
 *
 * @package doganoo\PHPAlgorithms\Common\Abstracts
 */
abstract class AbstractSet implements ISet {

    /**
     * Compares the specified object with this set for equality.
     *
     * @param $object
     * @return bool
     */
    public function equals($object): bool {
        return $this->compareTo($object) === 0;
    }

    /**
     * Returns the hash code value for this set.
     *
     * @return int
     */
    public function hashCode(): int {
        return crc32(spl_object_hash($this));
    }

    /**
     * Removes from this set all of its elements that are contained in the specified collection (optional operation).
     *
     * @param $elements
     * @return bool
     */
    public function removeAll($elements): bool {
        $removed = false;
        foreach ($elements as $element) {
            $removed |= $this->remove($element);
        }
        return $removed;
    }

}