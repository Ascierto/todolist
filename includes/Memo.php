<?php

namespace Datafather;

include __DIR__ . '/db.php';

use mysqli;

class Memo {


    public static function insertMemo($formdata){


        $formdata= array(
            'promemoria' => $_POST['promemoria'],
            'priorità' => $_POST['priorità'],
            'completato'=> $_POST['completato']
        );

        
        $db = connect();
        var_dump('Connessione stabilita');
        
        $memo = $formdata['promemoria'];
        $priority = $formdata['priorità'];
        $done= $formdata['completato'];

        var_dump($formdata);
        
        
        $query = $db->prepare("INSERT INTO lista(promemoria,priorità,completato,creazione) VALUES (?,?,?, NOW())");
        
        $query->bind_param('ssi',$memo,$priority,$done);
        
        $query->execute();
        
        if ($query->affected_rows === 0) {
            error_log("Errore MySQL: " . $query->error_list[0]['error']);
            header('Location: http://localhost:8888/todolist/index.php?stato=ko');
            exit;
        }
        
        header('Location: http://localhost:8888/todolist/index.php?stato=ok');
        exit;
        
        $db->close();

    }

    public static function selectMemo($args= null){

        $db = connect();

        if(isset($args['id'])){
            $args['id'] = intval($args['id']);
            $query = $db->query("SELECT * FROM lista WHERE id = " . $args['id']);
        }else{
            
            $query = $db->query("SELECT * FROM lista");
        }
        


        $results=[];

        if($query->num_rows > 0){
            
            while ($row = $query->fetch_assoc()) {
                $results[] = $row;
            }      
        }

        return $results;
    }

    public static function updateMemo($formdata,$id){

        $formdata= array(
            'promemoria' => $_POST['promemoria'],
            'priorità' => $_POST['priorità'],
            'completato'=> $_POST['completato']
        );

        if($formdata){

            $db = connect();

            $id = intval($id);
            

            try {
                $query = $db->prepare('UPDATE lista SET promemoria= ?, priorità = ?, completato = ?, creazione=Now() WHERE id = ?');
                if (is_bool($query)) {
                    throw new \Exception('Query non valida. $db->prepare ha restituito false.');
                }
                $query->bind_param('ssii', $formdata['promemoria'], $formdata['priorità'],$formdata['completato'], $id);
                $query->execute();
            } catch (\Exception $e) {
                error_log("Errore PHP in linea {$e->getLine()}: " . $e->getMessage() . "\n", 3, 'my-errors.log');
            }

            if ($query->affected_rows === 0) {
                error_log("Errore MySQL: " . $query->error_list[0]['error']);
                header('Location: http://localhost:8888/todolist/modifica-contatto.php?stato=ko&id='. $id);
                exit;
            }
            
            header('Location: http://localhost:8888/todolist/index.php?stato=ok');
            exit;
            
            $db->close();
        }

    }

    public static function deleteMemo($id = null){

        $db = connect();

        if ( $id ) {

            $id = intval($id);
    
            $query = $db->prepare('DELETE FROM lista WHERE id = ?');
            $query->bind_param('i', $id);
            $query->execute();
    
            if ($query->affected_rows > 0) {
                header('Location: http://localhost:8888/todolist/?statocanc=ok');
                exit;
            } else {
                header('Location: http://localhost:8888/todolist/?statocanc=ko');
                exit;
            }

        }else{

            $query = $db->query('DELETE FROM lista');
            
            if ($query->affected_rows > 0) {
                header('Location: http://localhost:8888/todolist/?statocanc=ok');
                exit;
            } else {
                header('Location: http://localhost:8888/todolist/?statocanc=ko');
                exit;
            }
        }
    }

    public static function showStatus($done){

        $db = connect();


        if($done){

            $query = $db->query("SELECT * FROM lista WHERE completato = " . $done);
         }else{
            
            $query = $db->query("SELECT * FROM lista");
        }
        


        $results=[];

        if($query->num_rows > 0){
            
            while ($row = $query->fetch_assoc()) {
                $results[] = $row;
            }      
        }

        return $results;

    }

    public static function showPriority($imp){

        $db = connect();

        if($imp){

            $query = $db->query("SELECT * FROM lista WHERE priorità = '$imp' ");
         }else{
            
            $query = $db->query("SELECT * FROM lista");
        }
        


        $results=[];

        if($query->num_rows > 0){
            
            while ($row = $query->fetch_assoc()) {
                $results[] = $row;
            }      
        }

        return $results;

    }

}
  