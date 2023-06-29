<?php

namespace Tests\Feature;

use App\Models\Sondeo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class sondeoTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_index_with_search_query()
    {
        // $sondeo = factory(Sondeo::class)->create();

        // $response = $this->get('/sondeos?search=' . $sondeo->nombre);

        // $response->assertStatus(200);
        // $response->assertViewHas('sondeos', [
        //     'sondeos' => [
        //         $sondeo,
        //     ],
        // ]);
    }

    public function test_index_without_search_query()
    {
        // $sondeos = factory(Sondeo::class, 2)->create();

        // $response = $this->get('/sondeos');

        // $response->assertStatus(200);
        // $response->assertViewHas('sondeos', $sondeos);
    }
}
