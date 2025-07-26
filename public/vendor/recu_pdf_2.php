<?php
require '../vendor/autoload.php';

date_default_timezone_set('Africa/Abidjan');

// Extend the TCPDF class if you need to add custom methods (currently none are added)
class MonRecu extends TCPDF {
    //echo "here";
    // You can add custom header/footer methods here if needed in the future.
    // public function Header() {
    //     // Désactive le header automatique si jamais activé
    //     $this->setPrintHeader(false);
    //     $logooutputDir   = __DIR__;
    //     $logoname ="logoc.jpg" ;
    //     // Enregistre les paramètres courants
    //     $this->SetAlpha(0.1); // Opacité du watermark
    //     $this->Image(
    //         "{$logooutputDir}/{$logoname}", // Chemin du logo
    //         30, 40,            // Position X, Y
    //         100,               // Largeur (ajuste selon ton besoin)
    //         0, '', '', '', false, 300
    //     );
    //     // $w = 150; // largeur du logo
    //     // $x = ($this->getPageWidth() - $w) / 2;
    //     // $this->Image("$logooutputDir/logo.png", $x, 100, $w);

    //     $this->SetAlpha(1); // Rétablit l'opacité normale
    // }
}

// Collect POST data
$dateTime = new DateTime();
$formatter = new IntlDateFormatter(
    'fr_FR',
    IntlDateFormatter::FULL,
    IntlDateFormatter::NONE,
    'Africa/Abidjan',
    IntlDateFormatter::GREGORIAN,
    'EEEE d MMMM yyyy'
);
$date = $formatter->format($dateTime);
$time = $dateTime->format('H:i:s');

$commercial        = $_POST['commercial']['nom'];
// $code              = $_POST['inscription']['code_inscription'];
$nom            = "Kassi";//$_POST['client']['nom'];
$prenom     = "Antoine";//$_POST['client']['telephone'];
$datedeNaissance        = "01/01/2025";// $_POST['commercial']['nom'];
$lieudeNaissance = "Abidjan";//$_POST['commercial']['telephone'];
$montantPayer           = "15000";//$_POST['produit']['libelle'];
$nbJour = 2;
$nb                = "Merci de bien conserver ce reçu jusqu’à la réception de votre carte.";
$footer1           = "Chambre Nationale de Métiers de Côte d'Ivoire!";
$footer2           = "07-02-02-78-78 / 01-01-62-62-88";
$titre = "MINISTÈRE DU COMMERCE, DE L’ARTISANAT ET DE LA  PROMOTION DES PME";

// --- PDF Setup ---
// In your example you use a custom page size of [300,450] (width x height in mm) for A4, update if needed.
$pdf = new MonRecu('P', 'mm', [300,450], true, 'UTF-8', false);

// Set viewer preferences and display mode so the PDF fills the page in the viewer
$pdf->setViewerPreferences(['PrintScaling' => 'None']);
$pdf->SetDisplayMode('fullwidth', 'Single');
$pdf->setPrintHeader(false);

// Document information
$pdf->setCreator('DienDi');
$pdf->setAuthor('DienDi');
$pdf->setTitle('Reçu A4');

// Set margins and auto page break (here we remove all margins)
$pdf->SetMargins(0, 0, 0);
$pdf->SetAutoPageBreak(true, 0);

// Set base font size for the document
$pdf->SetFont('helvetica', '', 20);

/**
 * Build the HTML content for the receipt.
 *
 * @param string $title       Receipt title.
 * @param string $code        Receipt code.
 * @param string $client      Client name.
 * @param string $clientContact Client contact.
 * @param string $commercial  Commercial name.
 * @param string $commercialContact Commercial contact.
 * @param string $produit     Product name.
 * @param string $choix       Choice.
 * @param string $cotisation  Daily rate.
 * @param int    $montantPayer Total amount paid.
 * @param int    $nbJour      Number of days.
 * @param string $date        Date string.
 * @param string $time        Time string.
 * @param string $nb          NB text.
 * @param string $footer1     First footer line.
 * @param string $footer2     Second footer line.
 * @return string             The HTML content.
 */
function buildReceiptHTML($titre,$title, $nom, $prenom, $datedeNaissance, $lieudeNaissance 
                          , $montantPayer, $date, $time, 
                          $nb, $footer1, $footer2) {
    return <<<HTML
<div style="margin-top:10px;">
    <table border="0" style="width:180%; vertical-align:middle;">
        <tr>
            <td style="width:100px; text-align:left;">
                <img src="logoc.jpg" width="100" />
            </td>
            <td style="font-size:40pt; text-align:center; ">
                {$titre}
            </td>
        </tr>
    </table>

    <h2 style="text-align:center; font-size:42pt; margin-bottom:10px;margin-top=50px">{$title}</h2>
    <table cellpadding="6" cellspacing="0" border="0" style="font-size:40pt; width:150%;">
    
        <tr><td><strong>Nom :</strong></td><td>{$nom}</td></tr>
        <tr><td><strong>Prenom :</strong></td><td>{$prenom}</td></tr>
        <tr><td><strong>Date de Naissance :</strong></td><td>{$datedeNaissance}</td></tr>
        <tr><td><strong>Lieu de Naissance :</strong></td><td>{$lieudeNaissance}</td></tr>
    </table>
    <hr style="margin:10px 0;" />
    <p style="font-size:45pt;"><strong>Montant payé :</strong> <span style="color:red; font-size:75pt;">{$montantPayer} FCFA</span></p>
    
    <p style="font-size:38pt;"><strong>Date :</strong> {$date} à {$time}</p>
    <hr style="margin:10px 0;" />
    <p style="font-size:40pt;"><strong>NB :</strong> {$nb}</p>
    <p style="font-size:35pt; text-align:center;"><strong>{$footer1}<br>{$footer2}</strong></p>
</div>
HTML;
}

// Page 1: "Reçu du Client"
$pdf->AddPage();
// $logooutputDir   = __DIR__;
// $logoname ="logoc.jpg" ;

// $pdf->SetAlpha(0.7); // Opacité 10%
// $pdf->Image(
//             "{$logooutputDir}/{$logoname}", // Chemin du logo
//             50, 10,            // Position X, Y
//             200,               // Largeur (ajuste selon ton besoin)
//             0, '', '', '', false, 300
//         );
// $pdf->SetAlpha(1); // Remet l'opacité à 100% pour le reste du contenu
$pdf->writeHTML(
    buildReceiptHTML(
        $titre,'Reçu',
        $nom, $prenom, $datedeNaissance, $lieudeNaissance 
        , $montantPayer, $date, $time, 
        $nb, $footer1, $footer2
    ),
    true, false, true, false, ''
);

$cleanCommercial = preg_replace('/[^A-Za-z0-9_\-]/', '', str_replace(' ', '_', $commercial));

// Save PDF to server
$outputDir   = __DIR__;
$pdfFilename = "receipts/receipt_{$cleanCommercial}.pdf";
$pdfFilepath = "{$outputDir}/{$pdfFilename}";
$pdf->Output($pdfFilepath, 'F');

// JSON response
// echo json_encode([
//     'lien'    => "http://{$_SERVER['HTTP_HOST']}/fpdf/{$pdfFilename}",
//     'client'  => $nom,
//     'montant' => $montantPayer,
//     'nbrJour' => $nbJour
// ]);
