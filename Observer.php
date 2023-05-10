<?php
interface Observer {
  public function update($value);
}

interface Subject {
  public function attach($observer);
  public function detach($observer);
  public function notify();
}

class StockMarket implements Subject {
  private $stockPrice;
  private $observers = array();

  public function setStockPrice($price) {
    $this->stockPrice = $price;
    $this->notify();
  }

  public function attach($observer) {
    $this->observers[] = $observer;
  }

  public function detach($observer) {
    $index = array_search($observer, $this->observers);
    if ($index !== false) {
      unset($this->observers[$index]);
    }
  }

  public function notify() {
    foreach ($this->observers as $observer) {
      $observer->update($this->stockPrice);
    }
  }
}

class StockTrader implements Observer {
  private $name;

  public function __construct($name) {
    $this->name = $name;
  }

  public function update($value) {
    echo $this->name . " - The current stock price is: " . $value . "\n";
  }
}

$stockMarket = new StockMarket();

$john = new StockTrader("John");
$mary = new StockTrader("Mary");

$stockMarket->attach($john);
$stockMarket->attach($mary);

$stockMarket->setStockPrice(100.0);
$stockMarket->detach($mary);
$stockMarket->setStockPrice(110.0);
