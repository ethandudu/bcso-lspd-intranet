<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

$reqcivil = $bdd -> prepare("SELECT * FROM civils_bcso WHERE ID = ?");
$reqcivil -> execute(array($_GET['id']));
$civil = $reqcivil -> fetch();

$name = $civil['name'];
$firstname = $civil['firstname'];

// Appel de la librairie FPDF


require('functions/pdf/fpdfe.php');



// On active la classe une fois pour toutes les pages suivantes
// Format portrait (>P) ou paysage (>L), en mm (ou en points > pts), A4 (ou A5, etc.)
$pdf = new PDF_MC_Table('P','mm','A4');

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
$datepublish = date("d/m/Y à H:i");
$officer = $_COOKIE['firstname']. " " .$_COOKIE['name'];
$pdf->Cell(75,6,utf8_decode("Edité le $datepublish"),0,1,'L',1);		
$pdf->Cell(75,6,"Par $officer",0,1,'L',1);				
$pdf->Ln(10); // saut de ligne 10mm	



// Fonction en-tête des tableaux en 3 colonnes de largeurs variables
function entete_table($position_entete) {
	global $pdf;
	$pdf->SetDrawColor(183); // Couleur du fond RVB
	$pdf->SetFillColor(221); // Couleur des filets RVB
	$pdf->SetTextColor(0); // Couleur du texte noir
	$pdf->SetY($position_entete);
	// position de colonne 1 (10mm à gauche)	
	$pdf->SetX(10);
	$pdf->Cell(80,8,'Infraction',1,0,'C',1);	// 60 >largeur colonne, 8 >hauteur colonne
	// position de la colonne 2 (70 = 10+60)
	$pdf->SetX(90); 
	$pdf->Cell(50,8,'Sanction',1,0,'C',1);
	// position de la colonne 3 (130 = 70+60)
	$pdf->SetX(140); 
	$pdf->Cell(20,8,'Officier',1,0,'C',1);
	// position de la colonne 4 (160 = 130+30)
	$pdf->SetX(160);
	$pdf->Cell(35,8,'Date',1,0,'C',1);

	$pdf->Ln(); // Retour à la ligne
}
// AFFICHAGE EN-TÊTE DU TABLEAU
// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (60 mm)
$position_entete = 70;
// police des caractères
$pdf->SetFont('Helvetica','',9);
$pdf->SetTextColor(0);
// on affiche les en-têtes du tableau
entete_table($position_entete);


$position_detail = 78; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (60+8)
$casiers = $bdd -> prepare("SELECT * FROM casiers_bcso WHERE civilid = ?");
$casiers -> execute(array($_GET['id']));
$casiers = $casiers -> fetchAll();
$pdf->SetWidths(array(80,50,20,35));

while ($casier = array_shift($casiers)) {
	$reqofficer = $bdd -> prepare("SELECT name, firstname FROM members_bcso WHERE ID = ?");
	$reqofficer -> execute(array($casier['officier']));
	$officer = $reqofficer -> fetch();
	$officer = $officer['name'];
	$datetimelocal = new DateTime($casier['datetime']);
	$casier['datetime'] = $datetimelocal -> format('d/m/Y à H:i');
	$pdf->Row(array(utf8_decode($casier['crime']),utf8_decode($casier['sanction']),utf8_decode($officer),utf8_decode($casier['datetime'])));
}

$pdf->Output('casier.pdf','I'); // affichage à l'écran
// Ou export sur le serveur
// $pdf->Output('F', '../test.pdf');
?>
