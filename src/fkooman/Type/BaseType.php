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

class BaseType
{
    /** @var mixed */
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Get the value of this type.
     *
     * @return mixed the value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the value of this type as a string.
     *
     * @return string the value as a string
     */
    public function __toString()
    {
        return strval($this->value);
    }
}
