<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stripe extends MY_Controller
{

    public function checkout()
    {

        $data["message"] = "";

        if (isset($_POST['stripeToken'])) {

            $data = $_POST;
            $plan = "none";

            if ($this->settings['stripe_test_mode'] == 1) {
                $data["secret_key"] = $this->settings['test_stripe_sk'];
                $data["public_key"] = $this->settings['test_stripe_pk'];
            } else {
                $data["secret_key"] = $this->settings['live_stripe_sk'];
                $data["public_key"] = $this->settings['live_stripe_pk'];
            }

            //Get donation type
            $data["stripe_cust_id"] = "";

            $user = $this->users->get_details_by_email($data['stripeEmail']);

            if ($user) {
                $data["stripe_cust_id"] = $user->stripe_cust_id;
            }

            if ($this->stripegateway->subscriptions_list($data["stripe_cust_id"], $data["secret_key"]) && $data['plan'] != "none" && !empty($data["stripe_cust_id"])) {
                $result['success'] = "";
                $result['result'] = "";
                $result['error'] = "Subscription Exists";
            } else {

                if ($data["donationType"] === 'Monthly') {
                    $result = $this->stripegateway->checkout($data);
                } else {
                    $result = $this->stripegateway->charge_invoice($data);
                }

                if (isset($result['success'])) {
                    $amount = $data['donationAmt'];
                    $offset = strlen($amount) - 2;

                    $input['email'] = $data['stripeEmail'];
                    $input['amount'] = substr($amount, 0, $offset) . "." . substr($amount, $offset);
                    $input['stripe_cust_id'] = $result['result']->customer;
                    $input['stripe_json_response'] = json_encode($result['result']);
                    $input['timestamp'] = now();
                    $input['subscription_id'] = $result['result']->id;

                    $input['status'] = "Success";

                    if ($user && empty($data["stripe_cust_id"])) {
                        $user_data = $data;
                        $user_data['stripe_cust_id'] = $input["stripe_cust_id"];
                        unset($user_data['stripeToken']);
                        unset($user_data['stripeEmail']);
                        unset($user_data['donationAmt']);
                        unset($user_data['secret_key']);
                        unset($user_data['public_key']);
                        unset($user_data['plan']);
                        $this->users->update($user_data, $user->id);
                    } else if (!$user) {

                        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                        $pass = array(); //remember to declare $pass as an array
                        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                        for ($i = 0; $i < 8; $i++) {
                            $n = rand(0, $alphaLength);
                            $pass[] = $alphabet[$n];
                        }
                        $pass = implode($pass); //turn the array into a string

                        $unencrypted_pass = $pass;
                        $pass = $this->bcrypt->hash_password($pass);

                        $new_user = $data;
                        unset($new_user['stripeToken']);
                        unset($new_user['stripeEmail']);
                        unset($new_user['donationAmt']);
                        unset($new_user['secret_key']);
                        unset($new_user['public_key']);
                        unset($new_user['plan']);
                        $new_user['email'] = $input['email'];
                        $new_user['password'] = $pass;
                        $new_user['role'] = 'Website';

                        $this->users->add($new_user);

                        $this->email->from($this->settings['admin_email'], $this->settings['site_name']);
                        $this->email->to($input['email']);
                        $this->email->subject('An account has been created for you');
                        $this->email->message('Thank you for your payment. We have automatically created an account for you so that you will be able to modify your subscription anytime. Below are the details: <br /> Username: <your_email> <br /> Password: ' . $unencrypted_pass);
                        $this->email->send();

                    }
                } else {
                    $input['status'] = "Failed";

                }

                $this->donations->add($input);
            }

            echo json_encode($result);
        }
        //$this->load->view('layout/frontend/master', $this->data);
    }

    public function cancel_subscription($id)
    {

        if ($this->settings["stripe_test_mode"] == 1) {
            $data["secret_key"] = $this->settings['test_stripe_sk'];
            $data["public_key"] = $this->settings['test_stripe_pk'];
        } else {
            $data["secret_key"] = $this->settings['live_stripe_sk'];
            $data["public_key"] = $this->settings['live_stripe_pk'];
        }

        $donation_info = $this->donations->get_details($id);
        $data["subs_id"] = $donation_info->subscription_id;

        $this->stripegateway->cancel_subscription($data);

        $this->donations->update(array('status' => 'cancelled'), $id);
        redirect('/donations');

    }

    public function test()
    {
        $this->stripegateway->test();
    }
}

