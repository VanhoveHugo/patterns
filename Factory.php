<?php 

interface Animal {
  public function makeSound();
}

class Dog implements Animal {
  public function makeSound() {
    echo "Woof!";
  }
}

class Cat implements Animal {
  public function makeSound() {
    echo "Meow!";
  }
}

class AnimalFactory {
  public static function createAnimal($animalType) {
    switch($animalType) {
      case 'dog':
        return new Dog();
      case 'cat':
        return new Cat();
      default:
        throw new Exception("Invalid animal type");
    }
  }
}

$dog = AnimalFactory::createAnimal('dog');
$cat = AnimalFactory::createAnimal('cat');

$dog->makeSound();
$cat->makeSound();