<?php

//Strategy
interface PaymentInterface{
   public function pay(int $amount): bool;
}

public class PayPal implements PaymentInterface{

   private string $email;

   public function __constuct(string $email){
       $this->email = $email;
   }

   public function getEmail(): string
   {
       return $this->email;
   }

   public function paymentProcess(float $amount): bool
   {
       //payment logic here
       echo "PayPal payment ".$amount." processing from: ". $this->getEmail();

       return true;
   }
}

public class Wallet implements PaymentInterface{

   public function __constuct(private string $walletAddress){
   }

   public function getWalletAddress(): string
   {
       return $this->walletAddress;
   }

   public function paymentProcess(float $amount): bool
   {
       //payment logic here
       echo "Wallet payment ".$amount." processing from: " . $this->getWalletAddress();

       return true;
   }
}

// Context Payment Service
public class PaymentService{

   private PaymentInterface $paymentProcessor;

   public function makePayment(float $amount): bool
   {
       return $this->paymentProcessor()->paymentProcess($amount);
   }

   public function setPaymentProcessor($paymentProcessor): void
   {
       $this->paymentProcessor = $paymentProcessor;
   }
}

$payment = new PaymentService();

// Process using Wallet
$payment->setPaymentProcessor(new Wallet("1C1zS5eP8QFzfi2DMPTfTL5SLmv7DivdNb"));
$payment->makePayment($amount);
// Process using Paypal
$payment->setPaymentProcessor(new PayPal("test@email.com"));
$payment->makePayment($amount);
