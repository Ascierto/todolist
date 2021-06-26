<?php

include __DIR__ .'/includes/Memo.php';



//Nella memo fai 2 funzioni che fanno query in base alla priorità o al fatto o no 
//nella index i bottoni viaggiano con la parola chiave che fa la stringa esatta di comparazione query

// if(isset($_GET['option'])){
//     $promemoria = funzione show Priority;
// }else if(isset($_GET['done'])){
//     $promemoria = funzione showDone;
// } else {
//     $promemoria= \Datafather\Memo::selectMemo();
// }

$promemoria= \Datafather\Memo::selectMemo();



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
                    <div class="col-12 col-md-6 text-center card p-5">
                        <form action="insert.php" method="POST">
                            
                            <label class="form-label" for="promemoria">Scrivi il tuo promemoria</label>
                            <input class="form-control" type="text" name="promemoria" id="promemoria">

                            <label class="form-label">Seleziona priorità</label>
                            <select name="priorità" class="form-select">
                                <option value="Bassa">Bassa</option>
                                <option value="Media">Media</option>
                                <option value="Alta">Alta</option>
                            </select>

                            <label class="form-label">Fatto o da fare?</label>
                            <select name="completato" class="form-select">
                                <option value="0">Da Fare</option>
                                <option value="1">Fatto</option>
                            </select>         

                            <input class="btn btn-outline-dark my-3" type="submit" value="Invia">
                            
                        </form>
                    </div>
                </div>
            </div>
        </header>


    <section class="container">
        <div class="row">
<!-- 
            <div class="col-12 my-5">
                <a href="" class="btn btn-danger">fatti</a>
                <a href="" class="btn btn-danger">Da fare</a>
                <a href="" class="btn btn-danger">Priorità alta</a>
                <a href="" class="btn btn-danger">Priorità media</a>
                <a href="" class="btn btn-danger">Priorità bassa</a>
            </div> -->
            <div class="col-12 text-end my-5">
                <a href="cancella-memo.php" class="btn btn-danger">Elimina tutto</a>
            </div>
       
     <?php foreach ($promemoria as $item): ?> 

            <div class="col-12 col-md-3 card p-3 m-3">

                <p># <?php echo $item['id']; ?></p>
                <h2><?php echo $item['promemoria']; ?></h2>
                <p><?php echo $item['priorità']; ?></p>
                <p><?php $item['completato'] == 0 ? printf("Da Fare")  : printf("Fatto")  ; ?></p>
                <p><?php echo $item['creazione'];?></p>
                <a href="modifica.php?id=<?php echo $item['id'];?>" class="btn btn-outline-warning rounded-pill my-1">✏️</a> 
                <a href="cancella-memo.php?id=<?php echo $item['id'];?>" class="btn btn-outline-danger rounded-pill my-1">❌</a>
            
            </div>

     <?php endforeach; ?>

    
        
        </div>


    </section>
</body>
</html>