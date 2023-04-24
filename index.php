<?php
    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],
    ];

    //con il doppio ?? è come se andassimo ad inserire tutto in un isset() per controllare se abbiamo effettivamente ricevuto il valore dal form
    // quindi se settato prendiamo il valore del form altrimenti gli diamo come valore 'off'
    // $isParkingRequired = $_GET['isParkingRequired'] ?? 'off';

    //invece di lavorare con valore di stringa 'on' e 'off' li cambiamo con i rispettivi booleani 

    $isParkingRequired = $_GET['isParkingRequired'] ?? false;
    if($isParkingRequired == "on") {
        $isParkingRequired = true;
    }

    //creo un altro array che corrisponderà solo agli hotel da visualizzare in base ai filtri
    $filteredHotels = $hotels;

    //filtriamo questi hotel in base alle ricerche dell'utente che leggiamo tramite i get
    //modifichaimo quindi gli elementi presenti in questo array 
    //in pagina poi visualizziamo solo gli elementi presenti in questo array

    //Filtro del parcheggio (disponibile o non disponibile)
    if($isParkingRequired) {
        //prima di tutto svuoto l'array altrimenti di default mi visualizza tutti gli hotel perchè alla riga 52 ho assegnato a $filteredHotels il contenuto di $hotels.
        $filteredHotels = [];

        //per ogni hotel dell'array iniziale controllo che abbia il parcheggio 
        //in quel caso lo inserisco nell'array degli hotel filtrati $filteredHotels

        foreach($hotels as $singleHotel) {
            if($singleHotel['parking'] == true) {
                //pusho questo hotel nell'array degli hotel filtrati $filteredHotels
                $filteredHotels[] = $singleHotel;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>
    <h1 class="text-center mb-5">PHP Hotel</h1>

    <form action="index.php" method="GET">
        <input name="isParkingRequired" type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
        <label class="btn btn-outline-primary mb-3" for="btn-check-outlined">Parcheggio</label><br>

        <button type="submit" class="btn btn-primary mb-4">Filtra</button>
    </form>

    <pre>
        Output del form:
    </pre>


    <table class="table">
        <thead>
            <tr>
            <?php 
            foreach($hotels[0] as $key => $value) {
            ?>

                <th scope="col"><?php echo $key ?></th>
                <?php 
            }
            ?>            
            </tr>
        </thead>
        <tbody>
        <?php 
        foreach($filteredHotels as $singleHotel) {
            
            echo "<tr>";

            foreach($singleHotel as $hotelPropertyKey => $hotelPropertyValue) {
                
                if($hotelPropertyKey == "parking") {
                    if($hotelPropertyValue == "true") {
                        echo "<td>Disponibile</td>";
                    }else {
                        echo "<td>Non Disponibile</td>";
                    }
                } else {
                    echo "<td>{$hotelPropertyValue}</td>";
                }  
            }
            
            echo "</tr>";
        ?>
        <?php 
        }
        ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>