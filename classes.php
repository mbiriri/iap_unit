<?php
class helloworld {
    function sayHello() {
        return "Hello, ICS C Community!";
    }
    public function today() {
        return date("Y/m/d");
    }
}
//create instance
$hello = new helloworld();
print $hello->sayHello();
print $hello->today();