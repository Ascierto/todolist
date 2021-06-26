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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
    <main class="container my-5">
        <div class="row">
            <div class="col-6 card">
                <form action="./modifica-memo.php?id=<?php echo $promemoria[0]['id']; ?>" method="POST">
                
                <label class="form-label" for="promemoria">Memo</label>
                <input class="form-control" type="text" name="promemoria" id="promemoria" value="<?php echo $promemoria[0]['promemoria']; ?>">

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
         
                <input class="btn btn-outline-info my-3" type="submit" value="Invia">
                
                </form>              
            </div>
        </div>
    </main>

</body>
</html>