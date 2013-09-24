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

class String extends BaseType
{
    public function __construct($value)
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("not a string");
        }
        parent::__construct($value);
    }

    /**
     * Returns the length of the string
     * @return int
     */
    public function length()
    {
        return strlen($this->value);
    }

    /**
     * Return the position of string
     * @param String s the string to find the position of
     * @return int|false the position of s in this string starting from 0, or
     *                   false if s was not found
     */
    public function indexOf(String $s)
    {
        return strpos($this->value, $s->getValue());
    }

    public function isEmpty()
    {
        return 0 === $this->length();
    }

    public function trim()
    {
        return new String(trim($this->value));
    }

    public function toUpperCase()
    {
        return new String(strtoupper($this->value));
    }

    public function toLowerCase()
    {
        return new String(strtolower($this->value));
    }

    public function subString($offset, $length)
    {
        $o = new Integer($offset);
        $l = new Integer($length);
        if (0 > $o->getValue()) {
            throw new OutOfBoundsException("negative offset");
        }
        if ($this->length() < $o->getValue()) {
            throw new OutOfBoundsException("offset outside of string boundary");
        }
        if ($this->length() < $o->getValue() + $l->getValue()) {
            throw new OutOfBoundsException("length outside of string boundary");
        }

        return new String(substr($this->value, $o->getValue(), $l->getValue()));
    }
}
