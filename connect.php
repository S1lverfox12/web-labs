<?php
//class DataBaseManager {
//    private const driver = 'mysql';
//    private const host = 'localhost';
//    private const db_name = 'testing';
//    private const db_user = 'root';
//    private const db_password = '';
//    private const charsert = 'utf-8';
//    public $connection;
//
//
//    public function __construct() {
//        $dsn = self::driver . ":host=" . self::host . ";dbname=" . self::db_name . ";charset=" . self::charsert;
//        $options = array(
//            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//            PDO::ATTR_EMULATE_PREPARES => false
//        );
//        try {
//            $this->connection = new PDO($dsn, self::db_user, self::db_password, $$options);
//        } catch(PDOException $e) {
//            throw new Exception("Connection failed: " . $e->getMessage());
//        }
//    }
//
//
//}
function ConnectToDataBase() {
    $driver = 'mysql';
    $host = 'MySQL-8.0';
    $db_name = 'testing';
    $db_user = 'root';
    $db_password = '';
    $charset = 'utf8';
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false];

    try {
        $pdo = new PDO(
            "$driver:host=$host;dbname=$db_name; charset=$charset", $db_user, $db_password, $options
        );
        return $pdo;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

}


function getItemsForCarousel() {
    $pdo = ConnectToDataBase();
    $components = [];
    $tables = ['motherboard', 'processor', 'ram_memory', 'graphics_card'];
    foreach ($tables as $table) {
        $sql = "select $table.img from tovar join $table on $table.id_tovar = tovar.id_tovar limit 3";
        $components[] = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    $select= $pdo->query("select computer.img from computer limit 6")->fetchAll(PDO::FETCH_ASSOC);
    $computers = array_chunk($select, 3);
    $pdo = null;
    return [$components, $computers];

}

function getListTovarsSameCategory($maintable) { //получение всех товаров определенной категории (компьютер, процессор, мат. плата и т.д.)
    $pdo = ConnectToDataBase();
    $tables = [];
    $select = $pdo->query("SELECT * FROM $maintable limit 1");
    $data = $select->fetchAll(PDO::FETCH_ASSOC);
//    print('id_' . $table);
//    var_dump($data);
    foreach ($data as $key => $value) {


        foreach ($value as $k => $v) {

            $pos = strpos($k, 'id_');
            if (( $pos!== false) and ($k != 'id_' . $maintable)) {
                $tables[] = ltrim($k, 'id_');
            };
        };

    };
    $accostiation = [
        'title_maker' => "Производитель", 'title_chipset'=>'Чипсет', 'number_number_of_cores'=> 'Количество ядер', 'title_type_of_memory'=> 'Тип памяти',
        'number_number_memory'=> 'Количество памяти', 'number_memory_freq' => 'Частота памяти', 'title_socket'=> "Сокет", 'price'=>'Цена', 'title_processor' => 'Процессор',
        'title_graphics_card' => 'Видеокарта', 'title_motherboard' => 'Материнская плата', 'title_ram_memory'=> 'Оперативная память'];
//    var_dump($tables);

    $sql = "select *, $maintable.img, $maintable.price, $maintable.id_tovar from $maintable ";
    for($i = 0; $i < count($tables); $i++) {
        $sql.= "join ". $tables[$i]. " on " . $tables[$i].'.id_'.$tables[$i] . ' = ' .$maintable.'.id_'.$tables[$i] . " ";
    }
    $sql.= "join type_tovar on tovar.id_type_tovar = type_tovar.id_type_tovar";
//    print($sql);
    $select = $pdo->query($sql);
    $data = $select->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($data);
    $groupedRows = [];


    foreach ($data as $item) {
        $newItem = [];
        foreach ($item as $key => $value) {
            if (array_key_exists($key, $accostiation) and ($key != 'title_'.$maintable)) {
                $newKey = $accostiation[$key];
            } else {
                $newKey = $key;
            }
            $newItem[$newKey] = $value;
        }
        $groupedRows[] = $newItem;
    }
    $needColumns = [$maintable,'id_'.$maintable, 'id_tovar', 'title_'.$maintable, 'Цена'];
//    var_dump($groupedRows);

    $arr= [];
    foreach ($groupedRows[0] as $key => $value) {

        if (array_search($key, $accostiation) != false and $key !== 'Цена') {

            $arr[] = $key;

        }
    }
    $needColumns[] = $arr;





    $pdo = null;

    return [$groupedRows, $needColumns];

}

//getListTovarsSameCategory('computer');

function getImageToCatalog()
{
    $pdo = ConnectToDataBase();
    $tables = ['motherboard', 'processor', 'computer', 'ram_memory', 'graphics_card'];
    $res = [];
    foreach ($tables as $item) {

        $sql = "select ". $item. ".img from tovar join $item on tovar.id_tovar = $item".".id_tovar limit 1";

        $img = $pdo->query($sql)->fetch();

        if ($img) {
            $res[$item] = $img['img'];
        }
    }



    return $res;
}




function getInfoTovar ($maintable, $id_tovar) {

    $pdo = ConnectToDataBase();

    // получение таблиц характеристик связанных с основной таблицей других таблиц
    $tables = [];
    $select = $pdo->query("SELECT * FROM $maintable limit 1")->fetch();

    foreach ($select as $k => $v) {
        $pos = strpos($k, 'id_');
        if (( $pos!== false) and ($k != 'id_' . $maintable) and($k != 'id_tovar')) {
            $tables[] = ltrim($k, 'id_');
        };
    };

    // получение информации о конкретном товаре
    $sql = "select *, $maintable.img, $maintable.price, $maintable.id_tovar from $maintable  join tovar on $maintable.id_tovar = tovar.id_tovar ";
    for($i = 0; $i < count($tables); $i++) {
        $sql.= "join ". $tables[$i]. " on " . $tables[$i].'.id_'.$tables[$i] . ' = ' .$maintable.'.id_'.$tables[$i] . " ";
    }
    $sql.= "join type_tovar on tovar.id_type_tovar = type_tovar.id_type_tovar where $maintable.id_tovar = $id_tovar";

    $select = $pdo->query($sql)->fetchAll(pdo::FETCH_ASSOC);


    // перевод названий столбцов для отображения на странице
    $accostiation = [
        'title_maker' => "Производитель", 'title_chipset'=>'Чипсет', 'number_number_of_cores'=> 'Количество ядер', 'title_type_of_memory'=> 'Тип памяти',
        'number_number_memory'=> 'Количество памяти', 'number_memory_freq' => 'Частота памяти', 'title_socket'=> "Сокет", 'title_processor' => 'Процессор',
        'title_graphics_card' => 'Видеокарта', 'title_motherboard' => 'Материнская плата', 'title_ram_memory'=> 'Оперативная память'];

    $data = [];
    foreach ($select as $item) {
        $newItem = [];
        foreach ($item as $key => $value) {
            if (array_key_exists($key, $accostiation) and ($key != 'title_'.$maintable)) {
                $newKey = $accostiation[$key];
            } else {
                $newKey = $key;
            }
            $newItem[$newKey] = $value;
        }
        $data[] = $newItem;
    }


    // получение массива с названием нужных нам на странице столбцов, названия которых мы не знаем
    $needColumns = ['title_'.$maintable];

    $arr =[];
    $data = $data[0];
    foreach ($data as $key => $value) {

        if (array_search($key, $accostiation) != false) {
            $arr[] = $key;
        }
    }
    $needColumns[] = $arr;

    $pdo = null;
    return [$needColumns, $data];
}

function getFromShoppingCart($id_user)
{
    $pdo = ConnectToDataBase();
    $sql = "select shopping_cart.id_tovar, title_processor, title_motherboard, title_computer, title_ram_memory, 
       title_graphics_card, title_type_tovar, motherboard.price, processor.price, computer.price, ram_memory.price, 
        graphics_card.price from shopping_cart 
        join tovar on tovar.id_tovar = shopping_cart.id_tovar
        join type_tovar on tovar.id_type_tovar = type_tovar.id_type_tovar
        left join motherboard on motherboard.id_tovar = tovar.id_tovar 
        left join processor on processor.id_tovar = tovar.id_tovar 
        left join ram_memory on ram_memory.id_tovar = tovar.id_tovar 
        left join graphics_card on graphics_card.id_tovar = tovar.id_tovar 
        left join computer on computer.id_tovar = tovar.id_tovar 
        where shopping_cart.id_user = $id_user";
    $select = $pdo->query($sql)->fetchAll(PDO::FETCH_NAMED);

    $result = [];
    foreach ($select as $item) {

        $arr = [];
        $arr['title_type_tovar'] = $item['title_type_tovar'];
        foreach ($item as $key => $value) {
            if ($key == 'price'){
                foreach ($value as $k) {
                    if($k !== NULL) {
                        $arr['price'] = $k;
                        break;
                    }
                }
                continue;
            }
            if ($value !== NULL and $key != 'id_tovar' and $key != 'title_type_tovar') {
                $arr['title'] = $value;
                $arr['table'] = ltrim($key, 'title_');
            }

        }
        $result[$item['id_tovar']] = $arr;
    }
    return $result;
}

?>

