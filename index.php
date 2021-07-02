<?php

include __DIR__ .'/includes/globals.php';



//Nella memo fai 2 funzioni che fanno query in base alla priorità o al fatto o no 
//nella index i bottoni viaggiano con la parola chiave che fa la stringa esatta di comparazione query

// NB quando filtri non accetta 0 quindi adesso 1= da fare e 2= fatto 
//  var_dump($_GET['done']);
 if(isset($_GET['done'])){
     $promemoria = \Datafather\Memo::showStatus($_GET['done']);
    }else if(isset($_GET['imp'])){
     $promemoria = \Datafather\Memo::showPriority($_GET['imp']);
    } else {
     $promemoria= \Datafather\Memo::selectMemo();
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
       <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-12 col-md-6 text-center card p-5 bg-warning">
                        <form action="insert.php" method="POST">
                            
                            <label class="form-label fw-bold my-2" for="promemoria">Scrivi il tuo promemoria</label>
                            <input class="form-control" type="text" name="promemoria" id="promemoria">

                            <label class="form-label fw-bold my-2">Seleziona priorità</label>
                            <select name="priorità" class="form-select">
                                <option value="Bassa">Bassa</option>
                                <option value="Media">Media</option>
                                <option value="Alta">Alta</option>
                            </select>

                            <label class="form-label fw-bold my-2">Fatto o da fare?</label>
                            <select name="completato" class="form-select">
                                <option value="1">Da Fare</option>
                                <option value="2">Fatto</option>
                            </select>         

                            <input class="btn btn-outline-dark my-3" type="submit" value="Invia">
                            
                        </form>
                    </div>
                </div>
            </div>
        </header>

    <?php include __DIR__ .'/includes/filterbar.php'; ?>



    <section class="container my-5">
        <div class="row">
       
     <?php foreach ($promemoria as $item): ?> 

            <div class="col-12 col-md-3 m-3 p-3 card-custom">

                <div class="text-end">
                    <a href="modifica.php?id=<?php echo $item['id'];?>" class="btn btn-outline-warning rounded-pill my-1">✏️</a> 
                    <a href="cancella-memo.php?id=<?php echo $item['id'];?>" class="btn btn-outline-danger rounded-pill my-1">❌</a>
                </div>
                <p># <?php echo $item['id']; ?></p>
                <h2><?php echo $item['promemoria']; ?></h2>
                <p>#Priorità : <?php echo $item['priorità']; ?></p>
                <p>#Status : <?php $item['completato'] == 1 ? printf("Da Fare")  : printf("Fatto")  ; ?></p>
                <p>Pubblicato il : <?php echo implode("-",array_reverse(explode("-",$item['creazione'])));?></p>
            
            </div>

     <?php endforeach; ?>

    
        
        </div>


    </section>
</body>
</html>