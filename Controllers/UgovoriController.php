<?php
    namespace Projekat\Controllers;

    use Projekat\Core\Controller;
    use Projekat\Models\KorisnikModel;
    use Projekat\Models\UgovoriModel;
    use Projekat\Models\PaketModel;
    use Projekat\Models\KompanijaModel;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

 




    class UgovoriController extends Controller {

        public function ugovori() {

            $sesija = $this->getSession()->get('korisnik_id');

            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);      

            if($korisnik->role == null || $korisnik->role == 'Gost'){
                $this->redirect(\Configuration::BASE);
            }
             
            $ugovoriModel = new UgovoriModel($this->getDbConnection());
            $ugovori = $ugovoriModel->getAll();
            $this->set('ugovori', $ugovori);

            $poslednjiUgovori = $ugovoriModel->getLast5('datum_sklapanja_ugovora');
            $this->set('poslednjiUgovori', $poslednjiUgovori);
           
            $ugovori = $ugovoriModel->getExpire5('datum_sklapanja_ugovora');
            $this->set('ugovori', $ugovori);

        }


        public function getDodajUgovor(){

            $sesija = $this->getSession()->get('korisnik_id');
            
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);      
            
            $paketModel = new PaketModel($this->getDbConnection());
            $paketi = $paketModel->getAll();
            $this->set('paketi', $paketi);


            $kompanijaModel = new KompanijaModel($this->getDbConnection());
            $kompanije = $kompanijaModel->getAll();
            $this->set('kompanije', $kompanije);


            if($korisnik->role == null || $korisnik->role == 'Gost'){
                $this->redirect(\Configuration::BASE);
            }

        }

        public function postDodajUgovor(){

            $sesija = $this->getSession()->get('korisnik_id');
            
            $korisnikModel = new KorisnikModel($this->getDbConnection());
            $korisnik = $korisnikModel->getById($sesija);
            $this->set('korisnik', $korisnik);   

            $naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
            $paket = filter_input(INPUT_POST, 'paket', FILTER_SANITIZE_STRING);
            $cena = filter_input(INPUT_POST, 'cena', FILTER_SANITIZE_STRING);
            $naziv_paketa = filter_input(INPUT_POST, 'naziv_paketa', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
            $trajanje = filter_input(INPUT_POST, 'trajanje', FILTER_SANITIZE_STRING);
            $ugovor_sklopio = $korisnik->korisnicko_ime;
            $datum_sklapanja = date("Y-m-d H:i:s");
            $datum_isticanja = date('Y-m-d H:i:s', strtotime($datum_sklapanja . ' + 1 years'));
            $link_kompanije = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
            
            $ugovoriModel = new UgovoriModel($this->getDbConnection());
            $dodajUgovor = $ugovoriModel->add([

            
                'naziv_kompanije'            => $naziv,
                'vrsta_ugovora'              => $paket,
                'naziv_paketa'               => $naziv_paketa,
                'vrednost_ugovora'           => $cena,
                'email'                      => $email,
                'datum_sklapanja_ugovora'    => $datum_sklapanja,
                'datum_isticanja_ugovora'    => $datum_isticanja,
                'status_ugovora'             => $status,
                'ugovor_sklopio'             => $ugovor_sklopio,
                'link_kompanije'             => $link_kompanije,


            ]);

            if($dodajUgovor){

                $this->redirect(\Configuration::BASE . 'ugovori');
            } else {
                ob_start();
                echo 'Doslo je do greske';
            }
        }

        public function getMail(){

         $sesija = $this->getSession()->get('korisnik_id');
            
        $korisnikModel = new KorisnikModel($this->getDbConnection());
        $korisnik = $korisnikModel->getById($sesija);
        $this->set('korisnik', $korisnik);      


          $mailTo = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
          $mailFrom = 'etf@gmail.com';
          
          $this->set('mailTo', $mailTo);
          $this->set('mailFrom', $mailFrom);


          if($korisnik->role == null || $korisnik->role == 'Gost' || $korisnik->role == 'Clan tima'){
            $this->redirect(\Configuration::BASE);
        }

        }

        public function postMail(){

           $from = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_STRING);
           $to = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_STRING);
           $sub = filter_input(INPUT_POST, 'sub', FILTER_SANITIZE_STRING);
           $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);



           $mail = new PHPMailer(true);

            if($mail){

                $mail->SMTPDebug = 1;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'antonije25.01.1994@gmail.com'; // ovde moraju da se stave ispravni podaci, posto je ovo posaljilac.
                $mail->Password = 'wistalia';
                $mail->SMTPSecure = 'tsl';
                $mail->Port = 587;

                $mail->SMTPOptions = array(
                    'ssl'   => array(
                        'veify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->setFrom('antonije25.01.1994@gmail.com');
                $mail->addAddress($to);

                $mail->isHtml(true);
                $mail->Subject = $sub;
                $mail->Body = $body;
                $mail->send();
         
                echo "<script>window.location.replace('localhost/Projekat')</script>";
              
            }  else {
                echo "message not sent";

            }
        }

        public function ugovoriAjax(){

            $ugovoriModel = new UgovoriModel($this->getDbConnection());
            $ugovoriAjax = $ugovoriModel->getUgovoriAjax();
            $this->set('ugovoriAjax', $ugovoriAjax);

        }
    }