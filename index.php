<?php
abstract class Good {
	protected $name='Задайте имя';
	protected $price=0;
	protected $amountSold=0;
	protected $unit='Задайте единицу подсчёта количества товара';
	
	function __construct($name, $price, $amountSold){
		$this->SetName($name);
		$this->SetPrice($price);
		$this->SetAmountSold($amountSold);
		echo 'Создан новый товар со следующими характеристиками:',"\n";
		echo 'Имя: ', $this->GetName(),"\n";
		echo 'Цена: ', $this->GetPrice()," руб.\n";
		echo 'Проданное количество: ', $this->GetAmountSold()," $this->GetUnit()\n";
	}
	
	function GetName(){
		return $this->name;
	}
	
	function GetPrice(){
		return $this->price;
	}
	
	function GetAmountSold(){
		return $this->amountSold;
	}
	
	function GetUnit(){
		return $this->unit;
	}
	
	function SetName($name){
		$this->name=$name;
	}
	
	function SetPrice($price){
		$this->price=$price;
	}
	
	function SetAmountSold($amountSold){
		$this->amountSold=$amountSold;
	}
	
	abstract function CostCalculation();
}
class Book extends Good{
	protected $unit='шт.';
	function CostCalculation(){
		return 'Продано экземпляров книги '. $this->name. ' на сумму '.$this->price*$this->amountSold." руб.\n";
	}
}
$book1=new Book('Джой Ито "Сдвиг"', 800, 100);
$book1->GetName();
$book1->GetPrice();
$book1->GetAmountSold();
echo $book1->CostCalculation();

class DigitalBook extends Book{
	protected $unit=' шт.';
	function __construct(Book $book){
		echo 'Электронная книга наследует название:', $book->GetName(),"\n";
		echo 'Электронная книга наследует цену делённую пополам:', $book->GetPrice()/2," руб.\n";
		parent::__construct($book->GetName(),$book->GetPrice()/2, 0);
	}
}

$eBook=new DigitalBook($book1);
$eBook->GetPrice();
echo 'Проданное количество: ',$eBook->GetAmountSold(),"\n";
$eBook->SetAmountSold(1000);
echo 'Проданное количество: ',$eBook->GetAmountSold(),"\n";

class fruit extends Good {
	protected $unit='кг.';
	function CostCalculation(){
		return 'Продано фруктов'. $this->name. ' на сумму '.$this->price*$this->amountSold." руб.\n";
	}
}
$apple= new fruit('Яблоко', 200, 10);

echo"\n",'Пункт 2: см. код',"\n";

trait GetObj{
	static function GetObject(){
		if(self::$object === null){
			self::$object = new self;
			echo "Объект создан!\n";
		}
		return self::$object;
	}
	private function __clone(){
	}
	private function __wakeup(){
	}
}

class singleton {
	private static $object;
	private function __construct (){
	}
	use getObj;
}
$connect = singleton::GetObject();
?>
