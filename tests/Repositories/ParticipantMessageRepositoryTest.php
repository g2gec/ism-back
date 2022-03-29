<?php namespace Tests\Repositories;

use App\Models\ParticipantMessage;
use App\Repositories\ParticipantMessageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ParticipantMessageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ParticipantMessageRepository
     */
    protected $participantMessageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->participantMessageRepo = \App::make(ParticipantMessageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_participant_message()
    {
        $participantMessage = factory(ParticipantMessage::class)->make()->toArray();

        $createdParticipantMessage = $this->participantMessageRepo->create($participantMessage);

        $createdParticipantMessage = $createdParticipantMessage->toArray();
        $this->assertArrayHasKey('id', $createdParticipantMessage);
        $this->assertNotNull($createdParticipantMessage['id'], 'Created ParticipantMessage must have id specified');
        $this->assertNotNull(ParticipantMessage::find($createdParticipantMessage['id']), 'ParticipantMessage with given id must be in DB');
        $this->assertModelData($participantMessage, $createdParticipantMessage);
    }

    /**
     * @test read
     */
    public function test_read_participant_message()
    {
        $participantMessage = factory(ParticipantMessage::class)->create();

        $dbParticipantMessage = $this->participantMessageRepo->find($participantMessage->id);

        $dbParticipantMessage = $dbParticipantMessage->toArray();
        $this->assertModelData($participantMessage->toArray(), $dbParticipantMessage);
    }

    /**
     * @test update
     */
    public function test_update_participant_message()
    {
        $participantMessage = factory(ParticipantMessage::class)->create();
        $fakeParticipantMessage = factory(ParticipantMessage::class)->make()->toArray();

        $updatedParticipantMessage = $this->participantMessageRepo->update($fakeParticipantMessage, $participantMessage->id);

        $this->assertModelData($fakeParticipantMessage, $updatedParticipantMessage->toArray());
        $dbParticipantMessage = $this->participantMessageRepo->find($participantMessage->id);
        $this->assertModelData($fakeParticipantMessage, $dbParticipantMessage->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_participant_message()
    {
        $participantMessage = factory(ParticipantMessage::class)->create();

        $resp = $this->participantMessageRepo->delete($participantMessage->id);

        $this->assertTrue($resp);
        $this->assertNull(ParticipantMessage::find($participantMessage->id), 'ParticipantMessage should not exist in DB');
    }
}
