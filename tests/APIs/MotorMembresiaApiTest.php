<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MotorMembresia;

class MotorMembresiaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_motor_membresia()
    {
        $motorMembresia = factory(MotorMembresia::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/motor_membresias', $motorMembresia
        );

        $this->assertApiResponse($motorMembresia);
    }

    /**
     * @test
     */
    public function test_read_motor_membresia()
    {
        $motorMembresia = factory(MotorMembresia::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/motor_membresias/'.$motorMembresia->id
        );

        $this->assertApiResponse($motorMembresia->toArray());
    }

    /**
     * @test
     */
    public function test_update_motor_membresia()
    {
        $motorMembresia = factory(MotorMembresia::class)->create();
        $editedMotorMembresia = factory(MotorMembresia::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/motor_membresias/'.$motorMembresia->id,
            $editedMotorMembresia
        );

        $this->assertApiResponse($editedMotorMembresia);
    }

    /**
     * @test
     */
    public function test_delete_motor_membresia()
    {
        $motorMembresia = factory(MotorMembresia::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/motor_membresias/'.$motorMembresia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/motor_membresias/'.$motorMembresia->id
        );

        $this->response->assertStatus(404);
    }
}
