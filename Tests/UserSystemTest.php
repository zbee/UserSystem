<?php
require_once 'UserSystem/UserSystem.php';
ob_start(); #For testing redirection

class UserSystemTest extends PHPUnit_Framework_TestCase {
    public function testDefaultConstruct() {
        $a = new UserSystem(
          ["location" => "localhost","database" => "","username" => "root","password" => ""],
          ['sitename' => "examplecom", 'domain_simple' => "example.com", 'domain' => "accounts.example.com", 'system_loc'=> "/usersystem", 'encryption' => false]
        );
        $this->assertObjectHasAttribute("db", $a);
        $this->assertObjectHasAttribute("OPTIONS", $a);
    }

    public function testCurrentURL() {
        $a = new UserSystem(
          ["location" => "localhost","database" => "","username" => "root","password" => ""],
          ['sitename' => "examplecom", 'domain_simple' => "example.com", 'domain' => "accounts.example.com", 'system_loc'=> "/usersystem", 'encryption' => false]
        );
        $_SERVER['HTTP_HOST'] = "test";
        $_SERVER['REQUEST_URI'] = "php";
        $b = $a->currentURL();
        $this->assertEquals("//testphp", $b);
    }

    public function testDefaultRedirect301() {
        $a = new UserSystem(
          ["location" => "localhost","database" => "","username" => "root","password" => ""],
          ['sitename' => "examplecom", 'domain_simple' => "example.com", 'domain' => "accounts.example.com", 'system_loc'=> "/usersystem", 'encryption' => false]
        );
        $b = $a->redirect301("localhost");
        $this->assertEquals(true, $b);
    }

    public function testEncryption() {
        $a = new UserSystem(
          ["location" => "localhost","database" => "","username" => "root","password" => ""],
          ['sitename' => "examplecom", 'domain_simple' => "example.com", 'domain' => "accounts.example.com", 'system_loc'=> "/usersystem", 'encryption' => false]
        );
        $b = $a->encrypt("cake", "dessert");
        $this->assertNotEquals("cake", $b);
    }

    public function testDecryption() {
        $a = new UserSystem(
          ["location" => "localhost","database" => "","username" => "root","password" => ""],
          ['sitename' => "examplecom", 'domain_simple' => "example.com", 'domain' => "accounts.example.com", 'system_loc'=> "/usersystem", 'encryption' => false]
        );
        $b = $a->encrypt("cake", "dessert");
        $c = $a->decrypt($b, "dessert");
        $this->assertEquals("cake", $c);
    }
}
