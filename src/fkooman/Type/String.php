<?php

/**
* Copyright 2013 François Kooman <fkooman@tuxed.net>
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/

namespace fkooman\Type;

use InvalidArgumentException;
use OutOfBoundsException;
use OutOfRangeException;

class String extends BaseType
{
    public function __construct($value = '')
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("not a string");
        }
        parent::__construct($value);
    }

    /**
     * Compare two strings.
     *
     * @param $s     the string to compare against
     * @return int 0 when strings are equals
     *             < 0 when this string is smaller than provided string
     *             > 0 when this string is bigger than provided string
     */
    public function compareTo(String $s)
    {
        return strcmp($this->value, $s->getValue());
    }

    /**
     * Compare two strings, case insensitively.
     *
     * @param $s     the string to compare against
     * @return int 0 when strings are equals
     *             < 0 when this string is smaller than provided string
     *             > 0 when this string is bigger than provided string
     */
    public function compareToIgnoreCase(String $s)
    {
        return strcasecmp($this->value, $s->getValue());
    }

    /**
     * Add provided string to the end of this string.
     *
     * @param $s the string to add to the end of this string
     * @return String the concatenated string
     */
    public function concat(String $s)
    {
        return new String($this->value . $s->getValue());
    }

    /**
     * Determine the index of the first occurrence of provided string.
     *
     * @param $s the string to search for
     * @return int the position starting at 0 for the provided string in this
     *             string
     */
    public function indexOf(String $s)
    {
        $returnValue = strpos($this->value, $s->getValue());
        if (false === $returnValue) {
            return -1;
        }

        return $returnValue;
    }

    /**
     * Determine whether this string is the empty string.
     *
     * @return bool true if string is empty, false if string is not empty
     */
    public function isEmpty()
    {
        return 0 === $this->length();
    }

    /**
     * Return the length of the string.
     *
     * @return int the length
     */
    public function length()
    {
        return strlen($this->value);
    }

    /**
     * Verify whether this string matches provided regular expression.
     *
     * @param $pattern the regular expression, without leading and trailing '/'
     * @return bool true if the pattern matches, false if it does not match
     */
    public function matches(String $pattern)
    {
        $matchPattern = new String('/');
        $matchPattern = $matchPattern->concat($pattern)->concat(new String('/'));
        $returnValue = @preg_match($matchPattern->getValue(), $this->value);
        if (false === $returnValue) {
            throw new InvalidArgumentException("invalid pattern");
        }

        return 1 === $returnValue;
    }

    /**
     * Split the string by the provided delimiter.
     *
     * @param $delimiter string to split at.
     * @return array returns an array of strings containing the split
     *               string at the delimiter. Removes trailing empty strings
     */
    public function split(String $delimiter)
    {
        $explodedString = explode($delimiter->getValue(), $this->value);
        $stringArray = array();
        foreach ($explodedString as $stringPart) {
            $stringArray[] = new String($stringPart);
        }
        // remove the empty strings at the end
        $i = count($stringArray) - 1;
        while ($stringArray[$i]->isEmpty()) {
            unset($stringArray[$i]);
            $i--;
        }

        return array_values($stringArray);
    }

    /**
     * Convert string to lowercase.
     *
     * @return String the string as lowercase
     */
    public function toLowerCase()
    {
        return new String(strtolower($this->value));
    }

    /**
     * Convert string to uppercase.
     *
     * @return String the string as uppercase
     */
    public function toUpperCase()
    {
        return new String(strtoupper($this->value));
    }

    /**
     * Determine if this string starts with provided prefix.
     *
     * @param $prefix the prefix to check
     * @return bool true if this string starts with provided prefix, false if
     *              the this string does not start with provided prefix
     */
    public function startsWith(String $prefix)
    {
        return 0 === $this->indexOf($prefix);
    }

    /**
     * Extract a portion of the string.
     *
     * @param $beginIndex the index to start from, index start at 0
     * @param $endIndex   the index to stop at, length of returned string is
     *                    endIndex - beginIndex
     * @return String the substring between beginIndex and endIndex
     */
    public function substring($beginIndex, $endIndex = null)
    {
        $b = new Integer($beginIndex);
        if (null === $endIndex) {
            $e = new Integer($this->length());
        } else {
            $e = new Integer($endIndex);
        }

        if (0 > $b->getValue()) {
            throw new OutOfRangeException("negative index");
        }
        if ($this->length() <= $b->getValue()) {
            throw new OutOfBoundsException("begin index exceeds string length");
        }
        if (0 > $e->getValue()) {
            throw new OutOfRangeException("negative index");
        }
        if ($this->length() < $e->getValue()) {
            throw new OutOfBoundsException("end index exceeds string length");
        }
        if ($b->getValue() > $e->getValue()) {
            throw new OutOfRangeException("end index bigger than begin index");
        }

        return new String(
            substr(
                $this->value,
                $b->getValue(),
                $e->getValue() - $b->getValue()
            )
        );
    }

    /**
     * Remove whitespace from start and end of string.
     *
     * @return String the trimmed string
     */
    public function trim()
    {
        return new String(trim($this->value));
    }
}
