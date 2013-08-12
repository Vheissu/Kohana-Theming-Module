<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');

class LoadTheme extends Unittest_TestCase
{
    public function setUp()
    {
        parent::setUp();
        // $this->markTestSkipped("Message");
    }

    /**
     * Test Load Actual Theme
     *
     * Simulate loading an actual theme
     *
     * @group keys
     *
     */
    public function testLoadActualTheme()
    {
        $key = Keys::Generate();

        $this->assertNotEquals(FALSE, $key);
    }

    /**
     * Test Load Nonexistent Theme
     *
     * Test what happens when a theme does not exist
     *
     * @expectedException               Kohana_Exception
     * @expectedExceptionMessage did not contain your replace character
     * @group keys
     *
     */
    public function testGenerateFormatWithoutReplaceChar()
    {
        $key = Keys::Generate("hdjas-skajdkasj-dj938-8848");
    }
}
