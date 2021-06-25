<?php

include __DIR__ .'/includes/Memo.php';
$promemoria= \Datafather\Memo::selectMemo();

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
                <form action="insert.php" method="POST">
                
                <label class="form-label" for="promemoria">Memo</label>
                <input class="form-control" type="text" name="promemoria" id="promemoria">

                <label class="form-label" for="priorità">Priorità</label>
                <input class="form-control" type="number" name="priorità" id="priorità">

                <label class="form-label" for="completato">Done</label>
                <input class="form-control" type="number" name="completato" id="completato">            

                <input class="btn btn-outline-info my-3" type="submit" value="Invia">
                
                </form>              
            </div>
        </div>
    </main>

    <section class="container">
        <div class="row">

       
        
     <?php foreach ($promemoria as $item): ?> 

        <div class="col-12 col-md-3 card p-3 m-3">

            <p># <?php echo $item['id']; ?></p>
            <h2><?php echo $item['promemoria']; ?></h2>
            <p><?php echo $item['priorità']; ?></p>
            <p><?php echo $item['completato']; ?></p>
            <p><?php echo $item['creazione'];?></p>
            <a href="modifica.php?id=<?php echo $item['id'];?>" class="btn btn-outline-warning rounded-pill">✏️</a> 
        
        </div>

     <?php endforeach; ?>

    
        
        </div>


    </section>
</body>
</html>