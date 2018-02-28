<?php
//	set_time_limit(150);   
	include 'PrimeNumber.php';

//initialize class with $limit, $countPrime. $limit is used in simle Eratosthenes Sieve, Atkin method; 30 limit gives 10 primes
	$prime = new PrimeNumber(30, 10); 
	if($prime->result===false){ 
		echo 'Cant initialize prime class. Parameters limit/countPrime are wrong.';
		exit;
	}
//initialize variables	
	$primeNumbers = array();
	$prNumber = 11;

//--check for prime with simple method	
/**/
	if ($prime->isSimplePrime($prNumber)) 
		echo $prNumber.' is prime.'."\n\r";
	else
		echo $prNumber.' is not prime.'."\n\r";	
	
//--return first N primes, using Simple method
$time_start = microtime(true);
	$primeNumbers = $prime->countSimplePrime();
	if($prime->result===false) echo 'No prime numbers generated.';
	else{ 
		echo ' Simple method ';
		print_r($primeNumbers);
	}
$time_end = microtime(true);
echo ($time_end - $time_start).' ms';

//--check Atkin method with given limit; it NOT implemented with given count of prime numbers
/**/	
$time_start = microtime(true);
	$primeNumbers = $prime->getAtkinSievePrimes();
	if($prime->result===false) echo 'No prime numbers generated.';
	else{ 
		echo ' Atkin method ';
		print_r($primeNumbers);
	}
$time_end = microtime(true);
echo ($time_end - $time_start).' ms';

//--check simple Eratosthenes Sieve method with given limit; it implemented with given count of prime numbers by segmentEratosthenesSieve(...) 
/**/
$time_start = microtime(true);
	 //10 primes   $limit=1490000; //113458 primes
	$primeNumbers = $prime->getEratosthenesSievePrimes();
	if($prime->result===false) echo 'No prime numbers generated.';
	else{ 
		echo ' Eratosthenes Sieve method ';
		print_r($primeNumbers);
	}
$time_end = microtime(true);
echo ($time_end - $time_start).' ms';

//--return first N primes, using Segment Eratosthenes Sieve and Eratosthenes Sieve methods
/**/
$time_start = microtime(true);
	$primeNumbers = $prime->countSegmentEratosthenesSieve();
	if($prime->result===false) echo 'No prime numbers generated.';
	else{ 
		echo ' Segment Eratosthenes Sieve method ';
		print_r($primeNumbers);
	}
$time_end = microtime(true);
echo ($time_end - $time_start).' ms';
 	
//--draw multiplication table, 12 numbers (and 4 digits max) are drawing ok
/**/ 
	$result = $prime->drawTablePrimesMultiply($primeNumbers);
	if($prime->result==false) echo 'Cant draw table. No prime numbers. ';


?>