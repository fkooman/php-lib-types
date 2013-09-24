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

class StringTest extends \PHPUnit_Framework_TestCase
{
    public function testContructor()
    {
        $s = new String("foo");
        $this->assertEquals("foo", $s->getValue());
        $this->assertEquals(3, $s->length());
    }

    public function testEmptyString()
    {
        $s = new String("");
        $this->assertEquals("", $s->getValue());
        $this->assertEquals(0, $s->length());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage not a string
     */
    public function testNonStringParameter()
    {
        $s = new String(123);
    }

    public function testToString()
    {
        $s = new String("foo");
        $this->assertEquals("foo", $s->__toString());
    }
}
