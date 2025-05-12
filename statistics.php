<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Sewer Crew Names</title>
        <link rel="stylesheet" href="style.css">
        <meta name="keywords" content="Sewer Crew názvy, Sewer Crew jména, Discord name 
        server tracker, Discord, Sewer Studiouz, Sewer Crew, Mipe, Změnili 
        název serveru, SwC Names, SwS, SwC">
        <meta name="autor" content="Vít Hrbáček">
        <link data-rh="true" rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <meta property="og:image"  content="http://vitox.wz.cz/SewerCrewNames/img/sewer_crew_names_icon_shared.png"/>
        <meta name="twitter:image" content="http://vitox.wz.cz/SewerCrewNames/img/sewer_crew_names_icon_shared.png"/>
        <meta itemprop="name"      content="Statistiky Sewer Crew Names"/>
        <meta property="og:title"  content="Statistiky Sewer Crew Names"/>
        <meta name="twitter:title" content="Statistiky Sewer Crew Names"/>
        <meta name="description" property="description" content="Statistiky archivu alternativních názvů"/>
        <meta property="og:description"                 content="Statistiky archivu alternativních názvů"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="script.js"></script>
    </head>
    <body>
        <ul class="lista">
            <li class="polozkaListy"><a href="https://sewers.webnode.cz/">Sewer Studiouz Web</a></li>
            <li class="polozkaListy"><a href="https://www.youtube.com/@SewerStudiouz/videos">SwS YouTube</a></li>
            <li class="polozkaListy"><a href="https://twitter.com/SewerStudiouz">SwS Twitter/X</a></li>
            <li class="polozkaListy"><a href="https://discord.com/">Discord</a></li>
            <li class="polozkaListy"><a href="https://socialblade.com/youtube/channel/UCiwqzkaQSkmRvakt6FJZikw">SocialBlade (Statistiky YT kanálu)</a></li>
            <li class="polozkaListy"><a href="http://kdybudebasta.wz.cz:8080/">Kdy bude Bašta?</a></li>
            <li class="polozkaListy"><a href="http://vitox.wz.cz:8080/NetflixDabing/index.php">Statistiky dabingů na Netflixu</a></li>
            <li class="polozkaListy"><a href="http://lladdakgallery.wz.cz:8080/disneyplus/">Přehled mapy stránek Disney+</a></li>
            <li class="polozkaListy"><a href="http://hledacobrazku.wz.cz:8080/">Hledač obrázků na eStránky</a></li>
        </ul>
        <header>
            <div class="menu">
                <a class="SwC-logo" href="http://vitox.wz.cz/SewerCrewNames/index.php">
                    <img class="logo" src="sewer_crew_logo_white.png">
                </a>
                
                <a class="SwC-bar icon"  href="javascript:void(0);" onclick="changeDisplay()">
                        <i class="fa fa-bars"></i>
                </a>
                    
                <a id="myLinks1" href="http://vitox.wz.cz/SewerCrewNames/statistics.php">
                    Statistiky
                </a>
                
                <a id="myLinks2" href="http://vitox.wz.cz/SewerCrewNames/about.php">
                    O projektu
                </a>
                
                <span id="myLinks3">
                    <form method="GET" action="search.php">
                        <input type="text" name="s" placeholder="Vyhledat..." size="25">
                        <input type="submit" value="Vyhledat">
                    </form>
                </span>
                
                <a class="button" href="https://discord.gg/mUeXgGu">Připojit se na server</a>
            </div>
        </header>
        <article id="names">
            <div>
                <h3 class="napis">Statistiky</h3> <div class="statistics_div"><div><?php
                // This inserts secret code with password, etc., for database connection. 
                include_once 'dbh.inc.php';

function numberNames($conn){               
    $select_sql     = "SELECT count(id) as numberNames FROM vitoxwzcz6764.SewerCrewNames Limit 1;"; 
    $select_result  = mysqli_query($conn, $select_sql);
    $resultCheck    = mysqli_num_rows($select_result);
    
    while($row = mysqli_fetch_assoc($select_result)){
        return $row['numberNames'];
    }
}

