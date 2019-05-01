<?php

namespace Tests;

use Carbon\CarbonPeriod;

class IntersectsMacroTest extends TestCase
{
    /** @test */
    public function it_should_allow_chaining()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        Model::create([
            'started_at' => '2019-04-15',
            'ended_at' => '2019-04-16',
        ]);
        
        Model::create([
            'started_at' => '2019-04-15',
            'ended_at' => '2019-04-16',
            'name' => 'foo',
        ]);

        $this->assertCount(1, Model::intersects($period)->whereName('foo')->get());
    }

    /** @test */
    public function it_should_allow_booleans()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        Model::create([
            'started_at' => '2019-04-10',
            'ended_at' => '2019-04-14',
        ]);
        
        Model::create([
            'started_at' => '2019-04-10',
            'ended_at' => '2019-04-14',
            'name' => 'foo',
        ]);

        $this->assertCount(1, Model::intersects($period)->orWhere('name', 'foo')->get());
        $this->assertCount(1, Model::where('name', 'foo')->intersects($period, 'or')->get());
    }
}
