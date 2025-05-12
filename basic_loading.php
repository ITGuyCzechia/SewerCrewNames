<?php
include_once 'dbh.inc.php';
function timeDifference($timeLower, $timeHigher){
    $last   = new DateTime($timeLower);
    $newer  = new DateTime($timeHigher);
    $uncount_r = $newer->diff($last, true);
    $result = $uncount_r->format('%s') 
              + ($uncount_r->format('%i')*60) // "i" is for minutes
              + ($uncount_r->format('%h')*60*60)
              + ($uncount_r->format('%days')*60*60*24);
    return $result;
}

function checkLastItem($conn, $name){
    $select_sql = "SELECT Name, id FROM vitoxwzcz6764.SewerCrewNames WHERE id=(SELECT max(id) FROM vitoxwzcz6764.SewerCrewNames);";
                    
    $select_result2 = mysqli_query($conn, $select_sql);
    
    while($row = mysqli_fetch_assoc($select_result2)){
           if(strcmp($name, $row['Name']) !== 0){
               return false;
           }else{
               return true;
           }
    }
}

function putToDatabase($conn, $name){
    $myName = str_replace("'", "", $name);
    
    /*$select_sql = "SELECT Name, date, id FROM vitoxwzcz6764.SewerCrewNames
                    WHERE Name='".$myName."' and date LIKE '".date("Y-m-d")."%'";*/
    $select_sql = "SELECT Name, date, id FROM vitoxwzcz6764.SewerCrewNames
                    WHERE Name='".$myName."' and date LIKE '".date("Y-m-d")."%'";
                    
    $select_result = mysqli_query($conn, $select_sql);
    $resultCheck = mysqli_num_rows($select_result);
    
    if($resultCheck == 0 and !checkLastItem($conn, $name)){
        $sql = "INSERT INTO vitoxwzcz6764.SewerCrewNames (`Name`, `date`) VALUES ('".$myName."', '".date(DATE_ATOM)."');";
        $errorstatus = mysqli_query($conn, $sql);
        if(!$errorstatus){
            echo "<b>Chyba (".$errorstatus.")</b> v databázovém systému: Stránka nemohla nahrát data do databáze. Nenahraný název byl ".$myName."<br> Zkus to klidně <a href='http://vitox.wz.cz/SewerCrewNames/basic_loading.php'>hned</a> znovu.";
        }else{
            echo "<b>Název ".$myName." byl úspěšně nahrán.<br>";
        }
    }else{
        echo "<div class='redDebug'><p>Jméno je již v databázi! :) Bylo nalezeno: ".$name."</b></p></div>";
        $lastItem; $id; 
        if($select_result->num_rows == 0){ 
            $select_sql = "SELECT Name, id, date FROM vitoxwzcz6764.SewerCrewNames WHERE id=(SELECT max(id) FROM vitoxwzcz6764.SewerCrewNames);";
            $select_result = mysqli_query($conn, $select_sql);
        }
        while($row = mysqli_fetch_assoc($select_result)){
            $lastItem   = $row['date']; 
            $id         = $row['id'];
        } 
         
        $timeDifferenceResult = timeDifference($lastItem, date(DATE_ATOM));
        $sql = "UPDATE vitoxwzcz6764.SewerCrewNames SET duration = '$timeDifferenceResult' WHERE id = $id;";
        $errorstatus = mysqli_query($conn, $sql);
        
        if(!$errorstatus){
            echo "<b>Chyba (".$errorstatus.")</b> doba názvu serveru nebyla nahrána.<br>";
        }else{
            echo "<b>Čas přidán.<br>";
        }
    }
}

// It helped to reset the actual new page without caching.
function randomString(){
    return "?v=".rand();
}

function findName(){
    $schedule   = file_get_contents("https://discord.com/api/guilds/336906136949096448/widget.json".randomString());
    $result     = json_decode($schedule, true);
    return $result["name"];
}

$name = findName();
if(strcmp("Sewer Crew", $name) !== 0){
    putToDatabase($conn, $name);
}else{
    echo "Byl nalezen jen název Sewer Crew.<br>Zkus to klidně <a href='http://vitox.wz.cz/SewerCrewNames/basic_loading.php'>hned</a> znovu.";
}

?>
