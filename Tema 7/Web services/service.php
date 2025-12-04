$db = json_decode(file_get_contents ('credenciales.txt’),true);
<?php
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
switch ($_SERVER["REQUEST_METHOD"]) {
    case "PUT":
        echo "Estoy haciendo UPDATE";
        break;
    case "POST":
        echo "Estoy haciendo INSERT";
        break;
    case "DELETE";
        echo "Estoy haciendo DELETE";
        break;
    case "GET":
    default:
        header("Content-Type:application/json");
        echo json_encode($arr);
        break;
}
header("Content-Type:application/json");
echo json_encode($arr);
?>