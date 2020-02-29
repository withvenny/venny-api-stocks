<?php

    //
    header('Content-Type: application/json');

    //
    \Stripe\Stripe::setApiKey('sk_test_mTRBViwNmba7buxiOehiBZu400QVrwfzzN');

    //
    switch ($_REQUEST['type']) {

        //
        case 'authentication':

            $ch = \Stripe\Charge::retrieve(
                $_REQUEST['charge'],
                ['api_key' => 'sk_test_mTRBViwNmba7buxiOehiBZu400QVrwfzzN']
            );
            $ch->capture(); // Uses the same API Key.

            echo $ch;

        //
        case 'token':
            $token = \Stripe\Token::create([
                'card' => [
                'number' => $_REQUEST['card'],
                'exp_month' => 2,
                'exp_year' => 2021,
                'cvc' => '314',
                ],
            ]);

            echo $token;

            break;

        //
        case 'retrievetoken':
            
            $retrievetoken = \Stripe\Token::retrieve(
            $_REQUEST['token']
            );

            echo $retrievetoken;

            break;

        //
        case 'createCharge':

            // `source` is obtained with Stripe.js; see https://stripe.com/docs/payments/accept-a-payment-charges#web-create-token
            $createCharge = \Stripe\Charge::create([
            'amount' => 2000,
            'currency' => 'usd',
            'source' => 'tok_visa',
            'description' => 'My First Test Charge (created for API docs)',
            ]);

            echo $createCharge;

            break;

        //
        case 'retrieveCharge':

            $retrieveCharge = \Stripe\Charge::retrieve(
                $_REQUEST['charge']
            );

            
            echo $retrieveCharge;

            break;

        //
        case 'updateCharge':

            $updateCharge = \Stripe\Charge::update(
                $_REQUEST['charge'],
                ['metadata' => ['order_id' => $_REQUEST['order_id']]]
            );
            
            echo $updateCharge;

            break;

        //
        case 'captureCharge':

            $captureCharge = \Stripe\Charge::retrieve(
                $_REQUEST['charge']
            );
            $charge->capture();

            echo $captureCharge;

            break;

        //
        case 'listCharges':

            if(isset($_REQUEST['limit'])){$limit=$_REQUEST['limit'];}else{$limit=10;}
            if(isset($_REQUEST['customer_id'])){$customer_id=$_REQUEST['customer_id'];}else{$customer_id='cus_GpBMkNJMrtktdF';}

            $listCharges = \Stripe\Charge::all([
                'limit' => $limit,
                'customer' => $customer_id
            ]);

            echo $listCharges;

            break;

        //
        case 'createCustomer':

            //
            $customer = \Stripe\Customer::create([
                'email' => $_REQUEST['email'],
                'name' => $_REQUEST['name'],
                'description' => $_REQUEST['description']
            ]);

            echo $customer;

            break;

        //
        case 'retrieveCustomer':
            $retrieveCustomer = \Stripe\Customer::retrieve(
                $_REQUEST['customer_id']
            );

            echo $retrieveCustomer;

            break;

        //
        case 'createIntent':

            $intent = \Stripe\SetupIntent::create([
                //'customer' => $customer->id
                'customer' => $_REQUEST['customer_id'],
                'payment_method_types' => ['card'],
            ]);

            echo $intent;
            
            break;

        //
        case 'retrieveIntent':

            $retrieveIntent = \Stripe\SetupIntent::retrieve(
                $_REQUEST['intent_id']
            );

            echo $retrieveIntent;
            
            break;

        //
        case 'updateIntent':

            $updateIntent = \Stripe\SetupIntent::update(
                $_REQUEST['intent_id'],
                ['metadata' => ['user_id' => $_REQUEST['user_id']]]
            );

            echo $updateIntent;
            
            break;

        //
        case 'confirmIntent':

            //
            $setup_intent = \Stripe\SetupIntent::retrieve(
                $_REQUEST['intent_id']
            );
            
            //
            $setup_intent->confirm([
                'payment_method' => 'pm_card_visa',
            ]);

            echo $setup_intent;
            
            break;

        //
        case 'createPaymentIntent':
            
            $createPaymentIntent = \Stripe\PaymentIntent::create([
                'amount' => 4321,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            echo $createPaymentIntent;
    
            break;

    }

?>