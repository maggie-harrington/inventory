<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Item.php";

    $server = 'mysql:host=localhost:8889;dbname=inventory_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ItemTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Item::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $description = "1850 Dime";
            $test_item = new Item($description);

            //Act
            $test_item->save();

            //Assert
            $result = Item::getAll();
            $this->assertEquals($test_item, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $description = "1850 Dime";
            $description2 = "1900 Penny";
            $test_item = new Item($description);
            $test_item->save();
            $test_item2 = new Item($description2);
            $test_item2->save();

            //Act
            $result = Item::getAll();

            //Assert
            $this->assertEquals([$test_item, $test_item2], $result);
        }

        function test_getId()
        {
            //Arrange
            $description = "1850 Dime";
            $id = 1;
            $test_Item = new Item($description, $id);

            //Act
            $result = $test_Item->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_find()
        {
            //Arrange
            $description = "1850 Dime";
            $description2 = "1900 Penny";
            $test_item = new Item($description);
            $test_item->save();
            $test_item2 = new Item($description2);
            $test_item2->save();

            //Act
            $id = $test_item->getId();
            $result = Item::find($id);

            //Assert
            $this->assertEquals($test_item, $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $description = "1850 Dime";
            $description2 = "1900 Penny";
            $test_item = new Item($description);
            $test_item->save();
            $test_item2 = new Item($description2);
            $test_item2->save();

            //Act
            Item::deleteAll();

            //Assert
            $result = Item::getAll();
            $this->assertEquals([], $result);
        }
    }
?>
