<?php

class Proizvodac
{


    public static function getProizvodaci()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select * from proizvodac
        ");
        $izraz->execute();
        return $izraz->fetchAll();
    }

    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select * from proizvodac 
		where sifra=:proizvodac
        
        ");
        $izraz->execute(['proizvodac'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }


    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into proizvodac values
        (null,:naziv,:zemlja)
        
        ");
        $izraz->execute($_POST);
        return $veza->lastInsertId();

    }

    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update proizvodac
        set 
            naziv=:naziv,
            zemlja =:zemlja
            where sifra=:sifra
        
        ");
        $_POST['sifra']=$id;
        $izraz->execute($_POST);
    }




    public static function brisi($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        delete from proizvodac where sifra=:sifra

        
        ");
        $izraz->execute(['sifra'=>$id]);
    }



    

    
}