function durationSentance($conn){               
    $select_sql     = "SELECT * FROM vitoxwzcz6764.SewerCrewNames order by duration DESC limit 2;"; 
    $select_result  = mysqli_query($conn, $select_sql);
    $resultCheck    = mysqli_num_rows($select_result);
    
    $string = "Názvem s nejdéle zaznamenanou dobou trvání byl <b>";
    
    $row = mysqli_fetch_assoc($select_result);
    $string = $string."<a href='http://vitox.wz.cz/SewerCrewNames/name.php?id=".$row['id']."'>".$row['Name']."</a></b> (".round($row['duration']/3600)." hodin).</b> Druhým je <b>";
    $row = mysqli_fetch_assoc($select_result);
    $string = $string."<a href='http://vitox.wz.cz/SewerCrewNames/name.php?id=".$row['id']."'>".$row['Name']."</a></b> (".round($row['duration']/3600)." hodin). ";
    
    return $string;
}

function onlineSentance($conn){               
    $select_sql     = "SELECT id, Name, count(id_user) as online 
    FROM vitoxwzcz6764.SewerCrewNames 
    left JOIN vitoxwzcz6764.SewerCrewNames_OnlineDuringName 
    ON SewerCrewNames_OnlineDuringName.id_servername=SewerCrewNames.id 
    GROUP by id order by online desc LIMIT 2;"; 
    
    $select_result  = mysqli_query($conn, $select_sql);
    $resultCheck    = mysqli_num_rows($select_result);
    
    $string = "Název, během kterého nejvíce uživatelů bylo zaznamenáno online, je <b>";
    
    $row = mysqli_fetch_assoc($select_result);
    $string = $string."<a href='http://vitox.wz.cz/SewerCrewNames/name.php?id=".$row['id']."'>".$row['Name']."</a></b> (".$row['online']." online).</b> Druhým je <b>";
    $row = mysqli_fetch_assoc($select_result);
    $string = $string."<a href='http://vitox.wz.cz/SewerCrewNames/name.php?id=".$row['id']."'>".$row['Name']."</a></b> (".$row['online']." online). ";
    
    return $string;
}

function visitSentance($conn){               
    $select_sql     = "SELECT id, Name, visit 
    FROM vitoxwzcz6764.SewerCrewNames 
    left JOIN vitoxwzcz6764.SewerCrewNames_OnlineDuringName 
    ON SewerCrewNames_OnlineDuringName.id_servername=SewerCrewNames.id 
    GROUP by id order by visit desc LIMIT 2;"; 
    
    $select_result  = mysqli_query($conn, $select_sql);
    $resultCheck    = mysqli_num_rows($select_result);
    
    $string = "Největší počet žádostí o načtění profilu názvu získal profil <b>";
    
    $row = mysqli_fetch_assoc($select_result);
    $string = $string."<a href='http://vitox.wz.cz/SewerCrewNames/name.php?id=".$row['id']."'>".$row['Name']."</a></b> (".$row['visit'].").</b> Druhým je <b>";
    $row = mysqli_fetch_assoc($select_result);
    $string = $string."<a href='http://vitox.wz.cz/SewerCrewNames/name.php?id=".$row['id']."'>".$row['Name']."</a></b> (".$row['visit']." žádostí o načtění). ";
    
    return $string;
}

function averageDuration($conn){               
    $select_sql     = "SELECT avg(duration) as result FROM vitoxwzcz6764.SewerCrewNames where `duration` is not null;"; 
    $select_result  = mysqli_query($conn, $select_sql);
    $resultCheck    = mysqli_num_rows($select_result);
    $row = mysqli_fetch_assoc($select_result);
    return $row['result'];
}

