<?php

include __DIR__ .'/includes/Memo.php';


    $args = array(
        'id' => $_GET['id']
    );

    // var_dump($args);

    $promemoria= \Datafather\Memo::selectMemo($args);
    

    // var_dump($promemoria);  
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
                            <form action="./modifica-memo.php?id=<?php echo $promemoria[0]['id']; ?>" method="POST">
                                
                               <label class="form-label fw-bold my-2" for="promemoria">Modifica il tuo promemoria</label>
                                <input class="form-control" type="text" name="promemoria" id="promemoria" value="<?php echo $promemoria[0]['promemoria']; ?>">

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


</body>
</html>