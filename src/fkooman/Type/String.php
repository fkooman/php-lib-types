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
     * @return int
     */
    public function compareTo(String $s)
    {
        $returnValue = strcmp($this->value, $s->getValue());
        if ($returnValue < 0) {
            return -1;
        } elseif ($returnValue > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @return int
     */
    public function compareToIgnoreCase(String $s)
    {
        $returnValue = strcasecmp($this->value, $s->getValue());
        if ($returnValue < 0) {
            return -1;
        } elseif ($returnValue > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @return String
     */
    public function concat(String $s)
    {
        return new String($this->value . $s->getValue());
    }

    /**
     * @return int
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
     * @return bool
     */
    public function isEmpty()
    {
        return 0 === $this->length();
    }

    /**
     * @return int
     */
    public function length()
    {
        return strlen($this->value);
    }

    /**
     * @return String
     */
    public function toLowerCase()
    {
        return new String(strtolower($this->value));
    }

    /**
     * @return String
     */
    public function toUpperCase()
    {
        return new String(strtoupper($this->value));
    }

    /**
     * @return String
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
     * @return String
     */
    public function trim()
    {
        return new String(trim($this->value));
    }
}
