<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Sewer Crew Names</title>
        <link rel="stylesheet" href="style.css">
        <meta name="keywords" content="Sewer Studiouz, Sewer Crew, Mipe, Změnili 
        název serveru, Sewer Crew názvy, Sewer Crew jména, Discord, Discord name 
        server tracker">
        <meta name="autor" content="Vít Hrbáček">
        <link data-rh="true" rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
        <meta property="og:image"  content="http://vitox.wz.cz/SewerCrewNames/img/sewer_crew_names_icon_shared.png"/>
        <meta name="twitter:image" content="http://vitox.wz.cz/SewerCrewNames/img/sewer_crew_names_icon_shared.png"/>
        <meta itemprop="name"      content="Sewer Crew Names"/>
        <meta property="og:title"  content="Sewer Crew Names"/>
        <meta name="twitter:title" content="Sewer Crew Names"/>
        <meta name="description" property="description" content="Archiv alternativních názvů Discord serveru Sewer Studiouz"/>
        <meta property="og:description"                 content="Archiv alternativních názvů Discord serveru Sewer Studiouz"/>
        <meta name="google-site-verification" content="i3btf9y-nk6AXa2-XCGeq2gciqpS_87Lj-_YTkEsUss" />
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
            <table><?php
// This inserts secret code with password, etc., for database connection. 
include_once 'dbh.inc.php';

function numberOnlineText($number){
    if($number > 0){
        return $number." online";
    }
    return "";
}

$select_sql     = "SELECT id, Name, date, duration, visit, extra, count(id_user) as online FROM vitoxwzcz6764.SewerCrewNames 
left JOIN vitoxwzcz6764.SewerCrewNames_OnlineDuringName ON SewerCrewNames_OnlineDuringName.id_servername=SewerCrewNames.id GROUP by id order by id desc;";
           
$select_result  = mysqli_query($conn, $select_sql);
$resultCheck    = mysqli_num_rows($select_result);
 
while($row = mysqli_fetch_assoc($select_result)){
            echo "
                <tr><td><p class='serverNameTitle'><a href='http://vitox.wz.cz/SewerCrewNames/name.php?id=".$row['id']."'><b>".$row['Name']."<b></a></p> </td><td style='text-align: right; white-space: nowrap'> ".numberOnlineText($row['online'])."</td><td>".date_format(date_create($row['date']),"d. m. Y H:i"). "</td><td style='text-align: right; white-space: nowrap'><i>".floor($row['duration']/60)." minut</i></td></tr>";
}
?>
            </table>
        </article>
        <article id="oprojektu">
            <div>
                <p style="text-align: center; color: white; margin-top: 5px">Tento projekt není součástí projektu <i>Sewer Studiouz</i>.</p>
                <a href="https://www.toplist.cz/stat/1836449/" id="toplistcz1836449" title="TOPlist"><noscript><img src="https://toplist.cz/dot.asp?id=1836449&njs=1" border="0"
alt="TOPlist" width="1" height="1"/></noscript><script language="JavaScript">
(function(d,e,s) {d.getElementById('toplistcz1836449').innerHTML='<img src="https://toplist.cz/dot.asp?id=1836449&http='+
e(d.referrer)+'&t='+e(d.title)+'&l='+e(d.URL)+'&wi='+e(s.width)+'&he='+e(s.height)+'&cd='+
e(s.colorDepth)+'" width="1" height="1" border="0" alt="TOPlist" />';
}(document,encodeURIComponent,window.screen))
</script></a>
            </div>
        </article>
        <footer>
            <p>Vyrobil <a href="https://www.csfd.cz/uzivatel/565705-vitox/o-mne/">Vitox</a> v roce 2025</p>
        </footer>
    </body>
</html>
