<?php
namespace App\Services\PayMob;

use Illuminate\Http\Request;
use App\Traits\RepositoryTrait;

use App\Models\Orders\{
    orderProduct,
    orderProductTransaction,
    Transaction,
    Order,
};

class PayMobCallBack
{
    use RepositoryTrait;

    /**
     * Order status
     *
     * @var string
     */
    protected $orderStatus;

    /**
     * Returned request from the payment callback
     *
     * @var Illuminate\Http\Request
     */
    protected $returnedRequest;

    /**
     * Returned errors
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Payment method
     *
     * @var string
     */
    protected $paymentMethod;

    /**
     * Order details
     *
     * @var App\Modules\Orders\Models\Order
     */
    protected $order;

    /**
     * Receive the callback of paymob payment
     *
     * @param Illuminate\Http\Request
     * @return string $url
     */
    public function receive(Request $request)
    {
        $statuses = [
            'Paid' => 51,
            'Error in Paying' => 52,
        ];
        if ((bool) $request->success) {
            $this->orderStatus = $statuses['Paid'];
        } else {
            $this->orderStatus = $statuses['Error in Paying'];
        }
        $this->updateOrderDetails($request);

        if ($request->success) {
            return redirect()->route('success_page');
        }
        return redirect()->route('failed_page');

        return[
            'order' => Order::all(),
            'orderProducts' => orderProduct::all(),
            'transaction' => Transaction::all(),
            'orderProductTransactions' => orderProductTransaction::all()
        ];
    }

    /**
     * Update order details
     *
     * @param Illuminate\Http\Request
     * @param int $statusId
     * @return void
     */
    public function updateOrderDetails($request)
    {
        $availablePaymentMethods = [
            'card' => 3,
            'value' => 1,
            'wallet' => 6
        ];
        $orderId = $request->merchant_order_id;
        $order = Order::find($orderId);
        $order->status_id = $this->orderStatus;
        $order->update();
        $transaction = new Transaction;
        $transaction = $transaction->create([
            'order_id' => $orderId,
            'payment_transaction_id' => 154878,
            'payment_method_id'     => $availablePaymentMethods[$request->source_data_type],
            'status_id'             => $this->orderStatus,
        ]);
        $orderProducts = orderProduct::where('order_id', $orderId)->get();
        $orderTransactions = [];
        foreach($orderProducts as $orderProduct) {
            $orderTransactions[] = [
                'order_product_id' => $orderProduct->id,
                'status_id' => $this->orderStatus,
                'payment_method_id' => $availablePaymentMethods[$request->source_data_type],
                'transaction_id' => $transaction->id,
                'amount' => $request->amount_cents / 100
            ];
        }
        orderProductTransaction::insert($orderTransactions);
    }
}
