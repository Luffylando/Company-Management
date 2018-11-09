<?php
    namespace Projekat\Models;

    use Projekat\Core\Model;

    class PartnerModel extends Model {

        public function getFileds():array{

            return [

                'partner_id'                    =>          '',
                'vrsta_paketa'                  =>          '',
                'naziv_kompanije'               =>          '',
                'logo_kompanije'                =>          '',              
                'opis_kompanije'                =>          '',


            ];
        }
    }

