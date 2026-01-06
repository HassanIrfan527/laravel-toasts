<?php

namespace HassanIrfan527\LaravelToasts\Tests\Features;

use HassanIrfan527\LaravelToasts\Facades\Toast;
use HassanIrfan527\LaravelToasts\Enums\ToastType;
use HassanIrfan527\LaravelToasts\Tests\TestCase;

class ToastFacadeTest extends TestCase
{
    /** @test */
    public function it_can_store_a_toast_in_the_session()
    {
        Toast::show('Hello World', ToastType::SUCCESS);

        $sessionData = session()->get('pending_toasts');

        $this->assertCount(1, $sessionData);
        $this->assertEquals('Hello World', $sessionData[0]['text']);
        $this->assertEquals('success', $sessionData[0]['type']);
    }
}