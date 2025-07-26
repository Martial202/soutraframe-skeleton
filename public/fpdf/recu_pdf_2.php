<?php
require 'vendor/autoload.php';

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
// var_dump($_SERVER['HTTP_HOST']);return;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);
    if ($status == 1) {

$commercial             = $agent["nom"];//$_POST['client']['nom'];
$nom                    = $artisant["nom"];//$_POST['client']['nom'];
$prenom                 = $artisant["prenom"];//$_POST['client']['nom'];
$code_rm_artisant       = $artisant["code_rm_artisant"];// $_POST['commercial']['nom'];
$telephone_artisant     = $artisant["telephone_artisant"];//$_POST['commercial']['telephone'];
$montantPayer           = $autreInfo["montant"];//$_POST['produit']['libelle'];
$metier                 = $autreInfo['metier'];
$chambre                = $autreInfo['chambre'];
$nb                = "Merci de bien conserver ce reçu jusqu’à la réception de votre carte.";
$footer1           = "Chambre Nationale de Métiers de Côte d'Ivoire!";
$footer2           = "07-02-02-78-78 / 01-01-62-62-88";
$titre = "MINISTÈRE DU COMMERCE, DE L’ARTISANAT ET DE LA  PROMOTION DES PME";
// var_dump($titre, $nom,$prenom, $code_rm_artisant, $telephone_artisant ,$metier,$chambre
//                           , $montantPayer, $date, $time, 
//                           $nb, $footer1, $footer2);return;
    }
}
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
function buildReceiptHTML($titre,$title, $nom,$prenom, $code_rm_artisant, $telephone_artisant ,$metier,$chambre
                          , $montantPayer, $date, $time, 
                          $nb, $footer1, $footer2) {
    return <<<HTML
<div style="margin-top:10px;">
    <table border="0" style="width:180%; vertical-align:middle;">
        <tr>
            <td style="width:100px; text-align:left;">
                <img src="logoc.jpeg" width="100" />
            </td>
            <td style="font-size:40pt; text-align:center; ">
                {$titre}
            </td>
        </tr>
    </table>

    <h2 style="text-align:center; font-size:35pt; margin-bottom:10px;margin-top=50px">{$title}</h2>
    <table cellpadding="2" cellspacing="0" border="0" style="font-size:40pt; width:100%;">
    
        <tr><td><strong>Nom :</strong></td><td>{$nom}</td></tr>
        <tr><td><strong>Prenoms :</strong></td><td>{$prenom}</td></tr>
        <tr><td><strong>Code RM :</strong></td><td>{$code_rm_artisant}</td></tr>
        <tr><td><strong>Téléphone :</strong></td><td>{$telephone_artisant}</td></tr>
        <tr><td><strong>Metier :</strong></td><td>{$metier}</td></tr>
        <tr><td><strong>Chambre :</strong></td><td>{$chambre}</td></tr>
    </table>
    <hr style="margin:10px 0;" />
    <p style="font-size:30pt;"><strong>Montant payé :</strong> <span style="color:red; font-size:60pt;">{$montantPayer} FCFA</span></p>
    
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
        $nom,$prenom, $code_rm_artisant, $telephone_artisant ,$metier,$chambre
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
echo json_encode([
    'lien'    => "https://{$_SERVER['HTTP_HOST']}/public/fpdf/{$pdfFilename}",
    'client'  => $nom,
    'montant' => $montantPayer,
    'Metier' => $metier
]);
