<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Sewer Crew Names</title>
        <link rel="stylesheet" href="styles.css">
        <meta name="keywords" content="Sewer Studiouz, Sewer Crew, Sever Crew statistiky, Statistiky, 
        Discord, Discord name server tracker">
        <meta name="autor" content="Vít Hrbáček">
    </head>
    <body>
        <ul class="lista">
            <li class="polozkaListy"><a href="https://sewers.webnode.cz/">Sewer Studiouz Web</a></li>
            <li class="polozkaListy"><a href="https://www.youtube.com/@SewerStudiouz/videos">Sewer Studiouz YouTube</a></li>
            <li class="polozkaListy"><a href="https://twitter.com/SewerStudiouz">Sewer Studiouz na Twitteru/X</a></li>
            <li class="polozkaListy"><a href="https://discord.com/">Discord</a></li>
            <li class="polozkaListy"><a href="https://socialblade.com/youtube/channel/UCiwqzkaQSkmRvakt6FJZikw">SocialBlade (Statistiky YouTube kanálu)</a></li>
            <li class="polozkaListy"><a href="http://kdybudebasta.wz.cz:8080/">Kdy bude Bašta?</a></li>
            <li class="polozkaListy"><a href="http://vitox.wz.cz:8080/NetflixDabing/index.php">Statistiky dabingů na Netflixu</a></li>
            <li class="polozkaListy"><a href="http://lladdakgallery.wz.cz:8080/disneyplus/">Přehled mapy stránek Disney+</a></li>
            <li class="polozkaListy"><a href="http://hledacobrazku.wz.cz:8080/">Hledač obrázků na eStránky</a></li>
        </ul>
        <header>
            <div class="menu">
                <a href="http://vitox.wz.cz/SewerCrewNames/index.php">
                    <img class="logo" src="logo.png">
                </a>
                <a class="button" href="https://discord.gg/mUeXgGu">Připojit se na server</a>
        </header>
        <article id="names">
            <table><?php
include_once 'dbh.inc.php';

$select_sql     = "SELECT Name, date, id, duration FROM vitoxwzcz6764.SewerCrewNames order by id desc"; 
           
$select_result  = mysqli_query($conn, $select_sql);
$resultCheck    = mysqli_num_rows($select_result);
 
while($row = mysqli_fetch_assoc($select_result)){
            echo "
                <tr><td><p style='color: white; text-align: left; font-size: 1.5rem'><b>".$row['Name']."<b></p> </td><td>".$row['date']. "</td><td style='text-align: right'><i>".floor($row['duration']/60)." minut</i></td></tr>";
}
?>
            </table>
        </article>
        <article id="oprojektu">
            <div>
                <p style="text-align: center; color: white; margin-top: 5px">Tento projekt není součástí projektu <i>Sewer Studiouz</i>.</p>
            </div>
        </article>
        <footer>
            <p>Vyrobil <a href="https://www.csfd.cz/uzivatel/565705-vitox/o-mne/">Vitox</a> v roce 2025</p>
        </footer>
    </body>
</html>