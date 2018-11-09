<?php
    namespace Projekat\Models;

    use Projekat\Core\Model;

    class PaketModel extends Model {

        public function getFileds():array{

            return [

                'paket_id'                      =>          '',
                'vrsta_paketa'                  =>          '',
                'naziv_paketa'                  =>          '',
                'vrednost_paketa'               =>          '',
                'trajanje_paketa'               =>          '',
                'maksimalan_broj_paketa_u_god'  =>          '',
                'opis_stavki_paketa'            =>          '',


            ];
        }

    }