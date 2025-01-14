<?php

use Illuminate\Support\Facades\Route;
use Imdhemy\Purchases\Http\Controllers\ServerNotificationController;

Route::post(
    '/purchases/subscriptions/google',
    [ServerNotificationController::class, 'google']
)->name('purchase.serverNotifications.google');

Route::post(
    '/purchases/subscriptions/apple',
    [ServerNotificationController::class, 'apple']
)->name('purchase.serverNotifications.apple');

Route::post(
    '/purchases/subscriptions/appleV2',
    [ServerNotificationController::class, 'appleV2']
)->name('purchase.serverNotifications.apple');
