<?php namespace Tests\Repositories;

use App\Models\ChatMessage;
use App\Repositories\ChatMessageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ChatMessageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ChatMessageRepository
     */
    protected $chatMessageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->chatMessageRepo = \App::make(ChatMessageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_chat_message()
    {
        $chatMessage = factory(ChatMessage::class)->make()->toArray();

        $createdChatMessage = $this->chatMessageRepo->create($chatMessage);

        $createdChatMessage = $createdChatMessage->toArray();
        $this->assertArrayHasKey('id', $createdChatMessage);
        $this->assertNotNull($createdChatMessage['id'], 'Created ChatMessage must have id specified');
        $this->assertNotNull(ChatMessage::find($createdChatMessage['id']), 'ChatMessage with given id must be in DB');
        $this->assertModelData($chatMessage, $createdChatMessage);
    }

    /**
     * @test read
     */
    public function test_read_chat_message()
    {
        $chatMessage = factory(ChatMessage::class)->create();

        $dbChatMessage = $this->chatMessageRepo->find($chatMessage->id);

        $dbChatMessage = $dbChatMessage->toArray();
        $this->assertModelData($chatMessage->toArray(), $dbChatMessage);
    }

    /**
     * @test update
     */
    public function test_update_chat_message()
    {
        $chatMessage = factory(ChatMessage::class)->create();
        $fakeChatMessage = factory(ChatMessage::class)->make()->toArray();

        $updatedChatMessage = $this->chatMessageRepo->update($fakeChatMessage, $chatMessage->id);

        $this->assertModelData($fakeChatMessage, $updatedChatMessage->toArray());
        $dbChatMessage = $this->chatMessageRepo->find($chatMessage->id);
        $this->assertModelData($fakeChatMessage, $dbChatMessage->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_chat_message()
    {
        $chatMessage = factory(ChatMessage::class)->create();

        $resp = $this->chatMessageRepo->delete($chatMessage->id);

        $this->assertTrue($resp);
        $this->assertNull(ChatMessage::find($chatMessage->id), 'ChatMessage should not exist in DB');
    }
}
