<!DOCTYPE html>
<html>
  <body>
    <p>Blog post is gelukt!</p>
    <p>Klik op de link om terug te keren naar de <a href="index_form.html">beginpagina</a></p>
    <br><br>
  </body>
</html>

<?php
//fopen("Blogfileb/dinges.txt", "a");
//fclose("Blogfileb/dinges.txt");
//pak stringvariabelen uit html en zet deze in PHP stringvariabelen
  $naama=$_POST["naam"];
  $blogtitela=$_POST["blogtitel"];
  $blogteksta=$_POST["blogtekstinvoer"];

//maak een tijd-variabele met opmaak
  $tijda=time();
  $tijdb=(date("D-d-M-Y-H:i",$tijda));

  //Check if the file is well uploaded
	if($_FILES["file"]["error"] > 0) { echo "Fout tijdens uploaden, probeer opnieuw"; }
	//We won't use $_FILES['file']['type'] to check the file extension for security purpose
	//Set up valid image extensions
	$extsAllowed = array( "jpg", "jpeg", "png", "gif" );
	//Extract extention from uploaded file
		//substr return ".jpg"
		//Strrchr return "jpg"
	$extUpload = strtolower( substr( strrchr($_FILES["file"]["name"], ".") ,1) ) ;
	//Check if the uploaded file extension is allowed
	if (in_array($extUpload, $extsAllowed) ) {
	//Upload the file on the server
  $name = "uploads/{$_FILES["file"]["name"]}";
	$result = move_uploaded_file($_FILES["file"]["tmp_name"], $name);
	if($result){echo "";}  //<img src='$name'/>
} else { echo "Bestand is ongeldig. Probeer opnieuw"; }
//$block geeft aan of kommentaren wel- of niet mogen.
  $block = "J";

//Maak telbestand aan als deze nog niet bestaat
//zet de telwaarde in het telbestand -hiermee kan ik elke keer een genummerd kommentaarbestand koppelen aan het blognummer
fopen("Blogfileb/telbestand.txt", "a");
fclose("Blogfileb/telbestand.txt");
$tela = (file_get_contents("Blogfileb/telbestand.txt"));
fopen("Blogfileb/telbestand.txt","w");
fclose("Blogfileb/telbestand.txt");
$tela = $tela + "1" ;
echo $tela ;
$teller = fopen("Blogfileb/telbestand.txt","w");
fwrite($teller, $tela);
fclose("Blogfileb/telbestand.txt");
//Maak nieuw kommentaarbestand met gebruik van nummer in TELbestand
$kommentaarnr = ("Blogfileb/komment" . $tela . ".txt");
echo $kommentaarnr;
fopen("$kommentaarnr","a");
fclose("$kommentaarnr");

//bufferbestand om mee te schuiven aanmaken -om laatste post bovenaan te krijgen-
//echo $_POST["blogtekstinvoer"];
//maak en/of open en sluit het blogteksbestand op schijf VOOR DE 1E KEER
    //-------------$schrijfweg = fopen("Blogfileb/Blogfileb.txt", "a") or die("Kan bestand niet openen!");
    //-----------fclose($schrijfweg);
//maak een textbuffer gelijk aan de inhoud van logtekst Blogfileb op schijf
    //-------------$textbuffera = (file_get_contents("Blogfileb/Blogfileb.txt"));
//wis de inhoud van logtekst Blogfileb op schijf
    //-----------fopen("Blogfileb/Blogfileb.txt", w );
    //-------------fclose("Blogfileb/Blogfileb.txt");

    //maak een reageertag met uniek nummer ($stela) die in elke blogtekst moet komen
    $rbutton = "<h5 id=\"$tela\">Reageer op de tekst</h5> <input type = \"button\" value = \"Reageer\" onclick = \"reageerform.php\">";
    //schrijffunctie met opmaak en gegenereerde tijd
    $schrijfweg = fopen("Blogfileb/" . $tela . ".txt", "a") or die("Kan bestand niet openen!");
    fwrite($schrijfweg,     $tela . $block . "\n" . "<br>" .
                            "Datum:" . " " . $tijdb . "\n" . "<br>"
                          . "Auteur:" . " " . $naama . "\n" . "<br>"
                          . "Onderwerp:" . " " . $blogtitela . "\n". "<br>"
                          . "<img src='$name'/>" . " " . "\n" . " <br>"
                          . $blogteksta . "\n" . "<br>" . "<br>" . $rbutton . "\n" . "<br>" . "<br>" . $textbuffera . "<br>");
    fclose($schrijfweg);
//zet de inhoud van het laatste blogfile op scherm
$naarhtmla=(file_get_contents("Blogfileb/" . $tela . ".txt"));
echo $naarhtmla;

?>

<!DOCTYPE html>
<html>
  <body>
    <p>Blog post is gelukt!</p>
    <p>Klik op de link om terug te keren naar de <a href="index_form.html">beginpagina</a></p>
  </body>
</html>
