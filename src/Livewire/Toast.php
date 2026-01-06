<?php

namespace HassanIrfan527\LaravelToasts\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use HassanIrfan527\LaravelToasts\Enums\ToastType;

class Toast extends Component
{
    public $activeToasts = [];

    public function mount(): void
    {
        $this->loadFromSession();
    }

    #[On('toast')]
    public function showToast(string $text, string $type = 'success', int $timeout = 3): void
    {
        $toastType = ToastType::tryFrom($type) ?? ToastType::SUCCESS;

        $this->activeToasts[] = [
            'id' => uniqid(),
            'text' => $text,
            'type' => $toastType->value,
            'icon' => $toastType->icon(),
            'color' => $toastType->color(),
            'timeout' => $timeout,
        ];
    }

    public function remove(string $id): void
    {
        $this->activeToasts = array_values(array_filter(
            $this->activeToasts,
            fn($toast) => $toast['id'] !== $id
        ));
    }

    public function handleUndo(string $id): void
    {
        $toast = collect($this->activeToasts)->firstWhere('id', $id);

        if ($toast && isset($toast['onUndo']) && is_callable($toast['onUndo'])) {
            call_user_func($toast['onUndo']);
        }

        $this->remove($id);
    }

    protected function loadFromSession(): void
    {
        if (session()->has('pending_toasts')) {
            $this->activeToasts = array_merge(
                $this->activeToasts,
                session()->get('pending_toasts', [])
            );

            session()->forget('pending_toasts');
        }
    }

    public function render()
    {
        $this->loadFromSession();

        return view('laravel-toasts::livewire.toast');
    }
}