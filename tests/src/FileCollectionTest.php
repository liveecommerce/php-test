<?php

namespace Live\Collection;

use PHPUnit\Framework\TestCase;

class FilleCollectionTest extends TestCase
{
   /**
     * @test
     * @doesNotPerformAssertions
     */
    public function objectCanBeConstructed()
    {
        $collection = new FileCollection('data/DataTest.json');
    }
    
    /**
     * @test
     * @depends objectCanBeConstructed
     * @doesNotPerformAssertions
     */
    public function dataCanBeAdded()
    {
        $collection = new FileCollection('data/DataTest.json');
        $collection->set('id1', ['', date('d-m-y')]);
        $collection->set('id2', ['value2', date('d-m-y')]);
        $collection->set('id3', ['value3', date('d-m-y')]);
        $collection->set('id4', ['value4', date('d-m-y')]);
        $collection->set('id5', ['dataCanBeAdded']);
    }
    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function dataCanBeRetrieved()
    {
        $collection = new FileCollection('data/DataTest.json');
        $value = 'dataCanBeRetrieved';
        $collection->set('id1', $value);
        $this->assertEquals($value, $collection->get('id1'));
    }
    
    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function inexistentIndexShouldReturnDefaultValue()
    {
        $collection = new FileCollection('data/DataTest.json');
        $this->assertNull($collection->get('id8'));
        $this->assertEquals('id10', $collection->get('id8', 'id10'));
    }
    
    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function addedItemShouldExistInCollection()
    {
        $collection = new FileCollection('data/DataTest.json');
        $collection->set('id1', ['id1', date('d-m-y')]);
        $this->assertTrue($collection->has('id1'));
    }
    
    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function collectionWithItemsShouldReturnValidCount()
    {
        $collection = new FileCollection('data/DataTest.json');
        $id = random_int(0, 99);
        $this->assertFalse($collection->has($id));
        $count =$collection->count();
        $collection->set($id, $count);
    }
    
    /**
     * @test
     * @depends collectionWithItemsShouldReturnValidCount
     */
    public function collectionCanBeCleaned()
    {
        $collection = new FileCollection('data/DataTest.json');
        $this->assertGreaterThan(0, $collection->count());
        $collection->clean();
        $this->assertEquals(0, $collection->count());
    }
}
