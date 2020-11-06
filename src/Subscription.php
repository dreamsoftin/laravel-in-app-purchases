<?php


namespace Imdhemy\Purchases;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Imdhemy\GooglePlay\Subscriptions\Subscription as GooglePlaySubscription;
use Imdhemy\GooglePlay\Subscriptions\SubscriptionPurchase;

class Subscription
{
    /**
     * @var string
     */
    protected $itemId;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $packageName;

    /**
     * Subscription constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return self
     */
    public function googlePlay(): self
    {
        $this->packageName = config('purchase.google_play_package_name');

        return $this;
    }

    /**
     * @param string $itemId
     * @return self
     */
    public function id(string $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * @param string $token
     * @return self
     */
    public function token(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @param string $packageName
     * @return self
     */
    public function packageName(string $packageName): self
    {
        $this->packageName = $packageName;

        return $this;
    }

    /**
     * @return SubscriptionPurchase
     * @throws GuzzleException
     */
    public function get(): SubscriptionPurchase
    {
        return $this->createSubscription()->get();
    }

    /**
     * @param string|null $developerPayload
     * @throws GuzzleException
     */
    public function acknowledge(?string $developerPayload = null): void
    {
        $this->createSubscription()->acknowledge($developerPayload);
    }

    /**
     * @return GooglePlaySubscription
     */
    public function createSubscription(): GooglePlaySubscription
    {
        return new GooglePlaySubscription(
            $this->client,
            $this->packageName,
            $this->itemId,
            $this->token
        );
    }
}
