<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PoiTest extends TestCase
{
    public function testIndexReturnsAllPoi() {
        
        $poi = factory(\App\Poi::class, 2)->create();
        
        $this->get('api/poi')->seeStatusCode(200);
        
        $poi->each(function($item) {
            $this->seeJson(['name' => $item->name]);
        });
        
    }
    
    public function testStorePoi() {
        
        $poi = factory(\App\Poi::class)->create();
        $this->assertEquals($poi->name, $poi->name);
        
    }
    
    public function testFindPoi() {
        
        $this->get('api/poi/find/10/20/10')->seeStatusCode(200);
        
    }
}
