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
        $collection = new FileCollection('arquivo.json');
    }
    

    /**
     * @test
     * @depends objectCanBeConstructed
     * @doesNotPerformAssertions
     */
    public function dataCanBeAdded()
    {
         $collection = new FileCollection('arquivo.json');
         $collection->set(0, 'value');
         $collection->set('index2', 5);
         $collection->set('index3', true);
         $collection->set('index4', 6.5);
         $collection->set('index5', 'data');
    }
     /**
     * @test
     * @depends dataCanBeAdded
     */
    public function dataCanBeRetrieved()
    {
        $collection = new FileCollection('arquivo.json');
        $value = 'valueToBeTested';
        $collection->set('index1', $value);

        $this->assertEquals($value, $collection->get('index1'));
    }

    /**
     * @test
     * @depends objectCanBeConstructed
     */
    public function inexistentIndexShouldReturnDefaultValue()
    {
        $collection = new FileCollection('arquivo.json');

        $this->assertNull($collection->get('index8'));
        $this->assertEquals('123123', $collection->get('index8', '123123'));
    }

    /**
     * @test
     * @depends dataCanBeAdded
     */
    public function addedItemShouldExistInCollection()
    {
        $collection = new FileCollection('arquivo.json');
        $collection->set('index', 'value');

        $this->assertTrue($collection->has('index'));
    }

    /**
     * @test
     * @depends dataCanBeAdded
     * @depends addedItemShouldExistInCollection
     */
    public function collectionWithItemsShouldReturnValidCount()
    {
        $collection = new FileCollection('arquivo.json');
        
        $count = $collection->count();
        $indice = time();
        $this->assertFalse($collection->has($indice));
        $collection->set($indice, 5);
        $count2 =$collection->count();
                
        $this->assertEquals($count+1, $count2);
    }

    /**
     * @test
     * @depends collectionWithItemsShouldReturnValidCount
     */
    public function collectionCanBeCleaned()
    {
        $collection = new FileCollection('arquivo.json');
        $collection->set('index', 'teste');
        $this->assertEquals('teste', $collection->get('index'));
        $this->assertGreaterThan(0, $collection->count());
        $collection->clean();
        $this->assertEquals(0, $collection->count());
    }
}
