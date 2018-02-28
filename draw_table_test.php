<?php
set_time_limit(0);   
ini_set("memory_limit",-1);

	include 'PrimeNumber.php';

//initialize class with $limit, $countPrime. $limit is used in simle Eratosthenes Sieve, Atkin method; 30 limit gives 10 primes
	$prime = new PrimeNumber(1000, 1000); 
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
/**/	
$time_start = microtime(true);
	$primeNumbers = $prime->countSimplePrime();
	if($prime->result===false) echo 'No prime numbers generated.';
	else{ 
		echo ' Simple method ';
	//	print_r($primeNumbers);
	}
$time_end = microtime(true);
echo ($time_end - $time_start).' s'."\r\n";

//--check Atkin method with given limit; it NOT implemented with given count of prime numbers
// limit=1000000 time=1.4188888072968 s
/**/	
$time_start = microtime(true);
	$primeNumbers = $prime->getAtkinSievePrimes();
	if($prime->result===false) echo 'No prime numbers generated.';
	else{ 
		echo ' Atkin method ';
	//	print_r($primeNumbers);
	}
$time_end = microtime(true);
echo ($time_end - $time_start).' s'."\r\n";

//--check simple Eratosthenes Sieve method with given limit; it implemented with given count of prime numbers by segmentEratosthenesSieve(...) 
/**/
$time_start = microtime(true);
	 //10 primes   $limit=1490000; //113458 primes
	$primeNumbers = $prime->getEratosthenesSievePrimes();
	if($prime->result===false) echo 'No prime numbers generated.';
	else{ 
		echo ' Eratosthenes Sieve method ';
	//	print_r($primeNumbers);
	}
$time_end = microtime(true);
echo ($time_end - $time_start).' s'."\r\n";

//--return first N primes, using Segment Eratosthenes Sieve and Eratosthenes Sieve methods
/* */
$time_start = microtime(true);
	$primeNumbers = $prime->countSegmentEratosthenesSieve();
	if($prime->result===false) echo 'No prime numbers generated.';
	else{ 
		echo ' Segment Eratosthenes Sieve method ';
	//	print_r($primeNumbers);
	}
$time_end = microtime(true);
echo ($time_end - $time_start).' s'."\r\n";
	
//--draw multiplication table, 12 numbers (and 4 digits max) are drawing ok
/* 
	$result = $prime->drawTablePrimesMultiply($primeNumbers);
	if($prime->result==false) echo 'Cant draw table. No prime numbers. ';
*/

/*-------------------------------------------------------------------------Results
----------$limit=10, $countPrime=10
Simple method 0.0034010410308838 s
Atkin method 0.0082600116729736 s
Eratosthenes Sieve method 0.010096788406372 s
Segment Eratosthenes Sieve method 0.0093450546264648 s
----------$limit=1000000, $countPrime=1000000
Simple method 15.731806993484 s 
Atkin method 1.4133019447327 s 
Eratosthenes Sieve method 0.95883011817932 s 
Segment Eratosthenes Sieve method 0.18678689002991 s

Simple method 16.001303911209 s
Atkin method 1.4026880264282 s
Eratosthenes Sieve method 0.93678998947144 s
Segment Eratosthenes Sieve method 0.18401718139648 s

Simple method 15.875355005264 s
Atkin method 1.4118120670319 s
Eratosthenes Sieve method 0.96671915054321 s
Segment Eratosthenes Sieve method 0.19085907936096 s

----------$limit=10000000, $countPrime=10000000
Simple method  -  not executed
Atkin method 14.545518875122 s
Eratosthenes Sieve method 10.626372098923 s
Segment Eratosthenes Sieve method -	Fatal error: Out of memory (allocated 112459776) (tried to allocate 268435456 bytes) in D:\projects\conFusion\prime\PrimeNumber.php on line 347
sieve array problem - have to improve Segment Eratosthenes Sieve method

----------$limit=1000000000, $countPrime=1000000000
Atkin method - sieve array problem
Fatal error: Out of memory (allocated 1999896576) (tried to allocate 35 bytes) in D:\projects\conFusion\prime\PrimeNumber.php on line 175

Eratosthenes Sieve method, Segment Eratosthenes Sieve method - sieve array problem
Fatal error: Out of memory (allocated 2000683008) (tried to allocate 35 bytes) in D:\projects\conFusion\prime\PrimeNumber.php on line 262


*/
?>