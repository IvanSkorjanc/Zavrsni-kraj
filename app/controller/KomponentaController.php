<?php

class KomponentaController extends UlogaOperater
{

    private $viewGreska="";
    private $id=0;


    public function index()
    {  

        $this->view->render("privatno/komponente/index",
            ["komponente"=>Komponenta::getKomponente()]);
    
    }


    public function pripremaNovi()
    {
    
        $this->view->render("privatno/komponente/novi",
    ["proizvodaci"=>Proizvodac::getProizvodaci()]);
    
    }


    public function novi()
    {  
       
        $this->viewGreska="privatno/komponente/novi";

      if(!$this->kontrole()){
          return;
      }

      $this->pripremaPromjeni(Komponenta::novi());

    }


    public function pripremaPromjeni($id)
    {

       
        App::setParams(Komponenta::read($id));
       $this->view->render("privatno/komponente/promjeni",
       ['id'=>$id,
       "proizvodaci"=>Proizvodac::getProizvodaci()]);

    }


    public function promjeni($id)
    {
        $this->viewGreska="privatno/komponente/promjeni";
        $this->id=$id;

        if(!$this->kontrole()){
            return;
        }
  
         Komponenta::promjeni($id);
         $this->index();
    }


    public function brisanje($id)
    {  


       Komponenta::brisi($id);
       $this->index();
    }


    private function kontrole()
    {
    return true;
    }


    private function greska($polje,$poruka)
    {
        $this->view->render($this->viewGreska,
            ['greska'=>
                ['polje'=>$polje,
                 'poruka'=>$poruka],
             'id'=>$this->id
            ]);
    }


}