function averageDurationForLast7Days($conn){
    $day_minus_seven    = date('d',strtotime("-7 days"));
    $month_minus_seven  = date('m',strtotime("-7 days"));
    $year_minus_seven   = date('Y',strtotime("-7 days"));
    
    $select_sql     = "SELECT avg(duration) as result FROM vitoxwzcz6764.SewerCrewNames 
    WHERE vitoxwzcz6764.SewerCrewNames.date > '".$year_minus_seven."-".$month_minus_seven."-".$day_minus_seven." ".date('H:i:s')."'
    AND vitoxwzcz6764.SewerCrewNames.date < '".date('Y')."-".date('m')."-".date('d')." ".date('H:i:s')."';";

    $select_result  = mysqli_query($conn, $select_sql);
    $resultCheck    = mysqli_num_rows($select_result);
    $row = mysqli_fetch_assoc($select_result);
    return $row['result'];
}

function averageDurationForPreviousLast7Days($conn){
    $day_minus_two_weeks   = date('d',strtotime("-14 days"));
    $month_minus_two_weeks = date('m',strtotime("-14 days"));
    $year_minus_two_weeks  = date('Y',strtotime("-14 days"));
    
    $day_minus_seven    = date('d',strtotime("-7 days"));
    $month_minus_seven  = date('m',strtotime("-7 days"));
    $year_minus_seven   = date('Y',strtotime("-7 days"));
    
    $select_sql     = "SELECT avg(duration) as result FROM vitoxwzcz6764.SewerCrewNames 
    WHERE vitoxwzcz6764.SewerCrewNames.date > '".$year_minus_two_weeks."-".$month_minus_two_weeks."-".$day_minus_two_weeks." ".date('H:i:s')."'
    AND vitoxwzcz6764.SewerCrewNames.date < '".$year_minus_seven."-".$month_minus_seven."-".$day_minus_seven." ".date('H:i:s')."';";
    
    $select_result  = mysqli_query($conn, $select_sql);
    $resultCheck    = mysqli_num_rows($select_result);
    $row = mysqli_fetch_assoc($select_result);
    
    return $row['result'];
}

function numberOfNamesFromLast7Days($conn){
    $day_minus_seven    = date('d',strtotime("-7 days"));
    $month_minus_seven  = date('m',strtotime("-7 days"));
    $year_minus_seven   = date('Y',strtotime("-7 days"));
    
    $select_sql     = "SELECT count(id) as result FROM vitoxwzcz6764.SewerCrewNames 
    WHERE vitoxwzcz6764.SewerCrewNames.date > '".$year_minus_seven."-".$month_minus_seven."-".$day_minus_seven." ".date('H:i:s')."'
    AND vitoxwzcz6764.SewerCrewNames.date < '".date('Y')."-".date('m')."-".date('d')." ".date('H:i:s')."';";

    $select_result  = mysqli_query($conn, $select_sql);
    $resultCheck    = mysqli_num_rows($select_result);
    $row = mysqli_fetch_assoc($select_result);
    return $row['result'];
}

function numberOfNamesFromPreviousLast7Days($conn){
    $day_minus_two_weeks   = date('d',strtotime("-14 days"));
    $month_minus_two_weeks = date('m',strtotime("-14 days"));
    $year_minus_two_weeks  = date('Y',strtotime("-14 days"));
    
    $day_minus_seven    = date('d',strtotime("-7 days"));
    $month_minus_seven  = date('m',strtotime("-7 days"));
    $year_minus_seven   = date('Y',strtotime("-7 days"));
    
    $select_sql     = "SELECT count(id) as result FROM vitoxwzcz6764.SewerCrewNames 
    WHERE vitoxwzcz6764.SewerCrewNames.date > '".$year_minus_two_weeks."-".$month_minus_two_weeks."-".$day_minus_two_weeks." ".date('H:i:s')."'
    AND vitoxwzcz6764.SewerCrewNames.date < '".$year_minus_seven."-".$month_minus_seven."-".$day_minus_seven." ".date('H:i:s')."';";
    
    $select_result  = mysqli_query($conn, $select_sql);
    $resultCheck    = mysqli_num_rows($select_result);
    $row = mysqli_fetch_assoc($select_result);
    
    return $row['result'];
}

