<?php

namespace Tests;

use Carbon\CarbonPeriod;

class IntersectsTest extends TestCase
{
    /** @test */
    public function it_should_not_get_before()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-01',
            'ended_at' => '2019-04-07',
        ]);

        $this->assertNotContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_end_touching()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-10',
            'ended_at' => '2019-04-15',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_end_inside()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-10',
            'ended_at' => '2019-04-18',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_enclosing_start_touching()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-15',
            'ended_at' => '2019-04-23',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_inside_start_touching()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-15',
            'ended_at' => '2019-04-19',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_inside()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-16',
            'ended_at' => '2019-04-20',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_inside_end_touching()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-16',
            'ended_at' => '2019-04-21',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_exact_match()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-15',
            'ended_at' => '2019-04-21',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_enclosing()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-14',
            'ended_at' => '2019-04-22',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_enclosing_end_touching()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-14',
            'ended_at' => '2019-04-21',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_start_inside()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-20',
            'ended_at' => '2019-04-22',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_get_start_touching()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-21',
            'ended_at' => '2019-04-25',
        ]);

        $this->assertContains($event->id, Model::intersects($period)->pluck('id'));
    }

    /** @test */
    public function it_should_not_get_after()
    {
        $period = CarbonPeriod::create('2019-04-15', '2019-04-21');
        
        $event = Model::create([
            'started_at' => '2019-04-22',
            'ended_at' => '2019-04-25',
        ]);

        $this->assertNotContains($event->id, Model::intersects($period)->pluck('id'));
    }
}
