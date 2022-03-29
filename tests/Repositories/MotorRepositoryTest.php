<?php namespace Tests\Repositories;

use App\Models\Motor;
use App\Repositories\MotorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MotorRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MotorRepository
     */
    protected $motorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->motorRepo = \App::make(MotorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_motor()
    {
        $motor = factory(Motor::class)->make()->toArray();

        $createdMotor = $this->motorRepo->create($motor);

        $createdMotor = $createdMotor->toArray();
        $this->assertArrayHasKey('id', $createdMotor);
        $this->assertNotNull($createdMotor['id'], 'Created Motor must have id specified');
        $this->assertNotNull(Motor::find($createdMotor['id']), 'Motor with given id must be in DB');
        $this->assertModelData($motor, $createdMotor);
    }

    /**
     * @test read
     */
    public function test_read_motor()
    {
        $motor = factory(Motor::class)->create();

        $dbMotor = $this->motorRepo->find($motor->id);

        $dbMotor = $dbMotor->toArray();
        $this->assertModelData($motor->toArray(), $dbMotor);
    }

    /**
     * @test update
     */
    public function test_update_motor()
    {
        $motor = factory(Motor::class)->create();
        $fakeMotor = factory(Motor::class)->make()->toArray();

        $updatedMotor = $this->motorRepo->update($fakeMotor, $motor->id);

        $this->assertModelData($fakeMotor, $updatedMotor->toArray());
        $dbMotor = $this->motorRepo->find($motor->id);
        $this->assertModelData($fakeMotor, $dbMotor->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_motor()
    {
        $motor = factory(Motor::class)->create();

        $resp = $this->motorRepo->delete($motor->id);

        $this->assertTrue($resp);
        $this->assertNull(Motor::find($motor->id), 'Motor should not exist in DB');
    }
}