?>      
                
                <p class="text_paragraph">V databázi je <b><?php echo numberNames($conn); ?></b> názvů. 
                Alternativní název průměrně vydrží <b><?php echo round(averageDuration($conn)/60); ?> minut</b>.<br> <?php echo durationSentance($conn); ?></p>
                <p class="text_paragraph">Za posledních 7 dní názvy vydrželi <b><?php echo round(averageDurationForLast7Days($conn)/60)." minut</b> v průměru. 
                Posledních 7 dní mělo <b>".numberOfNamesFromLast7Days($conn)," názvů</b>.<br>
                Předchozích 7 dní to bylo <b>".round(averageDurationForPreviousLast7Days($conn)/60)." minut</b>.
                Předešlých 7 dnů bylo <b>".numberOfNamesFromPreviousLast7Days($conn)." názvů</b>.";?></p>
                <p class="text_paragraph"><?php echo onlineSentance($conn) ?></p>
                <p class="text_paragraph"><?php echo visitSentance($conn) ?></p>
                </div><div class="table_div">
               
<?php
 $day    = date('d',strtotime("-7 days"));
    $month  = date('m',strtotime("-7 days"));
    $year   = date('Y',strtotime("-7 days"));
$select_sql     = "SELECT username, count(vitoxwzcz6764.SewerCrewNames_OnlineDuringName.id_user) as numberOnlineUsers
FROM vitoxwzcz6764.SewerCrewNames 
right JOIN vitoxwzcz6764.SewerCrewNames_OnlineDuringName 
ON vitoxwzcz6764.SewerCrewNames.id=vitoxwzcz6764.SewerCrewNames_OnlineDuringName.id_servername 

right JOIN vitoxwzcz6764.SewerCrewNames_Usernames
ON vitoxwzcz6764.SewerCrewNames_Usernames.id_user=vitoxwzcz6764.SewerCrewNames_OnlineDuringName.id_user

WHERE vitoxwzcz6764.SewerCrewNames.date > '".$year."-".$month."-".$day." ".date('H:i:s')."' 
AND vitoxwzcz6764.SewerCrewNames_Usernames.username NOT LIKE 'Tomův Otrok'
AND vitoxwzcz6764.SewerCrewNames_Usernames.username NOT LIKE '%...%'

GROUP BY vitoxwzcz6764.SewerCrewNames_OnlineDuringName.id_user 

ORDER BY numberOnlineUsers DESC LIMIT 22;"; 

$select_result  = mysqli_query($conn, $select_sql);
$resultCheck    = mysqli_num_rows($select_result);

echo "<table><tr><th colspan='2'>Uživatelé, kteří byly on-line během<br> nejvíce názvů za posledních 7 dní</th></tr>";
while($row = mysqli_fetch_assoc($select_result)){
    echo "
                <tr><td><b>".$row['username']."</b></td><td>".$row['numberOnlineUsers']."</td></tr>";
}
echo "</table>";

?> </div> </div>      

                <p class="text_paragraph">Tento projekt není součástí projektu <i>Sewer Studiouz</i>. Díky za každou návštěvu.</p>
            </div>
            <a href="https://www.toplist.cz/stat/1836449/" id="toplistcz1836449" title="TOPlist"><noscript><img src="https://toplist.cz/dot.asp?id=1836449&njs=1" border="0"
alt="TOPlist" width="1" height="1"/></noscript><script language="JavaScript">
(function(d,e,s) {d.getElementById('toplistcz1836449').innerHTML='<img src="https://toplist.cz/dot.asp?id=1836449&http='+
e(d.referrer)+'&t='+e(d.title)+'&l='+e(d.URL)+'&wi='+e(s.width)+'&he='+e(s.height)+'&cd='+
e(s.colorDepth)+'" width="1" height="1" border="0" alt="TOPlist" />';
}(document,encodeURIComponent,window.screen))
</script></a>
        </article>
        <footer>
            <p>Vyrobil <a href="https://www.csfd.cz/uzivatel/565705-vitox/o-mne/">Vitox</a> v roce 2025</p>
        </footer>
    </body>
</html>
