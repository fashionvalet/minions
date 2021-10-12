<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\OrderInterface;
use Illuminate\Support\Facades\DB;

class Order extends Worker implements OrderInterface
{

    public function getNewOrders(array $filters)
    {

    }

    public function getOrderById($id, $type='entity_id') {
        try {
            $order = DB::connection('magento_sales')->select("SELECT
                    sales_order.base_currency_code,
                    sales_order.base_discount_amount,
                    sales_order.base_grand_total,
                    sales_order.base_discount_tax_compensation_amount,
                    sales_order.base_shipping_amount,
                    sales_order.base_shipping_discount_amount,
                    sales_order.base_shipping_discount_tax_compensation_amnt,
                    sales_order.base_shipping_incl_tax,
                    sales_order.base_shipping_tax_amount,
                    sales_order.base_subtotal,
                    sales_order.base_subtotal_incl_tax,
                    sales_order.base_tax_amount,
                    sales_order.base_total_due,
                    sales_order.base_to_global_rate,
                    sales_order.base_to_order_rate,
                    sales_order.billing_address_id,
                    sales_order.created_at,
                    sales_order.customer_dob,
                    sales_order.customer_email,
                    sales_order.customer_firstname,
                    sales_order.customer_gender,
                    sales_order.customer_group_id,
                    sales_order.customer_id,
                    sales_order.customer_is_guest,
                    sales_order.customer_lastname,
                    sales_order.customer_note_notify,
                    sales_order.discount_amount,
                    sales_order.entity_id,
                    sales_order.global_currency_code,
                    sales_order.grand_total,
                    sales_order.discount_tax_compensation_amount,
                    sales_order.increment_id,
                    sales_order.is_virtual,
                    sales_order.order_currency_code,
                    sales_order.protect_code,
                    sales_order.quote_id,
                    sales_order.remote_ip,
                    sales_order.shipping_amount,
                    sales_order.shipping_description,
                    sales_order.shipping_discount_amount,
                    sales_order.shipping_discount_tax_compensation_amount,
                    sales_order.shipping_incl_tax,
                    sales_order.shipping_tax_amount,
                    sales_order.state,
                    sales_order.status,
                    sales_order.store_currency_code,
                    sales_order.store_id,
                    sales_order.store_name,
                    sales_order.store_to_base_rate,
                    sales_order.store_to_order_rate,
                    sales_order.subtotal,
                    sales_order.subtotal_incl_tax,
                    sales_order.tax_amount,
                    sales_order.total_due,
                    sales_order.total_item_count,
                    sales_order.total_qty_ordered,
                    sales_order.updated_at,
                    sales_order.weight,
                    
                    sales_order_address.address_type AS b_address_type,
                    sales_order_address.city AS b_city,
                    sales_order_address.company AS b_company,
                    sales_order_address.country_id AS b_country_id,
                    sales_order_address.customer_address_id AS b_customer_address_id,
                    sales_order_address.email AS b_email,
                    sales_order_address.entity_id AS b_entity_id,
                    sales_order_address.firstname AS b_firstname,
                    sales_order_address.lastname AS b_lastname,
                    -- sales_order_address.parent_id AS b_parent_id,
                    sales_order_address.postcode AS b_postcode,
                    sales_order_address.region AS b_region,
                    -- sales_order_address.region_code AS b_region_code,
                    sales_order_address.region_id AS b_region_id,
                    sales_order_address.street AS b_street, -- array
                    sales_order_address.telephone AS b_telephone,
                    
                    sales_order_payment.account_status,
                    sales_order_payment.additional_information, -- json
                    sales_order_payment.amount_ordered,
                    sales_order_payment.base_amount_ordered,
                    sales_order_payment.cc_last_4 AS cc_last4,
                    sales_order_payment.entity_id AS payment_entity_id,
                    sales_order_payment.method,
                    sales_order_payment.parent_id,
                    sales_order_payment.shipping_amount,
                    
                    s.address_type AS s_address_type,
                    s.city AS s_city,
                    s.company AS s_company,
                    s.country_id AS s_country_id,
                    s.customer_address_id AS s_customer_address_id,
                    s.email AS s_email,
                    s.entity_id AS s_entity_id,
                    s.firstname AS s_firstname,
                    s.lastname AS s_lastname,
                    -- s.parent_id AS s_parent_id,
                    s.postcode AS s_postcode,
                    s.region AS s_region,
                    -- s.region_code AS s_region_code,
                    s.region_id AS s_region_id,
                    s.street AS s_street, -- array
                    s.telephone AS s_telephone,
                    sales_order.shipping_method AS s_method,

                    sales_order.base_shipping_amount,
                    sales_order.base_shipping_discount_amount,
                    sales_order.base_shipping_incl_tax,
                    sales_order.base_shipping_invoiced,
                    sales_order.base_shipping_tax_amount,
                    sales_order.shipping_amount,
                    sales_order.shipping_discount_amount,
                    sales_order.shipping_discount_tax_compensation_amount,
                    sales_order.shipping_incl_tax,
                    sales_order.shipping_invoiced,
                    sales_order.shipping_tax_amount,
                
                    sales_order.base_customer_balance_amount,
                    sales_order.customer_balance_amount,
                    sales_order.base_customer_balance_invoiced,
                    sales_order.customer_balance_invoiced,
                    
                    sales_order.gift_cards, -- array
                    sales_order.base_gift_cards_amount,
                    sales_order.gift_cards_amount,
                    sales_order.gw_base_price,
                    sales_order.gw_price,
                    sales_order.gw_items_base_price,
                    sales_order.gw_items_price,
                    sales_order.gw_card_base_price,
                    sales_order.gw_card_price
                
                FROM sales_order
                
                JOIN sales_order_address
                    ON sales_order_address.parent_id = sales_order.entity_id
                    AND sales_order_address.address_type = 'billing'
                
                JOIN sales_order_address s
                    ON s.parent_id = sales_order.entity_id
                    AND s.address_type = 'shipping'
                    
                JOIN sales_order_payment
                    ON sales_order_payment.parent_id = sales_order.entity_id
                
                WHERE sales_order.".$type." = ?", [$id]);

            if ($order) {
                $order = $order[0];
                
                $items = DB::connection('magento_sales')->select("SELECT
                        sales_order_item.amount_refunded,
                        sales_order_item.base_amount_refunded,
                        sales_order_item.base_discount_amount,
                        sales_order_item.base_discount_invoiced,
                        sales_order_item.base_discount_tax_compensation_amount,
                        sales_order_item.base_original_price,
                        sales_order_item.base_price,
                        sales_order_item.base_price_incl_tax,
                        sales_order_item.base_row_invoiced,
                        sales_order_item.base_row_total,
                        sales_order_item.base_row_total_incl_tax,
                        sales_order_item.base_tax_amount,
                        sales_order_item.base_tax_invoiced,
                        sales_order_item.created_at,
                        sales_order_item.discount_amount,
                        sales_order_item.discount_invoiced,
                        sales_order_item.discount_percent,
                        sales_order_item.free_shipping,
                        sales_order_item.discount_tax_compensation_amount,
                        sales_order_item.is_qty_decimal,
                        sales_order_item.is_virtual,
                        sales_order_item.item_id,
                        sales_order_item.name,
                        sales_order_item.no_discount,
                        sales_order_item.order_id,
                        sales_order_item.original_price,
                        sales_order_item.price,
                        sales_order_item.price_incl_tax,
                        sales_order_item.product_id,
                        sales_order_item.product_type,
                        sales_order_item.qty_canceled,
                        sales_order_item.qty_invoiced,
                        sales_order_item.qty_ordered,
                        sales_order_item.qty_refunded,
                        sales_order_item.qty_returned,
                        sales_order_item.qty_shipped,
                        sales_order_item.quote_item_id,
                        sales_order_item.row_invoiced,
                        sales_order_item.row_total,
                        sales_order_item.row_total_incl_tax,
                        sales_order_item.row_weight,
                        sales_order_item.sku,
                        sales_order_item.store_id,
                        sales_order_item.tax_amount,
                        sales_order_item.tax_invoiced,
                        sales_order_item.tax_percent,
                        sales_order_item.updated_at,
                        sales_order_item.weight,
                        sales_order_item.description
                    
                    FROM sales_order_item
                    
                    WHERE order_id = ?", [$order->entity_id]);

                $order->items = $items;


                $order->additional_information = json_decode($order->additional_information);
                $order->payment = (object)[
                    'account_status' => $order->account_status,
                    'additional_information' => isset($order->additional_information->method_title) ? [$order->additional_information->method_title] : null,
                    'amount_ordered' => $order->amount_ordered,
                    'base_amount_ordered' => $order->base_amount_ordered,
                    'cc_last4' => $order->cc_last4,
                    'entity_id' => $order->payment_entity_id,
                    'method' => $order->method,
                    'parent_id' => $order->entity_id,
                    'shipping_amount' => $order->shipping_amount,
                ];

                unset($order->additional_information);
                unset($order->account_status);
                unset($order->amount_ordered);
                unset($order->base_amount_ordered);
                // unset($order->base_shipping_amount);
                unset($order->cc_last4);
                unset($order->payment_entity_id);
                // unset($order->shipping_amount);

                $order->billing_address = (object)[
                    'address_type' => $order->b_address_type,
                    'city' => $order->b_city,
                    'company' => $order->b_company,
                    'country_id' => $order->b_country_id,
                    'customer_address_id' => $order->b_customer_address_id,
                    'email' => $order->b_email,
                    'entity_id' => $order->b_entity_id,
                    'firstname' => $order->b_firstname,
                    'lastname' => $order->b_lastname,
                    'parent_id' => $order->entity_id,
                    'postcode' => $order->b_postcode,
                    'region' => $order->b_region,
                    // 'region_code' => $order->b_region_code,
                    'region_id' => $order->b_region_id,
                    'street' => explode(PHP_EOL, $order->b_street),
                    'telephone' => $order->b_telephone,
                ];

                unset($order->b_address_type);
                unset($order->b_city);
                unset($order->b_company);
                unset($order->b_country_id);
                unset($order->b_customer_address_id);
                unset($order->b_email);
                unset($order->b_entity_id);
                unset($order->b_firstname);
                unset($order->b_lastname);
                unset($order->b_parent_id);
                unset($order->b_postcode);
                unset($order->b_region);
                unset($order->b_region_code);
                unset($order->b_region_id);
                unset($order->b_street);
                unset($order->b_telephone);

                $order->extension_attributes = (object)[
                    'shipping_assignments' => [(object)[
                        'shipping' => (object)[
                            'address' => (object)[
                                'address_type' => $order->s_address_type,
                                'city' => $order->s_city,
                                'company' => $order->s_company,
                                'country_id' => $order->s_country_id,
                                'customer_address_id' => $order->s_customer_address_id,
                                'email' => $order->s_email,
                                'entity_id' => $order->s_entity_id,
                                'firstname' => $order->s_firstname,
                                'lastname' => $order->s_lastname,
                                'parent_id' => $order->entity_id,
                                'postcode' => $order->s_postcode,
                                'region' => $order->s_region,
                                // 'region_code' => $order->s_region_code,
                                'region_id' => $order->s_region_id,
                                'street' => explode(PHP_EOL, $order->s_street),
                                'telephone' => $order->s_telephone,
                            ]
                        ],
                        'method' => $order->s_method,
                        'total' => (object)[
                            'base_shipping_amount' => $order->base_shipping_amount,
                            'base_shipping_discount_amount' => $order->base_shipping_discount_amount,
                            'base_shipping_incl_tax' => $order->base_shipping_incl_tax,
                            'base_shipping_invoiced' => $order->base_shipping_invoiced,
                            'base_shipping_tax_amount' => $order->base_shipping_tax_amount,
                            'shipping_discount_amount' => $order->shipping_discount_amount,
                            'shipping_discount_tax_compensation_amount' => $order->shipping_discount_tax_compensation_amount,
                            'shipping_incl_tax' => $order->shipping_incl_tax,
                            'shipping_invoiced' => $order->shipping_invoiced,
                            'shipping_tax_amount' => $order->shipping_tax_amount
                        ]
                    ]]
                ];

                unset($order->s_address_type);
                unset($order->s_city);
                unset($order->s_company);
                unset($order->s_country_id);
                unset($order->s_customer_address_id);
                unset($order->s_email);
                unset($order->s_entity_id);
                unset($order->s_firstname);
                unset($order->s_lastname);
                unset($order->s_parent_id);
                unset($order->s_postcode);
                unset($order->s_region);
                unset($order->s_region_code);
                unset($order->s_region_id);
                unset($order->s_street);
                unset($order->s_telephone);

                unset($order->s_method);
                // unset($order->base_shipping_amount);
                unset($order->base_shipping_discount_amount);
                unset($order->base_shipping_incl_tax);
                unset($order->base_shipping_invoiced);
                unset($order->base_shipping_tax_amount);
                unset($order->shipping_discount_amount);
                unset($order->shipping_discount_tax_compensation_amount);
                unset($order->shipping_incl_tax);
                unset($order->shipping_invoiced);
                unset($order->shipping_tax_amount);

                return $order;
            }
        } catch (\Exception $e) {

            \Log::error($e->getMessage());
        }
    }

    public function getOrderByApi($id)
    {
        try
        {
            $response = $this->getClient()->get("orders/{$id}");

            if ($response->getStatusCode() === 200) {
                return json_decode((string) $response->getBody());
            }
            else {
                return false;
            }
        }
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            \Log::error($ex->getResponse()->getBody());
            return NULL;
        }
    }

    public function addCommentToOrder($incrementId, $status, $comment = null,
                                      $notify = false)
    {

    }

    public function cancelOrder($id)
    {
        try
        {
            $response = $this->client->post("orders/{$id}/cancel");

            if ($response->getStatusCode() === 200) {
                return true;
            }
            else {
                return false;
            }
        }
        catch (ClientException $ex)
        {
            \Log::error($ex->getMessage());
            return false;
        }
    }

    public function holdOrder($id)
    {
        try
        {
            $response = $this->client->post("orders/{$id}/hold");

            if ($response->getStatusCode() === 200) {
                return true;
            }
            else {
                return false;
            }
        }
        catch (ClientException $ex)
        {
            \Log::error($ex->getMessage());
            return false;
        }
    }

    public function unholdOrder($id)
    {
        try
        {
            $response = $this->client->post("orders/{$id}/unhold");

            if ($response->getStatusCode() === 200) {
                return true;
            }
            else {
                return false;
            }
        }
        catch (ClientException $ex)
        {
            \Log::error($ex->getMessage());
            return false;
        }
    }

    public function getOrders(array $query = ['searchCriteria' => ['pageSize' => 100]])
    {
        try
        {
            $response = $this->getClient()->get("orders", [
                'query' => $query
            ]);

            if ($response->getStatusCode() === 200) {
                return json_decode((string) $response->getBody());
            }
            else {
                return false;
            }
        }
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            \Log::error($ex->getResponse()->getBody());
            return NULL;
        }
    }

    public function getOrderByIncrementId($incrementId)
    {
        return $this->getOrderById($incrementId, 'increment_id');
    }

}
