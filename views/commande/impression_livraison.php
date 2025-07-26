<?php
// require_once('../vendor/fpdf/fpdf.php'); // Adapte ce chemin à ton projet si besoin

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $logoPath = __DIR__ . '/logo.jpg'; // adapte si le fichier est ailleurs

        if (file_exists($logoPath)) {
            $this->Image($logoPath, 10, 5, 40,40);
        }

        // Déplacement à droite (position du curseur pour le texte)
        $this->SetXY(50, 12); // x = 50 pour laisser la place au logo, y = 12 pour bien aligner verticalement

        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, 'BON DE LIVRAISON', 0, 1, 'C');

        $this->SetX(50);
        $this->SetFont('Courier', '', 12);
        $this->Cell(0, 7, 'Tel: 07 77 51 57 89 / 05 95 90 26 51', 0, 1, 'C');

        $this->SetX(50);
        $this->Cell(0, 7, 'a.kouamemartial7@gmail.com', 0, 1, 'C');

        $this->Ln(20); // espace après le header
    }


    function InfoCommande($commande)
    {
        $this->SetFillColor(200, 200, 200);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(95, 10, strtoupper(' Info Commande'), 1, 0, 'C', true);
        $this->Cell(95, 10, strtoupper(' Info Client'), 1, 1, 'C', true);


        $this->SetFont('Courier', '', 11);

        // Bloc gauche (commande)
        $y = $this->GetY();
        $this->MultiCell(
            95,
            8,
            " Code Commande : {$commande['code_commande']}\n" .
                " Code Livraison : {$commande['code_livraison']}\n" .
                " Date Commande : {$commande['date_commande']}\n" .
                " Date Livraison : {$commande['date_livraison']}\n" .
                " Livreur : {$commande['livreur']}",
            1
        );

        // Bloc droit (client)
        $x = $this->GetX();
        $this->SetXY(105, $y); // position à droite
        $this->MultiCell(
            95,
            8,
            " Client : {$commande['client']}\n" .
                " Contact : {$commande['contact']}\n" .
                " Lieu Livraison : {$commande['lieu_livraison']}",
            1
        );

        $this->Ln(40);
    }

    function TableauProduits($produits)
    {
        $this->SetFillColor(200, 200, 200);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(60, 10, strtoupper(' Produit'), 'LTBR', 0, 'C', true);
        $this->Cell(40, 10, strtoupper(' Categorie'), 'LTBR', 0, 'C', true);
        $this->Cell(20, 10, strtoupper(' Qte'), 'LTBR', 0, 'C', true);
        $this->Cell(30, 10, strtoupper(' PU'), 'TBRL', 0, 'C', true);
        $this->Cell(40, 10, strtoupper(' Total'), 'TRBL', 1, 'C', true);
        // $this->Ln();

        $this->SetFont('Courier', '', 11);
        $total = 0;
        foreach ($produits as $prod) {
            $this->Cell(60, 10, ' ' . $prod['libelle_produit'], 'L', 0, 'C');
            $this->Cell(40, 10, ' ' . $prod['libelle_categorie'], 'L', 0, 'C');
            $this->Cell(20, 10, ' ' . $prod['qte_ligne'], 'L', 0, 'C');
            $this->Cell(30, 10, ' ' . number_format($prod['prix_produit'], 0, ',', ' ') . ' F', 'L', 0, 'C');
            $this->Cell(40, 10, ' ' . $prod['qte_ligne'] * $prod['prix_produit'], 'LR', 0, 'C');
            $this->Ln();
            $total += $prod['qte_ligne'] * $prod['prix_produit'];
        }
        $this->Cell(190, 0, '', 'B');
        $this->Ln(3);
        $this->SetX(90);
        $this->SetFont('Arial', 'B', 13);
        $this->SetFillColor(200, 200, 200);
        $this->Cell(70, 10, 'Total', 'LBT', 0, 'C', true);
        $this->Cell(40, 10, number_format($total, 0, ',', ' ') . ' F', 'RBT', 0, 'C', true);

        $this->Ln(15);
    }

    function Footer()
    {
        $this->SetY(-30);
        $this->SetFont('Courier', '', 11);
        $this->Cell(0, 10, 'Souche', 0, 0, 'L');
        $this->Cell(0, 10, 'Signature: ______________________', 0, 0, 'R');
    }

    // Ajoute une deuxième page avec la mention "SOUCHE"
    function addSoucheCopy($commande, $produits)
    {
        $this->AddPage();
        $this->SetFont('Courier', 'B', 16);
        // $this->Cell(0, 10, 'SOUCHE - COPIE INTERNE', 0, 1, 'C');
        $this->Ln(5);
        // $this->SetY(-30);
        // $this->Cell(0, 10, 'Souche', 0, 0, 'L');

        $this->InfoCommande($commande);
        $this->TableauProduits($produits);
    }
}
