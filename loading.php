<?php
// Include secret code with password for internet connection with db.
include_once 'dbh.inc.php';

define('DIFFERENCE_ARRAY_KEYNUMBER_AND_DB_ID', '840'); 

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
    
    $select_sql = "SELECT Name, date, id FROM vitoxwzcz6764.SewerCrewNames
                    WHERE Name='".$myName."' and date LIKE '".date("Y-m-d")."%'";
                    
    $select_result = mysqli_query($conn, $select_sql);
    $resultCheck = mysqli_num_rows($select_result);
    
    if($resultCheck == 0 and !checkLastItem($conn, $name)){
        $sql = "INSERT INTO vitoxwzcz6764.SewerCrewNames (`Name`, `date`) VALUES ('".$myName."', '".date(DATE_ATOM)."');";
        $errorstatus = mysqli_query($conn, $sql);
        if(!$errorstatus){
            echo "<b>Error (".$errorstatus.")</b> in database system: Page couldn't upload data to database. Unupload data was name ".$myName."<br>";
        }else{
            echo "<b>Name ".$myName." successly uploaded.<br>";
        }
    }else{
        echo "<div class='redDebug'><p>Name is already in database for this data. Name is: ".$name."</b></p></div>";
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
            echo "<b>Error (".$errorstatus.")</b> duration for name was not upload.<br>";
        }else{
            echo "<b>Duration upload.<br>";
        }
    }
}

function randomString(){
    return "?v=".rand();
}

function loadJSON_widget(){
    $widget     = file_get_contents("https://discord.com/api/guilds/336906136949096448/widget.json".randomString());
    $result     = json_decode($widget, true);
    return $result;
}

function findName($JSON_widget){
    return $JSON_widget["name"];
}

function selectAllUsername($conn){
    $array_username_from_db = array();
    $select_sql = "SELECT id_user, username FROM vitoxwzcz6764.SewerCrewNames_Usernames";
    $select_result = mysqli_query($conn, $select_sql);
    while($row = mysqli_fetch_assoc($select_result)){
        array_push($array_username_from_db, $row['username']);
    };
    return $array_username_from_db;
}

function convertForSQL($username){
    $array_username = mb_str_split($username);
    $newUsername = "";
    $allowedSpecialCharacters = array("á","é","í","ý","ó","ú",
    "Á","É","Í","Ý","Ó","Ú","ů","Ů","ě","š","č","ř","ž","ť","ň",
    "Ě","Š","Č","Ř","Ž","Ť","Ň","_","ü","?","!","{","}","/","(",")",">","<",":",",");
    
    $convertThis = array("🇰","🇸","𝐇","𝐚","𝐮","𝐛","𝐀","𝐕","𝐌","𝐏","𝐥",
    "𝐝","𝐨","𝐱","𝐢","𝐫","𝐳","𝐬","𝐡","𝐞","𝐧","𝐭","𝐣","𝐤","𝐯","𝐩",
    "𝐲","𝐎","𝐂","𝐀","𝙳","𝚘","𝚗","𝙼","𝚊","𝚛","𝚝","𝚒","𝔃","𝓪","𝓸",
    "𝓶","𝐟","𝐄","ℤ","𝕻","𝕺","𝕷","𝕰","𝕶","𝕬","𝕯","𝕱","𝕴","𝕹","𝐒",
    "𝐍","𝔽","𝕖","𝕣","𝕚","𝕩","𝕐","𝕋","𝟜","𝖙","𝟙");

    $toThese = array("K","S","H","a","u","b","A","V","M","P","l","d","o","x",
    "i","r","z","s","h","e","n","t","j","k","v","p","y","O","C","A","D","o","n",
    "M","a","r","t","i","z","a","o","m","f","E","Z","B","O","L","E","R","U","D",
    "F","I","N","S","N","F","e","r","i","x","Y","T","4","t","1");

    foreach($array_username as $letter){
        if(preg_match("/[a-zA-Z0-9\.\+\-_ |]/i", $letter)){
            $newUsername = $newUsername.$letter;
        }else{
            if(array_search($letter, $allowedSpecialCharacters) !== false){
                $newUsername = $newUsername.$letter;
            }else{
                $isItCharacterICanConvert = array_search($letter, $convertThis);
                if($isItCharacterICanConvert !== false){
                    $newUsername = $newUsername.$toThese[$isItCharacterICanConvert];
                }
            }
        }
    }
    
    if(empty($newUsername)){
        $newUsername = "Službě neznámý uživatel";
    }
    return $newUsername;
}

