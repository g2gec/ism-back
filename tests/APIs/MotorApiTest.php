<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Motor;

class MotorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_motor()
    {
        $motor = factory(Motor::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/motors', $motor
        );

        $this->assertApiResponse($motor);
    }

    /**
     * @test
     */
    public function test_read_motor()
    {
        $motor = factory(Motor::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/motors/'.$motor->id
        );

        $this->assertApiResponse($motor->toArray());
    }

    /**
     * @test
     */
    public function test_update_motor()
    {
        $motor = factory(Motor::class)->create();
        $editedMotor = factory(Motor::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/motors/'.$motor->id,
            $editedMotor
        );

        $this->assertApiResponse($editedMotor);
    }

    /**
     * @test
     */
    public function test_delete_motor()
    {
        $motor = factory(Motor::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/motors/'.$motor->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/motors/'.$motor->id
        );

        $this->response->assertStatus(404);
    }
}
