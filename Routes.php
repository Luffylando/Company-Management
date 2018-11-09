<?php

return [

// Auth

Projekat\Core\Route::get('|^auth/login/?$|',                            'Auth',                 'getLogin'),
Projekat\Core\Route::post('|^auth/login/?$|',                           'Auth',                 'postLogin'),
Projekat\Core\Route::get('|^auth/register/?$|',                         'Auth',                 'getRegister'),
Projekat\Core\Route::post('|^auth/register/?$|',                        'Auth',                 'postRegister'),
Projekat\Core\Route::get('|^auth/logout/?$|',                           'Auth',                 'logout'),
Projekat\Core\Route::get('|^auth/password/?$|',                         'Auth',                 'getChangePassword'),
Projekat\Core\Route::post('|^auth/password/?$|',                        'Auth',                 'postChangePassword'),

// Paketi
Projekat\Core\Route::get('|^pretraga-partnera/?$|',                     'Partner',              'getPretragaPartnera'),
Projekat\Core\Route::post('|^pretraga-partnera/?$|',                    'Partner',              'postPretragaPartnera'),

Projekat\Core\Route::post('|^pretraga-partnera/([0-9]+)/?$|',           'Partner',              'getPartner'),
Projekat\Core\Route::post('|^pretraga-partnera/izmeni/([0-9]+)/?$|',    'Partner',              'izmeniPartnera'),
Projekat\Core\Route::post('|^izmeni-partnera/?$|',                      'Partner',              'postIzmeniPartnera'),


Projekat\Core\Route::get('|^paketi/?$|',                                'Paket',                'paketi'),
Projekat\Core\Route::get('|^dodaj-paket/?$|',                           'Paket',                'getPaket'),
Projekat\Core\Route::post('|^dodaj-paket/?$|',                          'Paket',                'postPaket'),
Projekat\Core\Route::post('|^izmeni-paket/([0-9]+)/?$|',                'Paket',                'getIzmeniPaket'),
Projekat\Core\Route::post('|^izmeniPaket/([0-9]+)/?$|',                 'Paket',                'postIzmeniPaket'),

Projekat\Core\Route::get('|^deletePaket/([0-9]+)/?$|',                  'Paket',                'deletePaket'),


Projekat\Core\Route::get('|^oglasi/?$|',                                'Poslovi',              'sviPoslovi'),
Projekat\Core\Route::get('|^dodaj-oglas/?$|',                           'Poslovi',              'getDodajOglas'),
Projekat\Core\Route::post('|^dodaj-oglas/?$|',                           'Poslovi',             'postDodajOglas'),


Projekat\Core\Route::post('|^predavanja/([0-9]+)/?$|',                  'Poslovi',              'pojedinacnoPredavanje'),
Projekat\Core\Route::get('|^predavanja/?$|',                            'Poslovi',              'predavanja'),
Projekat\Core\Route::get('|^dodaj-predavanje/?$|',                      'Poslovi',              'dodajPredavanje'),
Projekat\Core\Route::post('|^dodaj-predavanje/?$|',                     'Poslovi',              'postDodajPredavanje'),


Projekat\Core\Route::get('|^ugovori/?$|',                               'Ugovori',              'ugovori'),
Projekat\Core\Route::get('|^dodaj-ugovor/?$|',                          'Ugovori',              'getDodajUgovor'),
Projekat\Core\Route::post('|^dodaj-ugovor/?$|',                         'Ugovori',              'postDodajUgovor'),


Projekat\Core\Route::get('|^dodaj-kompaniju/?$|',                       'Kompanija',            'getKompanija'),
Projekat\Core\Route::post('|^dodaj-kompaniju/?$|',                      'Kompanija',            'postKompanija'),
Projekat\Core\Route::post('|^pretraga-kompanija/?$|',                   'Kompanija',            'pretragaKompanija'),
Projekat\Core\Route::get('|^pretraga-kompanija/([0-9]+)/?$|',           'Kompanija',            'pogledajKompaniju'),
Projekat\Core\Route::post('|^izmeni-kompaniju/([0-9]+)/?$|',            'Kompanija',            'izmeniKompaniju'),
Projekat\Core\Route::post('|^postIzmeniKompaniju/([0-9]+)/?$|',         'Kompanija',            'postIzmeniKompaniju'),


Projekat\Core\Route::get('|^dodaj-korisnika/?$|',                       'Korisnik',             'getDodaj'),
Projekat\Core\Route::post('|^dodaj-korisnika/?$|',                      'Korisnik',             'postDodaj'),
Projekat\Core\Route::post('|^razresavanje-zahteva/?$|',                 'Pocetna',              'postZahtevi'),


//test get ajax
Projekat\Core\Route::post('|^get-ajax/?$|',                             'Poslovi',              'testAjax'),
Projekat\Core\Route::post('|^predavanja-ajax/?$|',                      'Poslovi',              'predavanjaAjax'),
Projekat\Core\Route::post('|^ugovori-ajax/?$|',                         'Ugovori',              'ugovoriAjax'),


//  Mail
Projekat\Core\Route::post('|^posalji-mail/?$|',                         'Ugovori',              'getMail'),
Projekat\Core\Route::post('|^posalji-mail-post/?$|',                    'Ugovori',              'postMail'),


// Home page and error page
Projekat\Core\Route::any('|^error_page/?$|',                            'Pocetna',               'error_page'),
Projekat\Core\Route::any('|^.*$|',                                      'Pocetna',               'index'),



];