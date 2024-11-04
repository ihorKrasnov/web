<?php

// Інтерфейс для обробників
interface PaymentHandler {
    public function setNext(PaymentHandler $handler): PaymentHandler;
    public function handle(float $amount): string;
}

// Базовий клас для реалізації обробників
abstract class BasePaymentHandler implements PaymentHandler {
    protected $nextHandler;

    public function setNext(PaymentHandler $handler): PaymentHandler {
        $this->nextHandler = $handler;
        return $handler;
    }

    protected function next(float $amount): string {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($amount);
        }
        return "Оплату відхилено: недостатня кількість коштів.";
    }
}

// Обробник для основного рахунку
class MainAccountHandler extends BasePaymentHandler {
    private $balance;

    public function __construct(float $balance) {
        $this->balance = $balance;
    }

    public function handle(float $amount): string {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            return "Оплата виконана з основного рахунку на суму: $amount.";
        }
        return $this->next($amount);
    }
}

// Обробник для кредитної картки
class CreditCardHandler extends BasePaymentHandler {
    private $balance;

    public function __construct(float $balance) {
        $this->balance = $balance;
    }

    public function handle(float $amount): string {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            return "Оплата виконана з кредитної картки на суму: $amount.";
        }
        return $this->next($amount);
    }
}

// Використання патерну Chain of Responsibility
$mainAccount = new MainAccountHandler(50); // Основний рахунок з балансом 100
$creditCard = new CreditCardHandler(150); // Кредитна картка з балансом 50

// Налагодження ланцюга обробників
$mainAccount->setNext($creditCard);

// Сума покупки
$amountToPay = 200;
$amountToPay1 = 45;
$amountToPay2 = 100;

// Обробка платежу
$result = $mainAccount->handle($amountToPay);
echo $result . PHP_EOL; 

$result1 = $mainAccount->handle($amountToPay1);
echo $result1 . PHP_EOL;

$result2 = $mainAccount->handle($amountToPay2);
echo $result2 . PHP_EOL;

?>
