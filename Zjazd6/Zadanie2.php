<?php
class Product{
     private $name;
     private $price;
     private $quantity;
     public function getName(){
            return $this->name;
     }
     public function getPrice(){
         return $this->price;
     }
     public function getQuantity(){
         return $this->quantity;
     }

     public function __construct($name, $price, $quantity){
         $this->name = $name;
         $this->price = $price;
         $this->quantity = $quantity;
     }
     public function __toString(){
         return "Product: " . $this->getName() . ", Price: " . $this->getPrice() . ", Quantity: " . $this->getQuantity() . "\n";
     }
}

class Cart{
    private $products; //arr of products
    public function __construct(){
        $this->products = array();
    }

    public function addProduct(Product $product){
        $this->products[] = $product;
    }
    public function removeProduct(Product $product){
        $key = array_search($product, $this->products);
        if($key !== false){
            unset($this->products[$key]);
        }
    }
    public function getTotal(){
        $total = 0;
        foreach($this->products as $product){
            $total += $product->getPrice();
        }
        return $total;
    }

    public function __toString(){
        echo "Products in cart: \n";
        foreach($this->products as $product){
            echo $product->__toString();
        }
        return "Total price: " . $this->getTotal() ."\n";
    }
}


$item1 = new Product("Laptop",1500,1);
$item2 = new Product("Desk",700,1);
$item3 = new Product("Chair",200,4);

echo $item1;
$cart = new Cart();
$cart->addProduct($item1);
$cart->addProduct($item2);
$cart->addProduct($item3);
echo $cart;
$cart ->removeProduct($item1);
echo $cart;
?>