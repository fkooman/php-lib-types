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

class BooleanTest extends \PHPUnit_Framework_TestCase
{
    public function testContructor()
    {
        $s = new Boolean(true);
        $this->assertEquals(true, $s->getValue());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage not a boolean
     */
    public function testNonBooleanParameter()
    {
        $s = new Boolean(1);
    }

    public function testToStringTrue()
    {
        $s = new Boolean(true);
        $this->assertEquals("true", $s->__toString());
    }

    public function testToStringFalse()
    {
        $s = new Boolean(false);
        $this->assertEquals("false", $s->__toString());
    }
}
