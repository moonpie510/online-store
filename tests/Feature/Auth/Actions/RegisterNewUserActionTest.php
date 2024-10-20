<?php

namespace Feature\Auth\Actions;

use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\DTOs\NewUserDTO;
use Tests\TestCase;

class RegisterNewUserActionTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_success_user_create(): void
    {
        $this->assertDatabaseMissing('users', [
            'email' => 'test@mail.ru',
        ]);

        $action = app(RegisterNewUserAction::class);

        $action(NewUserDTO::make('test', 'test@mail.ru', '123456'));

        $this->assertDatabaseHas('users', [
            'email' => 'test@mail.ru',
        ]);
    }
}
