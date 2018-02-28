<?php
	include 'PrimeNumber.php';

//initialize class with $limit, $countPrime. $limit is used in simple Eratosthenes Sieve, Atkin method;
	$prime = new PrimeNumber(30, 10); 
	if($prime->result===false){ 
		echo 'Cant initialize prime class. Parameters limit/countPrime are wrong.';
		exit;
	}
//initialize variables	
	$primeNumbers = array();

//--return first N primes, using Segment Eratosthenes Sieve and Eratosthenes Sieve methods
	$primeNumbers = $prime->countSegmentEratosthenesSieve();
	if($prime->result===false) echo 'No prime numbers generated.';
/*	else{ 
		echo ' Segment Eratosthenes Sieve method ';
		print_r($primeNumbers);
	}
*/ 	
//--draw multiplication table, 12 numbers (and 4 digits max) are drawing ok
	$result = $prime->drawTablePrimesMultiply($primeNumbers);
	if($prime->result==false) echo 'Cant draw table. No prime numbers. ';


?>