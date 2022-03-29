<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ChatMessage;

class ChatMessageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_chat_message()
    {
        $chatMessage = factory(ChatMessage::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/chat_messages', $chatMessage
        );

        $this->assertApiResponse($chatMessage);
    }

    /**
     * @test
     */
    public function test_read_chat_message()
    {
        $chatMessage = factory(ChatMessage::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/chat_messages/'.$chatMessage->id
        );

        $this->assertApiResponse($chatMessage->toArray());
    }

    /**
     * @test
     */
    public function test_update_chat_message()
    {
        $chatMessage = factory(ChatMessage::class)->create();
        $editedChatMessage = factory(ChatMessage::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/chat_messages/'.$chatMessage->id,
            $editedChatMessage
        );

        $this->assertApiResponse($editedChatMessage);
    }

    /**
     * @test
     */
    public function test_delete_chat_message()
    {
        $chatMessage = factory(ChatMessage::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/chat_messages/'.$chatMessage->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/chat_messages/'.$chatMessage->id
        );

        $this->response->assertStatus(404);
    }
}
