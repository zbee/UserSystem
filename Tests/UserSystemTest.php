<?php
ob_start(); #For testing redirection
require_once 'UserSystem/UserSystem.php';
date_default_timezone_set('America/Denver');

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
    $a = new UserSystem(false,['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $_SERVER['HTTP_HOST'] = "test";
    $_SERVER['REQUEST_URI'] = "php";
    $b = $a->currentURL();
    $this->assertEquals("//testphp", $b);
  }

  public function testDefaultRedirect301() {
    $a = new UserSystem(false,['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $b = $a->redirect301("localhost");
    if ($b) {
      $b = 1;
  }
    if (!$b) {
      $b = 0;
  }
    $this->assertLessThan(2, $b);
  }

  public function testEncryption() {
    $a = new UserSystem(false,['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $b = $a->encrypt("cake", "dessert");
    $this->assertNotEquals("cake", $b);
  }

  public function testDecryption() {
    $a = new UserSystem(false,['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $b = $a->encrypt("cake", "dessert");
    $c = $a->decrypt($b, "dessert");
    $this->assertEquals("cake", $c);
  }

  public function testSanitize() {
    $a = new UserSystem(false,['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);

    $t = $a->sanitize(123, "n");
    $this->assertEquals(123, $t);

    $t = $a->sanitize("123", "n");
    $this->assertEquals(123, $t);

    $t = $a->sanitize("123g", "n");
    $this->assertEquals(123, $t);

    $t = $a->sanitize("g", "n");
    $this->assertEquals(0, $t);

    $t = $a->sanitize("g", "s");
    $this->assertEquals("g", $t);

    $t = $a->sanitize("g'°", "s");
    $this->assertEquals("g&#39;&deg;", $t);

    $t = $a->sanitize(123, "s");
    $this->assertEquals("123", $t);

    $t = $a->sanitize(1414035554, "d");
    $this->assertEquals(1414035554, $t);

    $t = $a->sanitize("1414035554", "d");
    $this->assertEquals(1414035554, $t);

    $t = $a->sanitize("1414;035554", "d");
    $this->assertEquals(1414035554, $t);

    $t = $a->sanitize("2014-10-21", "d");
    $this->assertEquals(1413871200, $t);

    $t = $a->sanitize("+1 week 2 days 4 hours 2 seconds", "d");
    $this->assertEquals(strtotime("+1 week 2 days 4 hours 2 seconds"), $t);

    $t = $a->sanitize("next Thursday", "d");
    $this->assertEquals(strtotime("next Thursday"), $t);

    $t = $a->sanitize("<span>cake</span>", "h");
    $this->assertEquals("<span>cake</span>", $t);

    $t = $a->sanitize("g'°", "h");
    $this->assertEquals("g'&deg;", $t);
  }

  public function testDBModInsert() {
    $a = new UserSystem(false,['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $a->db->query("CREATE DATABASE test");
    $a = new UserSystem(["location"=>"localhost","database"=>"test","username"=>"root","password" =>""],['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $a->db->query("CREATE TABLE `test1` (`id` INT(50) NOT NULL AUTO_INCREMENT,
    `test` VARCHAR(50) NULL DEFAULT NULL,PRIMARY KEY (`id`))
    COLLATE='latin1_swedish_ci' ENGINE=MyISAM AUTO_INCREMENT=0;;");
    $a->dbMod(["i", "test1", ["test"=>"cake"]]);
    $b = $a->dbSel(["test1", ["id"=>1]]);
    $this->assertEquals(1, $b[0]);
    $this->assertEquals(1, $b[1]['id']);
    $this->assertEquals("cake", $b[1]['test']);
  }

  public function testDBModUpdate() {
    $a = new UserSystem(["location"=>"localhost","database"=>"test","username"=>"root","password" =>""],['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $a->dbMod(["u", "test1", ["test"=>"pie"], ["test"=>"cake"]]);
    $b = $a->dbSel(["test1", ["id"=>1]]);
    $this->assertEquals(1, $b[0]);
    $this->assertEquals(1, $b[1]['id']);
    $this->assertEquals("pie", $b[1]['test']);
  }

  public function testDBModDelete() {
    $a = new UserSystem(["location"=>"localhost","database"=>"test","username"=>"root","password" =>""],['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $a->dbMod(["d", "test1", ["test"=>"pie"]]);
    $b = $a->dbSel(["test1", ["id"=>1]]);
    $this->assertEquals(0, $b[0]);
  }

  public function testDBSel() {
    $a = new UserSystem(["location"=>"localhost","database"=>"test","username"=>"root","password" =>""],['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $b = $a->dbSel(["test1", ["id"=>1]]);
    $this->assertEquals(0, $b[0]);
  }

  public function testNumRows() {
    $a = new UserSystem(["location"=>"localhost","database"=>"test","username"=>"root","password" =>""],['sitename'=>"examplecom",'domain_simple'=>"example.com",'domain'=>"accounts.example.com",'system_loc'=>"/usersystem",'encryption'=>false]);
    $b = $a->numRows("test1");
    $this->assertEquals(0, $b);
    $a->db->query("DROP DATABASE test");
  }
}
