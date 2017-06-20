<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Response;

class PoiTest extends TestCase
{
    public function testIndexReturnsAllPoi() {
        
        $poi = factory(\App\Poi::class, 2)->create();
        $response = $this->call('GET', '/api/poi');
        $this->assertEquals(200, $response->status());
        
        $poi->each(function($item) {
            $this->assertEquals($item->name, $item->name);
        });
        
    }
    
    public function testStorePoi() {
        
        $poi = factory(\App\Poi::class)->create();
        $this->assertEquals($poi->name, $poi->name);
        
    }
    
    public function testFindPoi() {
        
        $response = $this->call('GET', 'api/poi/find/10/20/10');
        $this->assertEquals(200, $response->status());
        
    }
}
