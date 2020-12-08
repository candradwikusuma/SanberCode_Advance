<?php
class Elang{
    use Hewan, Fight;
 
    public function __construct($nama)
        {
            $this->nama = $nama ;
            $this->jumlahKaki = 2;
            $this->keahlian = "terbang tinggi";
            $this->attackPower = 10 ;
            $this->deffencePower = 5 ; 
            
        }

    public function getInfoHewan(){
        //menampilkan semua properti di kelas Hewan dan Fight ditampilkan , dan jenis hewan (Elang atau Harimau).
     
        echo "Info Hewan Elang";
        echo "Nama : {$this->nama}<br>";
        echo "Jenis Hewan : Elang<br>";
        echo "Darah : {$this->darah}<br>";            
        echo "Jumlah Kaki : {$this->jumlahKaki}<br>";
        echo "Keahlian : {$this->keahlian}<br>";
        echo "Attack Power : {$this->attackPower}<br>";
        echo "Deffence Power : {$this->deffencePower}<br>";
        echo "-------------------<br>";
        
    }
}