function addUsername($username, $conn){
    $myUsername = str_replace("'", "", $username);
    $sql = "INSERT INTO vitoxwzcz6764.SewerCrewNames_Usernames (`username`) VALUES ('".$myUsername."');";
    $errorstatus = mysqli_query($conn, $sql);
    if(!$errorstatus){
        echo "<b>Error (".$errorstatus.")</b> in database system: Page couldn't upload data to database. Unupload data was name ".$myUsername."<br>";
    }else{
        echo "<b> - Name '".$myUsername."' successly uploaded.</b><br>";
    }
}

function processUsername($JSON_widget, $conn, $name){
    foreach($JSON_widget["members"] as $mem){
        $username = convertForSQL($mem["username"]);
        $key = array_search($username, selectAllUsername($conn));
        $id_servername = findIdOfServername($name, $conn);
        $id_user;
        
        if($key === false){
            addUsername($username, $conn);
            $id_user = findIdOfUser($username, $conn);
            echo "Added new username. ";
        }else{   
		// I did not wanted to load User ID everytime, but I was not Inspector Gadget enough to have same ID like order of array. 
		// So I made compromise. I made constant. DIFFERENCE_ARRAY_KEYNUMBER_AND_DB_ID
            $id_user = constant('DIFFERENCE_ARRAY_KEYNUMBER_AND_DB_ID') + $key;
        }
        
        if(checkUniqueOfValueForOnlineDuringName($id_servername, $id_user, $conn)){
            addOnlineDuringName($id_servername, $id_user, $conn);
        }
    }
}

function findIdOfServername($name, $conn){
    $select_sql = "SELECT id FROM vitoxwzcz6764.SewerCrewNames WHERE Name='".$name."' ORDER BY id DESC;";
    $select_result = mysqli_query($conn, $select_sql);
    while($row = mysqli_fetch_assoc($select_result)){
        return $row['id'];
    } 
}

function findIdOfUser($username, $conn){
    $select_sql = "SELECT id_user FROM vitoxwzcz6764.SewerCrewNames_Usernames WHERE username='".$username."' ORDER BY id_user DESC;";
    $select_result = mysqli_query($conn, $select_sql);
    while($row = mysqli_fetch_assoc($select_result)){
        return $row['id_user'];
    } 
    return 1187; // Item called Unknown user
}


function checkUniqueOfValueForOnlineDuringName($id_servername, $id_user, $conn){
    $select_sql = "SELECT id_onlineduringname FROM vitoxwzcz6764.SewerCrewNames_OnlineDuringName  
    WHERE id_servername='".$id_servername."' and id_user='".$id_user."';";
       
    $select_result = mysqli_query($conn, $select_sql);
    $resultCheck = mysqli_num_rows($select_result);
    
    if($resultCheck == 0){
        return true;
    }else{
        return false;
    }
}

function addOnlineDuringName($id_servername, $id_user, $conn){
    $sql = "INSERT INTO vitoxwzcz6764.SewerCrewNames_OnlineDuringName (`id_servername`, `id_user`) VALUES ('".$id_servername."', '".$id_user."');";
    $errorstatus = mysqli_query($conn, $sql);
    if(!$errorstatus){
        echo "<b>Error (".$errorstatus.")</b> in database system: Page couldn't upload data about online users to database.";
    }
}

$JSON_widget = loadJSON_widget();
$name = findName($JSON_widget);
//addUsername($JSON_widget, $conn);

if(strcmp("Sewer Crew", $name) !== 0){
    putToDatabase($conn, $name);
    processUsername($JSON_widget, $conn, $name);
    echo "Done.";
}else{
    echo "None of new name. Just Sewer Crew.<br>";
}

?>