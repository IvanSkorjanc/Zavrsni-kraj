<?php

class Konfiguracija
{


    public static function getKonfiguracije()
    {

        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select * from konfiguracija

        "
    
        );
        $izraz->execute();
        return $izraz->fetchAll();
    }


    public static function getKonfiguracijeNaKomponenti($komponenta)
    {
       
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select a.sifra, a.naziv, a.opis, a.cijena 
        from konfiguracija a inner join dio b on 
        a.sifra=b.komponenta where b.konfiguracija=:konfiguracija

        ");
        $izraz->execute(["komponenta"=>$komponenta]);
        return $izraz->fetchAll();
    }

    public static function read($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        select * from konfiguracija 
		where sifra=:konfiguracija
        
        ");
        $izraz->execute(['konfiguracija'=>$id]);
        return $izraz->fetch(PDO::FETCH_ASSOC);

    }


    public static function novi()
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        insert into konfiguracija values
        (null,:naziv,:opis,:cijena)
        
        ");
        $izraz->execute($_POST);
        return $veza->lastInsertId();
    }

    public static function promjeni($id)
    {   
        $veza = DB::getInstance();
        $izraz = $veza->prepare("
        
        update konfiguracija set 
            naziv=:naziv,
            opis =:opis,
            cijena=:cijena
            where sifra=:sifra
        
        ");
        $_POST['sifra']=$id;
        $izraz->execute($_POST);
    }


    public static function brisi($id)
    {
        $veza = DB::getInstance();
        $izraz = $veza->prepare("

        delete from konfiguracija where sifra=:sifra
       
        ");
        $izraz->execute(['sifra'=>$id]);
    }





}