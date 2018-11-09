<?php

class Configuration {


    const BASE = 'http://localhost/Company-Management/';

    // DB conf
    const DB_HOST = 'localhost';
    const DB_NAME = 'YOUR DB_NAME';
    const DB_USER = 'YOUR DB_USER';
    const DB_PASS = 'YOUR DB_PAS';


	const SESSION_STORAGE = '\\Projekat\\Core\\Session\\FileSessionStorage';
	const SESSION_STORAGE_DATA = [ './sessions/' ];
	const SESSION_LIFETIME = 3600;

	const FINGERPRINT_PROVIDER_FACTORY = '\\Projekat\\Core\\Fingerprint\\BasicFingerprintProviderFactory';
	const FINGERPRINT_PROVIDER_METHOD = 'getInstance';
	const FINGERPRINT_PROVIDER_ARGS = ['SERVER'];

}
