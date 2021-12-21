<?php


namespace Imdhemy\Purchases\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Imdhemy\Purchases\Contracts\PurchaseEventContract;
use Imdhemy\Purchases\Contracts\ServerNotificationContract;
use Imdhemy\Purchases\Contracts\SubscriptionContract;
use Imdhemy\Purchases\ServerNotifications\AppStoreServerNotification;
use Imdhemy\Purchases\ServerNotifications\AppStoreServerNotificationV2;
use Imdhemy\Purchases\ServerNotifications\GoogleServerNotification;

abstract class PurchaseEvent implements PurchaseEventContract
{
    use Dispatchable, SerializesModels;

    protected ServerNotificationContract|AppStoreServerNotification|AppStoreServerNotificationV2|GoogleServerNotification $serverNotification;

    /**
     * SubscriptionPurchased constructor.
     * @param ServerNotificationContract $serverNotification
     */
    public function __construct(ServerNotificationContract $serverNotification)
    {
        $this->serverNotification = $serverNotification;
    }

    /**
     * @return ServerNotificationContract
     */
    public function getServerNotification(): ServerNotificationContract
    {
        return $this->serverNotification;
    }

    /**
     * @return SubscriptionContract
     */
    public function getSubscription(): SubscriptionContract
    {
        return $this->serverNotification->getSubscription();
    }

    /**
     * @return string
     */
    public function getSubscriptionId(): string
    {
        return $this->getSubscription()->getItemId();
    }

    /**
     * @return string
     */
    public function getSubscriptionIdentifier(): string
    {
        return $this->getSubscription()->getUniqueIdentifier();
    }
}
