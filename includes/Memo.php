<?php

namespace Datafather;

use mysqli;

class Memo {


    public static function insertMemo($formdata){


        $formdata= array(
            'promemoria' => $_POST['promemoria'],
            'priorità' => $_POST['priorità'],
            'completato'=> $_POST['completato']
        );

        

        $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "todolist");
        
        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }
        
        var_dump('Connessione stabilita');
        
        $memo = $formdata['promemoria'];
        $priority = $formdata['priorità'];
        $done= $formdata['completato'];

        var_dump($formdata);
        
        
        $query = $mysqli->prepare("INSERT INTO lista(promemoria,priorità,completato,creazione) VALUES (?,?,?, NOW())");
        
        $query->bind_param('ssi',$memo,$priority,$done);
        
        $query->execute();
        
        if ($query->affected_rows === 0) {
            error_log("Errore MySQL: " . $query->error_list[0]['error']);
            header('Location: http://localhost:8888/todolist/index.php?stato=ko');
            exit;
        }
        
        header('Location: http://localhost:8888/todolist/index.php?stato=ok');
        exit;
        
        $mysqli->close();

    }

    public static function selectMemo($args= null){

        $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "todolist");
        
        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }


        if(isset($args['id'])){
            $args['id'] = intval($args['id']);
            $query = $mysqli->query("SELECT * FROM lista WHERE id = " . $args['id']);
        }else{
            
            $query = $mysqli->query("SELECT * FROM lista");
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

            $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "todolist");
        
            if ($mysqli->connect_errno) {
                echo "Connessione al database fallita: " . $mysqli->connect_error;
                exit();
            }

            $id = intval($id);
            

            try {
                $query = $mysqli->prepare('UPDATE lista SET promemoria= ?, priorità = ?, completato = ?, creazione=Now() WHERE id = ?');
                if (is_bool($query)) {
                    throw new \Exception('Query non valida. $mysqli->prepare ha restituito false.');
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
            
            $mysqli->close();
        }

    }

    public static function deleteMemo($id = null){

        $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "todolist");
        
        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }

        if ( $id ) {

            $id = intval($id);
    
            $query = $mysqli->prepare('DELETE FROM lista WHERE id = ?');
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

            $query = $mysqli->query('DELETE FROM lista');
            
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

        $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "todolist");
        
        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }


        if($done){

            $query = $mysqli->query("SELECT * FROM lista WHERE completato = " . $done);
         }else{
            
            $query = $mysqli->query("SELECT * FROM lista");
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

        $mysqli = new mysqli("127.0.0.1", "root", "rootroot", "todolist");
        
        if ($mysqli->connect_errno) {
            echo "Connessione al database fallita: " . $mysqli->connect_error;
            exit();
        }


        if($imp){

            $query = $mysqli->query("SELECT * FROM lista WHERE priorità = '$imp' ");
         }else{
            
            $query = $mysqli->query("SELECT * FROM lista");
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
  