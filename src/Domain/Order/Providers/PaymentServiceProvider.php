<?php


namespace Domain\Order\Providers;


use Domain\Order\Models\Payment;
use Domain\Order\Payment\Gateways\YooKassa;
use Domain\Order\Payment\PaymentData;
use Domain\Order\Payment\PaymentSystem;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        PaymentSystem::provider(function () {
            return new YooKassa(config('payment.providers.yookassa'));
        });

        PaymentSystem::onCreating(function (PaymentData $paymentData) {
            return $paymentData;
        });

        PaymentSystem::onSuccess(function (Payment $payment) {
        });

        PaymentSystem::onError(function (string $message, Payment $payment) {
        });
    }
}
