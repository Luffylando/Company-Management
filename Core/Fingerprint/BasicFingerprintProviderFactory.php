<?php
    namespace Projekat\Core\Fingerprint;

    class BasicFingerprintProviderFactory {

      public function getInstance(string $arraySource): BasicFingerprintProvider {
        switch ($arraySource) {
          case 'SERVER' :
                return new \Projekat\Core\Fingerprint\BasicFingerprintProvider($_SERVER);
        }

        return new \Projekat\Core\Fingerprint\BasicFingerprintProvider($_SERVER);

      }
    }
