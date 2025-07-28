<?php

require_once('fpdf/fpdf.php'); // adapte le chemin

class PDF extends FPDF
{
    public $commande;
    public $produits;

    function setData($commande, $produits)
    {
        $this->commande = $commande;
        $this->produits = $produits;
    }

    function Header()
    {
        // Logo
        $logoPath = __DIR__ . '/logo.jpg';
        if (file_exists($logoPath)) {
            $this->Image($logoPath, 10, 8, 30);
        }

        // Coordonnées BURO STORE
        $this->SetFont('Arial', 'B', 12);
        $this->SetXY(10, 35);
        $this->Cell(80, 6, 'BURO STORE', 0, 2);
        $this->SetFont('Arial', '', 10);
        $this->Cell(80, 5, utf8_decode('Yopougon, Cité verte'), 0, 2);
        $this->Cell(80, 5, 'Tel: 05 56 33 38 87 / 07 07 93 67 49', 0, 2);
        $this->Cell(80, 5, 'Email: buro-store@outlook.fr', 0, 2);

        // BON DE LIVRAISON encadré
        $this->SetXY(120, 10);
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(240, 240, 240);
        $this->Cell(70, 10, 'BON DE LIVRAISON N° ' . $this->commande['code_livraison'], 1, 2, 'C', true);

        $this->SetFont('Arial', '', 10);
        $clientBoxY = $this->GetY();
        $this->SetXY(120, $clientBoxY);
        $this->MultiCell(
            70,
            6,
            "Client : {$this->commande['client']}\n" .
            "Adresse : {$this->commande['adresse']}\n" .
            "Tél : {$this->commande['contact']}\n" .
            "Date : {$this->commande['date_livraison']}",

        );

        $this->Ln(10);
    }

    function TableauProduits()
    {
        $this->SetY(80);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(20, 10, 'REF', 1, 0, 'C');
        $this->Cell(120, 10, 'DESIGNATION', 1, 0, 'C');
        $this->Cell(50, 10, 'QUANTITE', 1, 1, 'C');

        $this->SetFont('Arial', '', 10);
        for ($i = 0; $i < 20; $i++) {
            $ref = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
            $designation = isset($this->produits[$i]) ? $this->produits[$i]['libelle_produit'] : '';
            $quantite = isset($this->produits[$i]) ? $this->produits[$i]['qte_ligne'] : '';

            $this->Cell(20, 8, $ref, 1, 0, 'C');
            $this->Cell(120, 8, utf8_decode($designation), 1, 0, 'L');
            $this->Cell(50, 8, $quantite, 1, 1, 'C');
        }

        // Signature
        $this->SetFont('Arial', '', 10);
        $this->SetY(-25);
        $this->Cell(0, 10, 'Date et signature', 0, 0, 'R');
    }

    function AddSouchePage()
    {
        $this->AddPage();
        $this->Header();
        $this->TableauProduits();

        // Mention SOUCHE
        $this->SetY(-25);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'SOUCHE', 0, 0, 'L');
    }
}
