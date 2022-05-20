<?php

namespace App\Traits\Payment;

use Illuminate\Http\Request;

trait SendsQiwiResponse
{
    protected function response(Request $request, array $extra = [])
    {
        $response = [
            'osmp_txn_id' => $request->get('txn_id'),
            'result' => "0",
        ];

        $response = array_merge($response, $extra);

        $out = $this->buildXML($response);

        return response()->make($out, 200, ['Content-Type' => 'text/xml']);
    }

    /**
     * @param array $response
     * @param int $level
     * @return string
     */
    protected function buildXML(array $response = [], $level = 1)
    {
        $out = '';

        if (1 === $level) {
            $out .= '<?xml version="1.0" encoding="UTF-8"?><response>';
        }

        foreach ($response as $key => $value) {
            if (is_array($value)) {
                $out .= "<{$key}>";
                $i = 1;
                foreach ($value as $k => $v) {
                    $out .= "<field{$i} name=\"{$k}\">{$v}</field{$i}>";
                    $i++;
                }
                $out .= "</{$key}>";
            } else {
                $out .= "<{$key}>{$value}</{$key}>";
            }
        }

        if (1 === $level) {
            $out .= '</response>';
        }

        return $out;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function findOrder(Request $request)
    {
        return $this->orders->findByOrderId($orderId = $request->get('account'));
    }

    private function toAmount($amount)
    {
        return number_format((double)$amount, 2);
    }
}