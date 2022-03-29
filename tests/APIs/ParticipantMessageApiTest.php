<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ParticipantMessage;

class ParticipantMessageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_participant_message()
    {
        $participantMessage = factory(ParticipantMessage::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/participant_messages', $participantMessage
        );

        $this->assertApiResponse($participantMessage);
    }

    /**
     * @test
     */
    public function test_read_participant_message()
    {
        $participantMessage = factory(ParticipantMessage::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/participant_messages/'.$participantMessage->id
        );

        $this->assertApiResponse($participantMessage->toArray());
    }

    /**
     * @test
     */
    public function test_update_participant_message()
    {
        $participantMessage = factory(ParticipantMessage::class)->create();
        $editedParticipantMessage = factory(ParticipantMessage::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/participant_messages/'.$participantMessage->id,
            $editedParticipantMessage
        );

        $this->assertApiResponse($editedParticipantMessage);
    }

    /**
     * @test
     */
    public function test_delete_participant_message()
    {
        $participantMessage = factory(ParticipantMessage::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/participant_messages/'.$participantMessage->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/participant_messages/'.$participantMessage->id
        );

        $this->response->assertStatus(404);
    }
}
