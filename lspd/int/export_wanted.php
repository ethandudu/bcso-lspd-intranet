<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

$req = $bdd -> prepare("SELECT * FROM wanted_lspd WHERE ID = ?");
$req -> execute(array($_GET['id']));
$wanted = $req -> fetch();

$reqcivil = $bdd -> prepare("SELECT * FROM civils_lspd WHERE ID = ?");
$reqcivil -> execute(array($wanted['civilid']));
$civil = $reqcivil -> fetch();

$name = $civil['name'];
$firstname = $civil['firstname'];

// Appel de la librairie FPDF


require('functions/pdf/fpdf.php');

class PDF extends FPDF
{
	// Header
	function Header() {
		//import value from name and firstname
		$name = $GLOBALS['name'];
		$firstname = $GLOBALS['firstname'];
		// Logo : 8 >position à gauche du document (en mm), 2 >position en haut du document, 80 >largeur de l'image en mm). La hauteur est calculée automatiquement.
		$this->Image('assets/logo_lspd2.png',8,2);
		// Saut de ligne 20 mm
		$this->Ln(20);

		// Titre gras (B) police Helbetica de 11
		$this->SetFont('Helvetica','B',11);
		// fond de couleur gris (valeurs en RGB)
		$this->setFillColor(230,230,230);
 		// position du coin supérieur gauche par rapport à la marge gauche (mm)
		$this->SetX(60);
		// Texte : 60 >largeur ligne, 8 >hauteur ligne. Premier 0 >pas de bordure, 1 >retour à la ligneensuite, C >centrer texte, 1> couleur de fond ok	
		$this->Cell(80,8,"Wanted $firstname $name ",0,1,'C',1);
		// Saut de ligne 10 mm
		$this->Ln(10);		
	}
	// Footer
	function Footer() {
		// Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		// Police Arial italique 8
		$this->SetFont('Helvetica','I',9);
        //footer
        $this->Cell(0,10,'Wanted '.$GLOBALS['firstname'].' '.$GLOBALS['name'].' - '.date('d/m/Y'),0,0,'L');
		// Numéro de page, centré (C)
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}


// On active la classe une fois pour toutes les pages suivantes
// Format portrait (>P) ou paysage (>L), en mm (ou en points > pts), A4 (ou A5, etc.)
$pdf = new PDF('P','mm','A4');

// Nouvelle page A4 (incluant ici logo, titre et pied de page)
$pdf->AddPage();
// set font to arial, regular, 12pt
$pdf->SetFont('Helvetica','',12);
// Couleur par défaut : noir
$pdf->SetTextColor(0);
// Compteur de pages {nb}
$pdf->AliasNbPages();


// Sous-titre calées à gauche, texte gras (Bold), police de caractère 11
$pdf->SetFont('Helvetica','B',11);
// couleur de fond de la cellule : gris clair
$pdf->setFillColor(230,230,230);
// Cellule avec les données du sous-titre sur 2 lignes, pas de bordure mais couleur de fond grise
$datepublish = $wanted['datetime'];
$datepublish = date('d/m/Y H:i', strtotime($datepublish));
$officer = $_COOKIE['firstname']. " " .$_COOKIE['name'];
$pdf->Cell(75,6,utf8_decode("Publié le $datepublish"),0,1,'L',1);			
$pdf->Ln(10); // saut de ligne 10mm	


// show informations in lines of the civil
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(43,6,utf8_decode("Nom :"),0,0,'L',0);
$pdf->Cell(40,6,utf8_decode($civil['name']),0,1,'L',0);
$pdf->Cell(43,6,utf8_decode("Prénom :"),0,0,'L',0);
$pdf->Cell(40,6,utf8_decode($civil['firstname']),0,1,'L',0);
$pdf->Cell(43,6,utf8_decode("Date de naissance :"),0,0,'L',0);
$datetimelocal = new DateTime($civil['birthdate']);
$birthdate = $datetimelocal->format('d/m/Y');
$pdf->Cell(40,6,utf8_decode($birthdate),0,1,'L',0);
$pdf->Cell(43,6,utf8_decode("Note :"),0,0,'L',0);
if ($civil['note'] == "") {
	$civil['note'] = "Aucune note";
}
$pdf->Cell(40,6,utf8_decode($civil['note']),0,1,'L',0);
$pdf->Cell(43,6,utf8_decode("Motif :"),0,0,'L',0);
$pdf->Cell(40,6,utf8_decode($wanted['reason']),0,1,'L',0);

$pdf->Ln(10); // saut de ligne 10mm
$pdf->SetFont('Helvetica','B',11);
$pdf->Cell(43,6,utf8_decode("Photo :"),0,1,'L',0);
//show 3 pictures sides by sides
$pdf->SetFont('Helvetica','',12);
$pdf->Cell(43,6,utf8_decode("Face :"),0,0,'L',0);
$pdf->Cell(43,6,utf8_decode("Profil :"),0,0,'L',0);
$pdf->Cell(43,6,utf8_decode("Dos :"),0,1,'L',0);
$pic1 = $civil['picface'];
$pic2 = $civil['picback'];
$pic3 = $civil['picright'];
//show 3 pictures sides by sides
try {
	$pdf->Cell(43,6,$pdf->Image($pic1, $pdf->GetX(), $pdf->GetY(), 40, 0, 'png'),0,0,'L',0);
} catch (Exception $e) {
	$pdf->Cell(43,6,utf8_decode("Aucune photo"),0,0,'L',0);
}

try {
	$pdf->Cell(43,6,$pdf->Image($pic2, $pdf->GetX(), $pdf->GetY(), 40, 0, 'png'),0,0,'L',0);
} catch (Exception $e) {
	$pdf->Cell(43,6,utf8_decode("Aucune photo"),0,0,'L',0);
}

try {
	$pdf->Cell(43,6,$pdf->Image($pic3, $pdf->GetX(), $pdf->GetY(), 40, 0, 'png'),0,1,'L',0);
} catch (Exception $e) {
	$pdf->Cell(43,6,utf8_decode("Aucune photo"),0,1,'L',0);
}





$pdf->Output('wanted.pdf','I'); // affichage à l'écran
// Ou export sur le serveur

if ($_GET['action']=="webhook"){
	$pdf->Output('F', 'wanted.pdf'); // export sur le serveur
}else{
	$pdf->Output('wanted.pdf','I'); // affichage à l'écran
}
?>
