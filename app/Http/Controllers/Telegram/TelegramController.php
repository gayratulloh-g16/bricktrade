<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\Driver;

class TelegramController extends Controller
{

    public function handleCallback(Request $request)
    {
        $callbackQuery = $request->input('callback_query');
        if (!$callbackQuery) {
            return response('No callback', 200);
        }

        $callbackData = $callbackQuery['data'];

        list($prefix, $orderId, $value) = explode(':', $callbackData);

        $telegramToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = $callbackQuery['message']['chat']['id'];
        $messageId = $callbackQuery['message']['message_id'];

        if ($prefix === 'order') {
            $order = Order::find($orderId);
            if ($order) {
                if ($value === 'process') {
                    $order->update(['order_status' => 'process']);

                    $drivers = Driver::all();
                    $driverButtons = [];
                    foreach ($drivers as $driver) {
                        $buttonText = $driver->first_name . ' ' . $driver->last_name;
                        $driverButtons[] = ['text' => $buttonText, 'callback_data' => "driver:{$orderId}:{$driver->id}"];
                    }
                    $newKeyboard = [
                        'inline_keyboard' => [
                            $driverButtons
                        ]
                    ];
                } else {
                    $order->update(['order_status' => $value]);
                    if ($value === 'new') {
                        $newKeyboard = [
                            'inline_keyboard' => [
                                [
                                    ['text' => 'New', 'callback_data' => "order:{$orderId}:new"],
                                    ['text' => 'Process', 'callback_data' => "order:{$orderId}:process"],
                                ],
                                [
                                    ['text' => 'Completed', 'callback_data' => "order:{$orderId}:completed"],
                                    ['text' => 'Cancelled', 'callback_data' => "order:{$orderId}:cancelled"],
                                ],
                            ],
                        ];
                    } elseif ($value === 'completed') {
                        $newKeyboard = [
                            'inline_keyboard' => [
                                [
                                    ['text' => 'Completed', 'callback_data' => "order:{$orderId}:completed"],
                                ],
                            ],
                        ];
                    } elseif ($value === 'cancelled') {
                        $newKeyboard = [
                            'inline_keyboard' => [
                                [
                                    ['text' => 'Cancelled', 'callback_data' => "order:{$orderId}:cancelled"],
                                ],
                            ],
                        ];
                    } else {
                        $newKeyboard = [];
                    }
                }
            }

            Http::post("https://api.telegram.org/bot{$telegramToken}/editMessageReplyMarkup", [
                'chat_id'     => $chatId,
                'message_id'  => $messageId,
                'reply_markup' => json_encode($newKeyboard),
            ]);

            Http::post("https://api.telegram.org/bot{$telegramToken}/answerCallbackQuery", [
                'callback_query_id' => $callbackQuery['id'],
                'text'              => "Order #{$orderId} status updated to " . ucfirst($value),
            ]);
        } elseif ($prefix === 'driver') {
            $order = Order::find($orderId);
            if ($order) {
                $order->update(['driver_id' => $value]);
            }

            $newKeyboard = [
                'inline_keyboard' => [
                    [
                        ['text' => 'Completed', 'callback_data' => "order:{$orderId}:completed"],
                        ['text' => 'Cancelled', 'callback_data' => "order:{$orderId}:cancelled"],
                    ],
                ],
            ];

            Http::post("https://api.telegram.org/bot{$telegramToken}/editMessageReplyMarkup", [
                'chat_id'     => $chatId,
                'message_id'  => $messageId,
                'reply_markup' => json_encode($newKeyboard),
            ]);

            Http::post("https://api.telegram.org/bot{$telegramToken}/answerCallbackQuery", [
                'callback_query_id' => $callbackQuery['id'],
                'text'              => "Order #{$orderId} assigned to driver ID " . $value,
            ]);
        }

        return response('OK', 200);
    }
}
