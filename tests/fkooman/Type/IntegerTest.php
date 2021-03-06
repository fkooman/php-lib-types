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

class IntegerTest extends \PHPUnit_Framework_TestCase
{
    public function testContructor()
    {
        $s = new Integer(5);
        $this->assertEquals(5, $s->getValue());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage not an integer
     */
    public function testNonIntegerParameter()
    {
        $s = new Integer("foo");
    }

    public function testToString()
    {
        $s = new Integer(5);
        $this->assertEquals("5", $s->__toString());
    }
}
