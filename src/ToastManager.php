<?php

namespace HassanIrfan527\LaravelToasts;

use HassanIrfan527\LaravelToasts\Enums\ToastType;

class ToastManager
{
    public function show(
        string $text,
        ToastType $type = ToastType::SUCCESS,
        int $timeout = 3
    ) {
        $toasts = session()->get('pending_toasts', []);

        $toasts[] = [
            'id' => uniqid(),
            'text' => $text,
            'type' => $type->value,
            'icon' => $type->icon(),
            'color' => $type->color(),
            'timeout' => $timeout,
        ];

        session()->put('pending_toasts', $toasts);
    }
}