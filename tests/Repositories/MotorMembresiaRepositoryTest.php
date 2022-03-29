<?php namespace Tests\Repositories;

use App\Models\MotorMembresia;
use App\Repositories\MotorMembresiaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MotorMembresiaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MotorMembresiaRepository
     */
    protected $motorMembresiaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->motorMembresiaRepo = \App::make(MotorMembresiaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_motor_membresia()
    {
        $motorMembresia = factory(MotorMembresia::class)->make()->toArray();

        $createdMotorMembresia = $this->motorMembresiaRepo->create($motorMembresia);

        $createdMotorMembresia = $createdMotorMembresia->toArray();
        $this->assertArrayHasKey('id', $createdMotorMembresia);
        $this->assertNotNull($createdMotorMembresia['id'], 'Created MotorMembresia must have id specified');
        $this->assertNotNull(MotorMembresia::find($createdMotorMembresia['id']), 'MotorMembresia with given id must be in DB');
        $this->assertModelData($motorMembresia, $createdMotorMembresia);
    }

    /**
     * @test read
     */
    public function test_read_motor_membresia()
    {
        $motorMembresia = factory(MotorMembresia::class)->create();

        $dbMotorMembresia = $this->motorMembresiaRepo->find($motorMembresia->id);

        $dbMotorMembresia = $dbMotorMembresia->toArray();
        $this->assertModelData($motorMembresia->toArray(), $dbMotorMembresia);
    }

    /**
     * @test update
     */
    public function test_update_motor_membresia()
    {
        $motorMembresia = factory(MotorMembresia::class)->create();
        $fakeMotorMembresia = factory(MotorMembresia::class)->make()->toArray();

        $updatedMotorMembresia = $this->motorMembresiaRepo->update($fakeMotorMembresia, $motorMembresia->id);

        $this->assertModelData($fakeMotorMembresia, $updatedMotorMembresia->toArray());
        $dbMotorMembresia = $this->motorMembresiaRepo->find($motorMembresia->id);
        $this->assertModelData($fakeMotorMembresia, $dbMotorMembresia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_motor_membresia()
    {
        $motorMembresia = factory(MotorMembresia::class)->create();

        $resp = $this->motorMembresiaRepo->delete($motorMembresia->id);

        $this->assertTrue($resp);
        $this->assertNull(MotorMembresia::find($motorMembresia->id), 'MotorMembresia should not exist in DB');
    }
}
