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

namespace doganoo\PHPAlgorithms\Datastructure\Map;

use doganoo\PHPAlgorithms\Common\Util\Comparator;
use function array_fill;
use function array_filter;
use function count;
use const ARRAY_FILTER_USE_BOTH;

/**
 * Class Map
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Map
 */
class Map {

    /** @var int MAX_SIZE */
    public const MAX_SIZE = 128;

    private array $map = [];

    /**
     * Map constructor.
     */
    public function __construct() {
        $this->clear();
    }

    /**
     * @return bool
     */
    public function clear(): bool {
        $this->map = array_fill(0, Map::MAX_SIZE, null);
        return true;
    }

    /**
     * @param $key
     * @param $value
     */
    public function add($key, $value): void {
        $this->map[$key] = $value;
    }

    /**
     * @return int
     */
    public function size(): int {
        $array = array_filter(
            $this->map,
            static function ($v, $k) {
                return $v !== null;
            },
            ARRAY_FILTER_USE_BOTH
        );
        return count($array);
    }

    /**
     * @param $value
     * @return bool
     */
    public function containsValue($value): bool {
        foreach ($this->map as $key => $val) {
            if (Comparator::equals($value, $val)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $key
     * @return bool
     */
    public function containsKey($key): bool {
        foreach ($this->map as $k => $val) {
            if (Comparator::equals($key, $k)) {
                return true;
            }
        }
        return false;
    }

}