<?php


namespace Imdhemy\Purchases\ServerNotifications;

use Imdhemy\AppStore\V2\ServerNotifications\ServerNotification;
use Imdhemy\AppStore\V2\ValueObjects\RenewalInfo;
use Imdhemy\Purchases\Contracts\ServerNotificationContract;
use Imdhemy\Purchases\Contracts\SubscriptionContract;
use Imdhemy\Purchases\Subscriptions\AppStoreSubscriptionV2;
use Imdhemy\Purchases\ValueObjects\Time;

class AppStoreServerNotificationV2 implements ServerNotificationContract
{
    private ServerNotification $notification;

    public function __construct(ServerNotification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->notification->getNotificationType();
    }

    public function getSubscription(array $jsonKey = []): SubscriptionContract
    {
        return new AppStoreSubscriptionV2($this->notification->getData()->getTransactionInfo());
    }

    public function isTest(): bool
    {
        return false;
    }

    public function getFirstReceipt(): RenewalInfo
    {
        return $this->notification->getData()->getRenewalInfo();
    }

    /**
     * @return bool
     */
    public function isAutoRenewal(): bool
    {
        return $this->notification->getData()->getRenewalInfo()->getAutoRenewStatus() == 1;
    }

    public function getAutoRenewStatusChangeDate(): ?Time
    {
        $time = $this->notification->getData()->getRenewalInfo()->getSignedDate();
        if (!is_null($time)) {
            return Time::fromAppStoreTimeV2($time);
        }

        return null;
    }

    /**
     * @return string
     */
    public function getBundle(): string
    {
        return $this->notification->getData()->getBundleId();
    }
}
