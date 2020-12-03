<!DOCTYPE html>
<html>
<body>
<pre>
<?php
    class Product{
        private string $name = 'olma';
        
        public function deleteProduct(): bool
        {
            return true;
        }
        public function getnameAttribute(string $value): string
        {
            return strtoupper($value);
        }

        public function __get($name)
        {
            $value = null;
            if($this->$name){
                $value = $this->$name;
            }
            $methods = get_class_methods($this);
            if(in_array('get'. $name . 'Attribute', $methods)){
                $method = 'get'. $name . 'Attribute';
                return $this->$method($value);
            }
            return $value;
        }
    }
    $product = new Product;
    // $product->name;
    // $methods = get_class_methods($product);
    var_dump($product->name);
?>
</pre>

</body>
</html>
