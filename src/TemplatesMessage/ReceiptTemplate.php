<?php
namespace ChatBot\TemplatesMessage;

use ChatBot\Element\ElementInterface;

class ReceiptTemplate implements TemplateInterface
{
    protected $products = [];
    protected $recipientId;
    protected $orderInfo;
    protected $address;
    protected $summary;
    protected $adjustments;

    /**
     * ButtonsTemplate constructor.
     * @param $recepientId
     */
    public function __construct(string $recipientId)
    {
        $this->recipientId = $recipientId;
    }

    public function add(ElementInterface $element){
        $this->products[] = $element->get();
    }

    /**
     * @param mixed $orderInfo
     */
    public function setOrderInfo(string $recipient_name, string $order_number, string $currency, string $payment_method, string $order_url, string $timestamp): void
    {
        $this->orderInfo = [
            'recipient_name' => $recipient_name,
            'order_number' => $order_number,
            'currency' => $currency,
            'payment_method' => $payment_method,
            'order_url' => $order_url,
            'timestamp' => $timestamp,
        ];
    }

    /**
     * @param mixed $address
     */
    public function setAddress(string $street_1, string $street_2, string $city, string $postal_code, string $state, string $country): void
    {
        $this->address[] = [
            'street_1' => $street_1,
            'street_2' => $street_2,
            'city' => $city,
            'postal_code' => $postal_code,
            'state' => $state,
            'country' => $country,
        ];
    }

    /**
     * @param mixed $sumary
     */
    public function setSummary(float $total_cost, float $subtotal = null, float $shipping_cost = null, float $total_tax = null): void
    {
        $this->summary = [
            'subtotal' => $subtotal,
            'shipping_cost' => $shipping_cost,
            'total_tax' => $total_tax,
            'total_cost' => $total_cost,
        ];
    }

    /**
     * @param mixed $adjustments
     */
    public function setAdjustments(string $name, float $amount): void
    {
        $this->adjustments[] = [
            'name' => $name,
            'amount' => $amount,
        ];
    }

    public function message(string $messageText): array
    {
        if(is_null($this->orderInfo)) throw new \Exception('orderInfo is required');
        if(is_null($this->summary)) throw new \Exception('summary is required');

       $result = [
           'recipient' => [
                'id' => $this->recipientId
           ],
           'message' => [
               'attachment' => [
                   'type' => 'template',
                   'payload' => [
                       'template_type' => 'receipt',
                       'text' => $messageText,
                       'recipient_name' => $this->orderInfo['recipient_name'],
                       'order_number' => $this->orderInfo['order_number'],
                       'currency' => $this->orderInfo['currency'],
                       'payment_method' => $this->orderInfo['payment_method'],
                       'order_url' => $this->orderInfo['order_url'],
                       'timestamp' => $this->orderInfo['timestamp'],
                       'elements' => $this->products,
                       'summary' => $this->summary,
                   ],
               ],
           ],
       ];

       if(!is_null($this->address)) $result['message']['attachment']['payload']['address'] = $this->address;
       if(!is_null($this->adjustments)) $result['message']['attachment']['payload']['adjustments'] = $this->adjustments;

       return $result;
    }
}