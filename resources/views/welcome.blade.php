@php
    
class Car {
    public $color;
    public $model;
    public function __construct($color, $model) {
        $this->color = $color;
        $this->model = $model;
    }
    public function starting(){
        return "The car is a " . $this->color . " " . $this->model; 
    }
}

$mehran = new Car("Black", "Mehran");
echo $mehran->starting();

trait Message {
    public function note($text){
        echo "$text is here";
    }
}

trait React { 
	public function emoji($em){
    	echo "$em";
    }
}

class Share{

    use Message, React;

    public function seen() {
        $this->note("I get you");
        $this->emoji("❤");
    }

}
$unread = new Share();
$unread->seen();


abstract class Vehicle {
    protected $numWheels;

    public function normal(){
        echo "this is normal function, we can also implement normal fnction in abstract class";
    }

    abstract public function getFuel(); // we cant implement abstact function here, can only implement it in subclass
    
}

class Tesla extends Vehicle{
    public function __construct($var) {
        $this->numWheels = $var;
    }
    public function getFuel(){
        echo "Deisel-" . $this->numWheels ;
    }
}


$tesla = new Tesla(4);
$tesla->getFuel();


@endphp