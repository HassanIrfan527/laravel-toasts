<?php

namespace HassanIrfan527\LaravelToasts\Tests\Features;

use HassanIrfan527\LaravelToasts\Facades\Toast;
use HassanIrfan527\LaravelToasts\Livewire\Toast as ToastComponent;
use HassanIrfan527\LaravelToasts\Tests\TestCase;
use Livewire\Livewire;

class ToastComponentTest extends TestCase
{
    /** @test */
    public function it_renders_toasts_from_the_session()
    {
        // 1. Put a toast in the session
        Toast::show('Livewire Test Message');

        // 2. Test the Livewire component
        Livewire::test(ToastComponent::class)
            ->assertSee('Livewire Test Message')
            ->call('remove', session()->get('pending_toasts')[0]['id'] ?? null)
            ->assertDontSee('Livewire Test Message');
    }
}