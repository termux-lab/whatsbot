<?php
ini_set('date.timezone', 'Europe/Moscow');
include("./CatDataBase/index.php");
$key = array("test", "test");
if(cat_check_db("wa", $key) == "db_0"){
    cat_db("wa", $key);
}
$vowels = array('"', '\\');
$replace = array("''", "/");
$messageOrig = str_replace($vowels, $replace, $_POST['message']);
$message = mb_strtolower($messageOrig, 'UTF-8');
$ch_name = str_replace($vowels, $replace, $_POST['sender']);
$today = date('d');
if($today == '1'){
    $etoday = 31;
}else{
    $etoday = $today-1;
}

cat_table("wa", $ch_name, $key);
cat_table("wa", $ch_name."msg-".$today, $key);
$old_msg = cat_read("wa", $ch_name."msg-".$today, "z-".date("H:i"), $key);
if($old_msg == "column_0"){$old_msg = '';}
cat_column("wa", $ch_name."msg-".$today, "z-".date("H:i"), $old_msg."\n".$ch_name.": ".$messageOrig, $key);
cat_del_table("wa", $ch_name."msg-".$etoday, $key);

$cmd = str_replace(" ", "", explode("\n", $message)[0]);
if($message == "!стата"){
    $mats = cat_read("wa", $ch_name, "mats", $key);
    if($mats == "column_0"){
        $mats = 0;
    }
    $otw = "Название чата: ".$ch_name
            ."\nСообщений с матом: ".$mats;

}else if($cmd ==  str_replace(" ", "", "!новые правила")){
    cat_table("wa", $ch_name, $key);
    cat_column("wa", $ch_name, "prav", $messageOrig, $key);
    $otw = "Новые правила установлены";


}else if($cmd == "!правила"){
    $otw = cat_read("wa", $ch_name, "prav", $key);
    if($otw == "column_0" or $otw == "table_0"){$otw = "Правила не установлены. Как установить правила?\n\n*Пример:*\n!новые правила\n1. правило 1\n2.правило 2\n... \nи т.п";}



}else if($cmd == "!команды" or $cmd == "!помощь"){
    $otw = "*!правила* - показать правила\n".
            "*!новые правила* - установить новые правила\n".
            "*!стата* - статистика чата\n".
            "*!восстановить* - может показать все и удаленные сообщения(в течении суток)";


}else if($cmd == "!восстановить"){
    $time = str_replace(" ", "", explode("\n", $message)[1]);
    if($time == ""){
        $otw = "Время бота: *".date("H:i")."*\n\n*Пример:*\n".
                "!восстановить\n12:44";
    }else{
        $otw = cat_read("wa", $ch_name."msg-".date('d'), "z-".$time, $key);
        if($otw == "column_0"){$otw = "Сообщений нет";}
    }



}else{
    $mats = explode(" ", "шлюха спермер писюн писька пидор мудак лох кретин идиот засранец залупа дебил дрочила гондон хуй гнида сука сук сучара ебать выебу ъебу уебу бля");
    $count_mat = 0;
    foreach($mats as $mats_check){
        if(strpos($message, $mats_check) !== false){
            $count_mat++;
        }
    }
    if($count_mat != 0){
        cat_table("wa", $ch_name, $key);
        $fromDbCountMat = cat_read("wa", $ch_name, "mats", $key);
        if($fromDbCountMat == ''){$fromDbCountMat = 0;}
        cat_column("wa", $ch_name, "mats", $fromDbCountMat+1, $key);
    }



}

$returr ='{"reply": "'.$otw.'"}';
echo($returr);

?>

