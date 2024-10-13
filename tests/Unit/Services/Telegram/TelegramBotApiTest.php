<?php

namespace Tests\Unit\Services\Telegram;

use Illuminate\Support\Facades\Http;
use Services\Telegram\TelegramBotApi;
use Tests\TestCase;

class TelegramBotApiTest extends TestCase
{
    /**
     * @test
     */
    public function it_send_message_success()
    {
        Http::fake([
            TelegramBotApi::HOST . 'token' . '*' => Http::response(['ok' => true], 200),
        ]);

        $result = TelegramBotApi::sendMessage('token', 1, 'text');

        $this->assertTrue($result);
    }
}
