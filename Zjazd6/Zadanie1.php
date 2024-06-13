<?php
    class NoweAuto{
        private $model; // string
        private $cenaEuro; // int/float
        private $kursEuroDoPln; // float

        public function __construct($model, $cenaEuro, $kursEuroDoPln) {
            $this->model = $model;
            $this->cenaEuro = $cenaEuro;
            $this->kursEuroDoPln = $kursEuroDoPln;
        }
        public function getModel(){
            return $this->model;
        }
        public function getCenaEuro(){
            return $this->cenaEuro;
        }
        public function getKursEuroDoPln(){
            return $this->kursEuroDoPln;
        }


        public function ObliczCene(){
            return $this->cenaEuro * $this->kursEuroDoPln;
        }

    }

    class AutoZDodatkami extends NoweAuto{
        private $alarm; // int/float
        private $radio; // int/float
        private $klimatyzacja; // int/float

        public function __construct($model, $cenaEuro, $kursEuroDoPln, $alarm, $radio, $klimatyzacja){
            parent::__construct($model, $cenaEuro, $kursEuroDoPln);
            $this->alarm = $alarm;
            $this->radio = $radio;
            $this->klimatyzacja = $klimatyzacja;
        }
        public function getAlarm(){
            return $this->alarm;
        }
        public function getRadio(){
            return $this->radio;
        }
        public function getKlimatyzacja(){
            return $this->klimatyzacja;
        }

        public function ObliczCene()
        {
            $cenaAuta = $this->alarm + $this->radio + $this->klimatyzacja + parent::getCenaEuro();
            return $cenaAuta * parent::getKursEuroDoPln();
        }

    }

    class Ubezpieczenie extends autoZDodatkami{
        private $procentUbezpieczenia; // float
        private $lataSamochodu; // int

        public function __construct($model, $cenaEuro, $kursEuroDoPln, $alarm, $radio, $klimatyzacja, $procentUbezpieczenia, $lataSamochodu){
            parent::__construct($model, $cenaEuro, $kursEuroDoPln, $alarm, $radio, $klimatyzacja);
            $this->procentUbezpieczenia = $procentUbezpieczenia;
            $this->lataSamochodu = $lataSamochodu;
        }
        public function obliczCene(){
            $wartoscZDodatkami = parent::obliczCene();
            return ($this->procentUbezpieczenia * ($wartoscZDodatkami * ((100-$this->lataSamochodu)/100)) );
        }

    }


$fura = new NoweAuto("Toyota Corolla", 20000, 4.5);
echo "Koszt fury w PLN to: " . $fura->ObliczCene() . "\n";
$furaZDodatkami = new AutoZDodatkami("Toyota Corolla", 20000, 4.5,300,200,500);
echo "Koszt fury z dodatkami w PLN to: " . $furaZDodatkami->ObliczCene() . "\n";
$furaZUbezpieczeniem = new Ubezpieczenie("Toyota Corolla", 20000, 4.5,300,200,500,0.1,10);
echo "Koszt ubezpieczenia w PLN to: " . $furaZUbezpieczeniem->ObliczCene() . "\n";
?>