<?php


namespace Imdhemy\Purchases\Subscriptions;

use Imdhemy\AppStore\V2\ValueObjects\TransactionInfo;
use Imdhemy\Purchases\Contracts\SubscriptionContract;
use Imdhemy\Purchases\ValueObjects\Time;

class AppStoreSubscriptionV2 implements SubscriptionContract
{
    private TransactionInfo $transactionInfo;

    /**
     * AppStoreSubscription constructor.
     * @param ReceiptInfo $receipt
     */
    public function __construct(TransactionInfo $transactionInfo)
    {
        $this->transactionInfo = $transactionInfo;
    }

    /**
     * @return Time
     */
    public function getExpiryTime(): Time
    {
        return Time::fromAppStoreTimeV2($this->transactionInfo->getExpiresDate());
    }

    /**
     * @return string
     */
    public function getItemId(): string
    {
        return $this->transactionInfo->getProductId();
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return 'app_store';
    }

    /**
     * @return string
     */
    public function getUniqueIdentifier(): string
    {
        return $this->transactionInfo->getOriginalTransactionId();
    }

    /**
     * @return mixed
     */
    public function getProviderRepresentation()
    {
        return $this->transactionInfo;
    }
}
