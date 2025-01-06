<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF de Stock</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }
        .header, .footer {
            width: 100%;
            position: fixed;
            left: 0;
            right: 0;
        }
        .header {
            top: 0;
            height: 100px;
            border-bottom: 2px solid #007BFF;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }
        .header img {
            max-height: 70px;
        }
        .header .title {
            font-size: 24px;
            color: #333;
            font-weight: 600;
            flex-grow: 1;
            text-align: left;
            padding-left: 10px;
        }
        .content {
            margin: 140px 30px 120px;
        }
        h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        p {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }
        .info-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .info-card h2 {
            font-size: 18px;
            color: #007BFF;
            margin-bottom: 15px;
        }
        .info-card p {
            font-size: 16px;
            color: #555;
        }
        .info-card p strong {
            color: #333;
        }
        .section-title {
            font-size: 18px;
            color: #007BFF;
            font-weight: 600;
            margin-top: 30px;
        }
        .footer {
            bottom: 0;
            height: 70px;
            border-top: 2px solid #007BFF;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 10px;
        }
        .footer p {
            margin: 0;
            padding: 0;
            font-size: 14px;
            color: #333;
        }
        .footer img {
            max-height: 50px;
            margin-top: 10px;
        }
        .contact-info {
            font-size: 14px;
            color: #666;
        }
        .contact-info a {
            color: #007BFF;
            text-decoration: none;
        }

        /* Ajout de la gestion des sauts de page */
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">
            <h2>Fiche Equipement</h2>
        </div>
    </div>

    <div class="content">
        <h1>Informations d'équipement</h1>

        <div class="info-card">
            <h2>Equipement</h2>
            <p><strong>Nom du Composant:</strong> {{ ucfirst($stock->name_composant) }}</p>
            <p><strong>Date Mise en Service:</strong> {{ ucfirst($stock->date_mise_en_service) }}</p>
        </div>

        <div class="info-card">
            <h2>Caractéristiques</h2>
            <p><strong>Caractère:</strong> {{ $stock->caractere }}</p>
            <p><strong>Marque:</strong> {{ $stock->marque }}</p>
            <p><strong>Modèle:</strong> {{ $stock->modele }}</p>
        </div>

        <div class="info-card">
            <h2>Référence & Série</h2>
            <p><strong>Référence Interne:</strong> {{ $stock->id_equipement }}</p>
            <p><strong>N° Série:</strong> {{ $stock->serial }}</p>
        </div>

        <!-- Saut de page avant d'afficher les informations complémentaires -->
        <div class="page-break"></div>

        <div class="info-card">
            <h2>Informations Complémentaires</h2>
            <p><strong>Société:</strong> {{ $stock->societe ? $stock->societe->name : 'Société non définie' }}</p>
            <p><strong>Département:</strong> {{ $stock->departement ? $stock->departement->nom_departement : 'Société non définie' }}</p>
            <p><strong>Utilisateur:</strong> {{ $stock->user ? $stock->user->name : 'Utilisateur non défini' }}</p>
        </div>
    </div>

    <div class="footer">
        <div class="contact-info">
            <p>
                SOFIMED Maroc 137, Bd Moulay Ismail Roches Noires Casablanca 20290 | 
                <a href="mailto:contact@sofimedmaroc.com">Contact@sofimedmaroc.com</a> |
                (+212) 05 22 24 01 01 | 
                <a href="https://www.Sofimedmaroc.com" target="_blank">Sofimedmaroc.com</a>
            </p>
        </div>
        <img src="{{ public_path('logo-sofimed.png') }}" alt="Sofimed Logo">
    </div>
</body>
</html>
