<?php
Trait Hewan{
    public $nama;
    public $darah=50;
    public $jumlahKaki;
    public $keahlian;

    public function atraksi(){
        echo "{$this->nama} sedang {$this->keahlian}<br>";
        echo "-------------------<br>";
   
    }
}