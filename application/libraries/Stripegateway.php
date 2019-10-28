<?php use Stripe\Charge;
use Stripe\Customer;
use Stripe\Error\ApiConnection;
use Stripe\Error\Authentication;
use Stripe\Error\Base;
use Stripe\Error\Card;
use Stripe\Error\InvalidRequest;
use Stripe\Error\RateLimit;
use Stripe\Invoice;
use Stripe\InvoiceItem;
use Stripe\Plan;
use Stripe\Subscription;

if (!defined('BASEPATH')) exit('No direct script access allowed');

include("./vendor/autoload.php");

class Stripegateway
{

    public function __construct()
    {
        /*$stripe = array(
            "secret_key" => "sk_test_295TKsDXSxfRnDM3J3OMLIxL",
            "public_key" => "pk_test_uyk8PMVbRZNHVOScCteyAGFI"
        );
        \Stripe\Stripe::setApiKey($stripe["secret_key"]);*/
    }

    public function test()
    {
        \Stripe\Stripe::setApiKey("sk_test_ViExYsXGXinmjVe1mSqrFhO3");

        $customer = Customer::retrieve("cus_BUEqq6qQ0KOLo9");

        /*$response = $customer->sources->create(array("source" => array(
                                                        "object" => "card",
                                                        "exp_month" => "05",
                                                        "exp_year" => "20",
                                                        "number" => "5555555555554444",
                                                        "cvc" => "654",
                                                    )
                                        )
                                  );*/
        echo "<pre>" . $customer->sources->data[0]['id'];

    }

    public function get_customer($data)
    {
        if (empty($data["stripe_cust_id"])) {

            return Customer::create(array(
                "source" => $data['stripeToken'],
                "description" => $data['stripeEmail'],
                "email" => $data['stripeEmail']
            ));

        } else {

            $customer = Customer::retrieve($data["stripe_cust_id"]);
            $customer->sources->retrieve($customer->sources->data[0]['id'])->delete();
            $customer->sources->create(array("source" => $data['stripeToken']));
            return $customer;

        }

    }

    public function create_subscription($customer, $data)
    {
        \Stripe\Stripe::setApiKey($data["secret_key"]);

        $success = "";
        $error = "";

        try {

            $plans = explode("|", $data['plan']);
            array_pop($plans);

            $items = array();

            foreach ($plans as $plan) {
                $plan_details = explode(";", $plan);
                $temp['plan'] = $plan_details[0];
                $temp['quantity'] = $plan_details[1];
                array_push($items, $temp);
            }

            $arr['result'] = Subscription::create(array(
                "customer" => $customer->id,
                "items" => $items
            ));

            $arr['success'] = 'Your payment was successful.';


        } catch (Card $e) {
            // The card has been declined from some reason
            $arr['error'] = $e->getMessage();
            echo("Status is: " + $e->getCode());
            echo("Message is: " + $e->getMessage());

        } catch (RateLimit $e) {
            // Too many requests made to the API too quickly
        } catch (InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $arr['error'] = $e->getMessage();
            echo("Status is: " + $e->getCode());
            echo("Message is: " + $e->getMessage());
        } catch (Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $arr['error'] = $e->getMessage();
            echo("Status is: " + $e->getCode());
            echo("Message is: " + $e->getMessage());
        } catch (ApiConnection $e) {
            // Network communication with Stripe failed
            $arr['error'] = $e->getMessage();
            echo("Status is: " + $e->getCode());
            echo("Message is: " + $e->getMessage());
        } catch (Base $e) {
            // Display a very generic error to the user, and maybe send
            // yourself an email
            $arr['error'] = $e->getMessage();
            echo("Status is: " + $e->getCode());
            echo("Message is: " + $e->getMessage());

        } catch (Exception $e) {
            echo("Status is: " + $e->getCode());
            echo("Message is: " + $e->getMessage());

            $arr['error'] = $e->getMessage();
        }

        return $arr;
    }

    public function charge($customer, $data)
    {
        \Stripe\Stripe::setApiKey($data["secret_key"]);

        $success = "";
        $error = "";

        try {

            $result = Charge::create(array(
                "amount" => $data['donationAmt'],
                "currency" => "usd",
                "customer" => $customer->id,
                "receipt_email" => $data['stripeEmail'],
                "description" => "Online Donation - " . $data['stripeEmail']
            ));


            $success = 'Your payment was successful.';

        } catch (Card $e) {
            // The card has been declined from some reason
            $error = $e->getMessage();
        }

        // send back messaging json
        $arr = array(
            'success' => $success,
            'error' => $error,
            'result' => $result
        );

        return $arr;
    }

