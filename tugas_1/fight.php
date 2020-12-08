<?php
Trait Fight{
    public $attackPower;
    public $deffencePower;

    public function serang($serang){

        echo "{$this->nama} sedang menyerang {$serang->nama} <br>";
       
        $serang->diserang($this);
    }
    public function diserang($penyerang){

        echo "{$this->nama} sedang diserang <br>";
        echo "-------------------<br>";
        $this->darah=$this->darah-($penyerang->attackPower/$this->deffencePower);
        
    }
    
}