<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Membresia;

class MembresiaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_membresia()
    {
        $membresia = factory(Membresia::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/membresias', $membresia
        );

        $this->assertApiResponse($membresia);
    }

    /**
     * @test
     */
    public function test_read_membresia()
    {
        $membresia = factory(Membresia::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/membresias/'.$membresia->id
        );

        $this->assertApiResponse($membresia->toArray());
    }

    /**
     * @test
     */
    public function test_update_membresia()
    {
        $membresia = factory(Membresia::class)->create();
        $editedMembresia = factory(Membresia::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/membresias/'.$membresia->id,
            $editedMembresia
        );

        $this->assertApiResponse($editedMembresia);
    }

    /**
     * @test
     */
    public function test_delete_membresia()
    {
        $membresia = factory(Membresia::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/membresias/'.$membresia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/membresias/'.$membresia->id
        );

        $this->response->assertStatus(404);
    }
}