    public function charge_invoice($data)
    {

        \Stripe\Stripe::setApiKey($data["secret_key"]);

        $customer = $this->get_customer($data);
        $success = "";
        $error = "";

        try {

            $result = InvoiceItem::create(array(
                "amount" => $data['donationAmt'],
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => "One-Time Donation "
            ));
            $result = Invoice::create(array(
                "customer" => $customer->id,
            ));
            $paid_invoice = $result->pay();

            // $invoice = \Stripe\Invoice::retrieve($data["stripe_cust_id"]);
            // $invoice->pay();


        } catch (Card $e) {
            // The card has been declined from some reason
            $error = $e->getMessage();
        } catch (RateLimit $e) {
            $arr['error'] = $e->getMessage();
        } catch (InvalidRequest $e) {
            $arr['error'] = $e->getMessage();
        } catch (Authentication $e) {
            $arr['error'] = $e->getMessage();
        } catch (ApiConnection $e) {
            $arr['error'] = $e->getMessage();
        } catch (Base $e) {
            $arr['error'] = $e->getMessage();

        } catch (Exception $e) {
            $arr['error'] = $e->getMessage();
        }

        // send back messaging json
        $arr = array(
            'success' => $success,
            'error' => $error,
            'result' => $result
        );

        return $arr;
    }

    public function checkout($data)
    {
        $customer = $this->get_customer($data);

        if ($data['plan'] != "none") {
            return $this->create_subscription($customer, $data);
        } else {
            return $this->charge($customer, $data);
        }
    }

    public function subscriptions_list($customer_id = false, $api_key)
    {
        \Stripe\Stripe::setApiKey($api_key);

        if ($customer_id) {
            $result = Subscription::all(array('customer' => $customer_id, 'status' => 'active'));
        } else {
            $result = Subscription::all(array('limit' => 100, 'status' => 'active'));
        }

        if (count($result["data"]) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function cancel_subscription($data)
    {
        \Stripe\Stripe::setApiKey($data["secret_key"]);

        $sub = Subscription::retrieve($data["subs_id"]);
        $sub->cancel();
    }

    public function retrieve_subscription($id, $data)
    {

        try {
            \Stripe\Stripe::setApiKey($data["secret_key"]);

            $result = Subscription::retrieve($id);

            return $result;

        } catch (Exception $e) {
            return false;
        }


    }

    public function create_plan($data)
    {
        log_message('debug', "Executing Stripegateway create_plan() with plan name {$data['nice_name']} ");

        \Stripe\Stripe::setApiKey($data["secret_key"]);
        try {
            $plan = Plan::create(array(
                //"name" => $data['nice_name'],
                "nickname" => $data['nice_name'],
                "id" => $data['name'],
                "interval" => $data['interval'],
                "product" => [
                    "name" => $data['name'],
                    "type" => "service"
                ],
                "currency" => $data['currency'],
                "amount" => $data['amount'],
            ));
        } catch (RateLimit $e) {
            // Too many requests made to the API too quickly
            $body = $e->getJsonBody();
            $err = $body['error'];
            log_message('error', "Too many requests made to the API too quickly", json_encode($err['message']));
        } catch (InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $body = $e->getJsonBody();
            $err = $body['error'];
            log_message('error', "Invalid parameters were supplied to Stripe's API", json_encode($err['message']));
        } catch (Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $body = $e->getJsonBody();
            $err = $body['error'];
            log_message('error', "Invalid parameters were supplied to Stripe's API", json_encode($err['message']));
        } catch (ApiConnection $e) {
            // Network communication with Stripe failed
            $body = $e->getJsonBody();
            $err = $body['error'];
            log_message('error', "Invalid parameters were supplied to Stripe's API", json_encode($err['message']));

        } catch (Exception $e) {
            // Something else happened, completely unrelated to Stripe
            $body = $e->getJsonBody();
            $err = $body['error'];
            log_message('error', "Something else happened, completely unrelated to Stripe.", json_encode($err['message']));
        }
    }

    public function update_plan($data)
    {
        \Stripe\Stripe::setApiKey($data["secret_key"]);

        $p = Plan::retrieve($data['name']);
        $p->nickname = $data['nice_name'];
        $p->save();
    }

    public function delete_plan($data)
    {
        \Stripe\Stripe::setApiKey($data["secret_key"]);
        $p = Plan::retrieve($data["name"]);
        $p->delete();
    }
}