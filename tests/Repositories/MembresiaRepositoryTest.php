<?php namespace Tests\Repositories;

use App\Models\Membresia;
use App\Repositories\MembresiaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MembresiaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MembresiaRepository
     */
    protected $membresiaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->membresiaRepo = \App::make(MembresiaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_membresia()
    {
        $membresia = factory(Membresia::class)->make()->toArray();

        $createdMembresia = $this->membresiaRepo->create($membresia);

        $createdMembresia = $createdMembresia->toArray();
        $this->assertArrayHasKey('id', $createdMembresia);
        $this->assertNotNull($createdMembresia['id'], 'Created Membresia must have id specified');
        $this->assertNotNull(Membresia::find($createdMembresia['id']), 'Membresia with given id must be in DB');
        $this->assertModelData($membresia, $createdMembresia);
    }

    /**
     * @test read
     */
    public function test_read_membresia()
    {
        $membresia = factory(Membresia::class)->create();

        $dbMembresia = $this->membresiaRepo->find($membresia->id);

        $dbMembresia = $dbMembresia->toArray();
        $this->assertModelData($membresia->toArray(), $dbMembresia);
    }

    /**
     * @test update
     */
    public function test_update_membresia()
    {
        $membresia = factory(Membresia::class)->create();
        $fakeMembresia = factory(Membresia::class)->make()->toArray();

        $updatedMembresia = $this->membresiaRepo->update($fakeMembresia, $membresia->id);

        $this->assertModelData($fakeMembresia, $updatedMembresia->toArray());
        $dbMembresia = $this->membresiaRepo->find($membresia->id);
        $this->assertModelData($fakeMembresia, $dbMembresia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_membresia()
    {
        $membresia = factory(Membresia::class)->create();

        $resp = $this->membresiaRepo->delete($membresia->id);

        $this->assertTrue($resp);
        $this->assertNull(Membresia::find($membresia->id), 'Membresia should not exist in DB');
    }
}
