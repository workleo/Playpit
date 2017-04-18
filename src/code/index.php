<?php
require_once('classes/Autoloader.php');
spl_autoload_register('Autoloader::loader');

define('CARTMAN', 'Cartman');
define('STAN', 'Stan');
define('KENNY', 'Kenny');
define('KYLE', 'Kyle');

define('WALK', 'walking');
define('JUMP', 'jumping');
define('ROLL', 'rolling');


function is_element_check($arRestore, $rowName, $colName = null)
{
    $chk = '';
    if ($colName == null) {
        if ($arRestore[$rowName]) $chk = 'checked ';
    } else {
        if ($arRestore[$rowName][$colName]) $chk = 'checked ';
    }
    return $chk;
}

function create_radio_input_column($individ, $_move, $_rbBoxRestore)
{
    $id_class = $individ . '_' . $_move;
    $rb = '<label><input type="radio" id="' . $id_class . '" ' . 'name="' . $individ . 'RBox[]" '
        . 'value="' . $_move . '" '
        . is_element_check($_rbBoxRestore, $individ, $_move)
        . 'onclick="' . 'document.getElementById(' . "'" . $individ . "'" . ').className = ' . "'" . $_move . "'" . '; "'
        . '/>' . $_move . "</label>\n";
    return $rb;
}

function create_table_columns($caption, $individ, $_cbxRestore)
{
    $td = '<td>' . $caption . "</td>\n"
        . '<td><label>'
        . '<input type="checkbox" name="individCbx[]" value="' . $individ . '" '
        . is_element_check($_cbxRestore, $individ) . " ></label></td>\n";
    return $td;
}


function create_individuum_table($arIndividName, $arMove, $_cbxRestore, $_rbBoxRestore)
{

    $tab = '';
    foreach ($arIndividName as $individ) {
        $tab .= '<tr>' . create_table_columns($individ, $individ, $_cbxRestore);
        $tab .= '<td>';

        foreach ($arMove as $move) {
            $tab .= create_radio_input_column($individ, $move, $_rbBoxRestore);
        }
        $tab .= '</td></tr>';
    }
    echo $tab;
}


function add_2_playpit($playpit, $individName, & $rbBoxArr, & $isMove)
{
    $rbBox = $individName . 'RBox';
    $_image = '';
    $move = '';
    switch ($individName) {
        case CARTMAN:
            $_image = '../res/img/cartman.gif';
            break;
        case KENNY:
            $_image = '../res/img/kenny.gif';
            break;
        case STAN:
            $_image = '../res/img/stan.gif';
            break;
        case KYLE:
            $_image = '../res/img/kyle.gif';
            break;
        default:
            break;
    }
    if (($_image != '') && ($rbBox != '')) {


        foreach ($rbBoxArr[$individName] as $key => $move) {
        };

        $_move = null;
        if ($isMove) {
            $_move = $move;
        }
        if ($individName != KYLE) {
            $boy = new Individuum($individName, $_image, $_move);
        } else {
            $boy = new Singer($individName, $_image, $_move);
            $boy->setSong("../res/audio/hanukkah.ogg");
            if ($_move != null) {
                $boy->sing();
            }

        }

        /** @var  Playpit $playpit */
        $playpit->addIndividuum($boy);
    }
    return $move;
}


function create_list_individ($playpit, & $cbxArr, & $_cbxRestoreArr, & $rbBoxArr, & $_rbBoxRestoreArr, & $isMove)
{
    if (Count($cbxArr)) {
        foreach ($cbxArr as $key => $individName) {
            $_cbxRestoreArr[$individName] = true;
            $move = add_2_playpit($playpit, $individName, $rbBoxArr, $isMove);
            if ($move != '') $_rbBoxRestoreArr[$individName][$move] = true;
        }
    }
}


$cbxArr = array();
$cbxRestoreArr = array();
$rbBoxArr = array();
$rbBoxRestoreArr = array();

$isMove = false;

//if ($_SERVER["REQUEST_METHOD"] !== "POST") {
//    $pitStr .= ' THIS SERVER DOESN"T SUPPORT POST METHOD';
//}


if ($_GET) {
    $isMove = !($_GET["btnStop"]);
    $cbxArr = $_GET['individCbx'];
    foreach ($cbxArr as $key => $individName) {
        if (isset($_GET[$individName . 'RBox'])) {
            $rbBoxArr[$individName] = $_GET[$individName . 'RBox'];
        }
    }

    if (isset($_GET['individRBox'])) $rbBoxArr = $_GET['individRBox'];
} else

    if ($_POST) {
        $isMove = !($_POST["btnStop"]);
        $cbxArr = $_POST['individCbx'];
        foreach ($cbxArr as $key => $individName) {
            if (isset($_POST[$individName . 'RBox'])) {
                $rbBoxArr[$individName] = $_POST[$individName . 'RBox'];
            }
        }
    }


$pitStr = '';
$playpit = new Playpit();

if ($isMove) {
    create_list_individ($playpit, $cbxArr, $cbxRestoreArr, $rbBoxArr, $rbBoxRestoreArr, $isMove);
    $pitStr = $playpit->move_all();
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../res/css/move.css">

    <title>PLAYPIT</title>
    <style>
    </style>

</head>

<body style="background-color: lightgray">
<form method="post" action="index.php" id="form" name="form">

    <input type="submit" class='sign' value=" "
           style="background:url('../res/img/south_park.png') no-repeat ;" title="START"/>

    <table style="display:inline-block; padding-bottom: 40px">
        <?php create_individuum_table(array(CARTMAN, KENNY, STAN, KYLE), array(WALK, JUMP, ROLL), $cbxRestoreArr, $rbBoxRestoreArr); ?>
    </table>


    <input type="submit" name="btnStop" value=" " class='sign'
           style="background:url('../res/img/Kids.png') no-repeat ;" title="STOP"/>
    <br>
    <?php echo $pitStr; ?>
    <br>

</form>
</body>


</html>