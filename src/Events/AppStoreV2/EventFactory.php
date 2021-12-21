<?php


namespace Imdhemy\Purchases\Events\AppStoreV2;

use Illuminate\Support\Str;
use Imdhemy\Purchases\Contracts\PurchaseEventContract;
use Imdhemy\Purchases\Contracts\ServerNotificationContract;

class EventFactory
{
    /**
     * @param ServerNotificationContract $notification
     * @return PurchaseEventContract
     */
    public static function create(ServerNotificationContract $notification): PurchaseEventContract
    {
        $type = $notification->getType();
        $className = "\Imdhemy\Purchases\Events\AppStoreV2\\" . ucfirst(Str::camel(strtolower($type)));
        return new $className($notification);
    }
}
