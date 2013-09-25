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

use OutOfRangeException;

class StringTest extends \PHPUnit_Framework_TestCase
{
    public function testString()
    {
        $s = new String("foo");
        $this->assertEquals("foo", $s->getValue());
        $this->assertEquals(3, $s->length());
        $this->assertFalse($s->isEmpty());
    }

    public function testEmptyString()
    {
        $s = new String("");
        $this->assertEquals("", $s->getValue());
        $this->assertEquals(0, $s->length());
        $this->assertTrue($s->isEmpty());
    }

    public function testEmptyStringNoParameter()
    {
        $s = new String();
        $this->assertEquals("", $s->getValue());
        $this->assertEquals(0, $s->length());
        $this->assertTrue($s->isEmpty());
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

    public function testCompareTo()
    {
        $s = new String("foo");
        $t = new String("bar");
        $this->assertEquals(1, $s->compareTo($t));
        $this->assertEquals(-1, $t->compareTo($s));
        $this->assertEquals(0, $s->compareTo($s));
    }

    public function testCompareToIgnoreCase()
    {
        $s = new String("FoO");
        $t = new String("bAr");
        $this->assertEquals(1, $s->compareToIgnoreCase($t));
        $this->assertEquals(-1, $t->compareToIgnoreCase($s));
        $this->assertEquals(0, $s->compareToIgnoreCase($s));
    }

    public function testConcat()
    {
        $s = new String("foo");
        $t = new String("bar");
        $this->assertEquals("foobar", $s->concat($t)->__toString());
    }

    public function testIndexOf()
    {
        $s = new String("foobar");
        $this->assertEquals(3, $s->indexOf(new String("bar")));
    }

    public function testIndexOfNonExisting()
    {
        $s = new String("foobar");
        $this->assertEquals(-1, $s->indexOf(new String("baz")));
    }

    public function testSplitNoMatch()
    {
        $s = new String("foo");
        $splitArray = $s->split(new String(":"));
        $this->assertEquals(1, count($splitArray));
        $this->assertEquals("foo", $splitArray[0]->__toString());
    }

    public function testSplitSimple()
    {
        $s = new String("foo:bar");
        $splitArray = $s->split(new String(":"));
        $this->assertEquals(2, count($splitArray));
        $this->assertEquals("foo", $splitArray[0]->__toString());
        $this->assertEquals("bar", $splitArray[1]->__toString());
    }

    public function testSplitAdvanced()
    {
        $s = new String("boo:and:foo");
        $splitArray = $s->split(new String("o"));
        $this->assertEquals(3, count($splitArray));
        $this->assertEquals("b", $splitArray[0]->__toString());
        $this->assertEquals("", $splitArray[1]->__toString());
        $this->assertEquals(":and:f", $splitArray[2]->__toString());
    }

    public function testToLowerCase()
    {
        $s = new String("FOO_Bar");
        $this->assertEquals("foo_bar", $s->toLowerCase()->__toString());
    }

    public function testToUpperCase()
    {
        $s = new String("foo_BAR");
        $this->assertEquals("FOO_BAR", $s->toUpperCase()->__toString());
    }

    public function testSubstringOneParameter()
    {
        $s = new String("hamburger");
        $this->assertEquals("urger", $s->substring(4)->__toString());
    }

    public function testSubstringTwoParameters()
    {
        $s = new String("hamburger");
        $this->assertEquals("urge", $s->substring(4, 8)->__toString());
        $t = new String("smiles");
        $this->assertEquals("mile", $t->substring(1, 5)->__toString());
        $u = new String("smiles");
        $this->assertEquals("smiles", $u->substring(0, 6)->__toString());
        $v = new String("smiles");
        $this->assertEquals("", $v->substring(1, 1)->__toString());
    }

    /**
     * @expectedException OutOfRangeException
     * @expectedExceptionMessage negative index
     */
    public function testSubstringNegativeBeginIndex()
    {
        $s = new String("hamburger");
        $s->substring(-1);
    }

    /**
     * @expectedException OutOfRangeException
     * @expectedExceptionMessage negative index
     */
    public function testSubstringInvalidNegativeEndIndex()
    {
        $s = new String("hamburger");
        $s->substring(0, -1);
    }

    /**
     * @expectedException OutOfBoundsException
     * @expectedExceptionMessage begin index exceeds string length
     */
    public function testSubstringOutOfBoundsBeginIndex()
    {
        $s = new String("hamburger");
        $s->substring(100);
    }

    /**
     * @expectedException OutOfBoundsException
     * @expectedExceptionMessage end index exceeds string length
     */
    public function testSubstringOutOfBoundsEndIndex()
    {
        $s = new String("hamburger");
        $s->substring(0, 100);
    }

    /**
     * @expectedException OutOfRangeException
     * @expectedExceptionMessage end index bigger than begin index
     */
    public function testSubstringEndIndexBeforeBeginIndex()
    {
        $s = new String("hamburger");
        $s->substring(3, 2);
    }

    public function testTrim()
    {
        $s = new String("  foo bar  ");
        $this->assertEquals("foo bar", $s->trim()->__toString());
    }
}
