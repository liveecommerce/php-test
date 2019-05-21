<?php

namespace Live\Collection;

use PHPUnit\Framework\TestCase;

class FileCollectionTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function objectCanBeConstructed()
    {
        $collection = new FileCollection('files/test.txt', 'test');
        return $collection;
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function cannotCreateOrSetFileIfNotExists()
    {
        try {
            $collection = new FileCollection('files/content.txt', 'test');
        } catch (\Exception $e) {
            $this->assertFalse(false);
        }

        $collection = new FileCollection('files/test.txt', 'test');
        $collection->set('files/content_not_exists.txt', 'test2', 5);
        try {
            $collection->open('test2');
        } catch (\Exception $e) {
            $this->assertFalse(false);
        }
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     * @doesNotPerformAssertions
     */
    public function fileCanBeAdded()
    {
        $collection = new FileCollection('files/test.txt', 'test', 5);
        $collection->set('files/test2.txt', 'test2', 5);
    }

    /**
     * @test
     * @depends fileCanBeAdded
     * @doesNotPerformAssertions
     */
    public function fileCanBeOpen()
    {
        $collection = new FileCollection('files/test.txt', 'test');
        $collection->open('test');
    }

    /**
     * @test
     * @depends fileCanBeOpen
     */
    public function fileCannotBeUseAfterExpires()
    {
        $collection = new FileCollection('files/test.txt', 'test', 3);
        sleep(4);
        $this->assertFalse($collection->has('test'));
    }

    /**
     * @test
     * @depends fileCanBeOpen
     */
    public function dataCanBeWrite()
    {
        $collection = new FileCollection('files/test.txt', 'test');
        $collection->open('test');
        $this->assertTrue($collection->write('test', 'qualquercoisa'));
    }

    /**
     * @test
     * @depends fileCanBeOpen
     */
    public function fileCanBeRead()
    {
        $collection = new FileCollection('files/test.txt', 'test');
        $collection->write('test', 'NewStringTest');
        $this->assertEquals('NewStringTest', $collection->read('test', 'NewStringTest'));
    }

    /**
     * @test
     * @depends fileCanBeAdded
     */
    public function collectionWithItemsShouldReturnValidCount()
    {
        $collection = new FileCollection('files/test.txt', 'test');
        $collection->set('files/test2.txt', 'test2', 5);
        $collection->set('files/test3.txt', 'test3', 5);


        $this->assertEquals(3, $collection->count());
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function inexistentIndexShouldReturnDefaultValue()
    {
        $collection = new FileCollection('files/test.txt', 'test');

        $this->assertNull($collection->get('test1'));
        $this->assertEquals('defaultValue', $collection->get('test1', 'defaultValue'));
    }

    /**
     * @test
     * @depends collectionWithItemsShouldReturnValidCount
     */
    public function collectionCanBeCleaned()
    {
        $collection = new FileCollection('files/test.txt', 'test');
        $this->assertEquals(1, $collection->count());

        $collection->clean();
        $this->assertEquals(0, $collection->count());
    }
}
