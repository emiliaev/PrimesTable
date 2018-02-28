<?php
/**
 * class PrimeNumber
 * return N prime numbers, use different methods for prime numbers generation
 * draw multiplication table with generated N primes (optimized for 12 primes)
 */
	class PrimeNumber {
		public $result = true;		
		private $number;
		private $limitNumber;	//used in Eratosthenes Sieve and Atkin methods
		private $countPrime;
		private $primeNumbersArr = array();
		private $primeNumbersSegmentArr = array(); 
	//define list of known primes, used in simple methods	
	//define array with first 100 primes, 
	//get the the first 1.4 billion primes from here http://www.bigprimes.net/  which should include every prime under 30 billion.
		private $knownPrimes = 
			array(2,3,5,7,11); //for test purposes use only first 5 primes TODO open all array for primes more than 100
			/*
			array(
			      2,      3,      5,      7,     11,     13,     17,     19,     23,     29, 
			     31,     37,     41,     43,     47,     53,     59,     61,     67,     71, 
			     73,     79,     83,     89,     97,    101,    103,    107,    109,    113, 
			    127,    131,    137,    139,    149,    151,    157,    163,    167,    173, 
			    179,    181,    191,    193,    197,    199,    211,    223,    227,    229, 
			    233,    239,    241,    251,    257,    263,    269,    271,    277,    281, 
			    283,    293,    307,    311,    313,    317,    331,    337,    347,    349, 
			    353,    359,    367,    373,    379,    383,    389,    397,    401,    409, 
			    419,    421,    431,    433,    439,    443,    449,    457,    461,    463, 
			    467,    479,    487,    491,    499,    503,    509,    521,    523,    541	
				);
				*/

		public function __construct($limit, $countPrime) {
			if ( (int)$limit<=0 || (int)$countPrime <= 0){ 
				$this->result = false; 
		        return;
			}
			$this->limitNumber = $limit;
			$this->countPrime = $countPrime;
		}
			
		/**
		 * Check primality - with Simple methods
		 *
		 * @param $num
		 *	any integer number
		 *
		 * @return
		 *   BOOLEAN
		 */
		public function isSimplePrime($num) {
			if ((int)$num <= 0){ 
				$this->result = false;
		        return $this->result;
			}
			$this->number = $num;
			self::checkSimplePrime(); 
			return $this->result;
		}
		
		/**
		 * Return first N primes, using Simple methods
		 *
		 * @param $this->countPrime
		 *	integer number
		 *
		 * @return
		 *   array
		 */
		public function countSimplePrime() {
			$i=0; $c = 0; 
			while(1){
				$i++;
				if((self::isSimplePrime($i))) {
					$c++;
					$this->primeNumbersArr[$c] = $i;
				}
				if($c>=$this->countPrime) break;
			}
			if(count($this->primeNumbersArr)<=0){
				$this->result = false;
			} else 
				return $this->primeNumbersArr;
		}

//1.Simple primality
		/**
		 * Check simple primality 
		 *
		 * @param $this->countPrime
		 * integer number
		 *	
		 * @return
		 *   BOOLEAN
		 */
		private function checkSimplePrime() { 
			$counter = 0;
			if (!is_int($this->number) || $this->number <= 0 ){ 
					$this->result = false;
			        return;
			}
		//0,1 are not primes by definition			
			if ($this->number < 2 ) { 
				$this->result = false;
				return;
			}
		//2 is prime (the only even number that is prime), 3 also is prime
		    if($this->number == 2 || $this->number == 3){
				$this->result = true;
		        return;
		    }
		//Exclude even number, number is divisible by 2 and therefore is not prime
			if ($this->number % 2 == 0) { 
				$this->result = false;
				return;
			}
		//Use array of known primes to decrease operations	
		   if (in_array($this->number, $this->knownPrimes)) {
					$this->result = true;
					return;
		   }
		//trial division and check odd numbers only	
		   $primeLimit = ceil(sqrt($this->number));
		   for($i = 3; $i <= $primeLimit; $i = $i + 2) {
				if ($this->number % $i == 0) { 
					$this->result = false;
					return;
				}
			}
			$this->result = true;
			return;
		}

		/**
		 * Get prime numbers using Atkin Sieve
		 *
		 * @return
		 *   array
		 */
		public function getAtkinSievePrimes() {
			self::primeAtkinSieve();
			if(count($this->primeNumbersArr)<=0)
				$this->result = false;
			else {
				$this->result = true;
				return $this->primeNumbersArr;
			}
		}

/*
	2.Sieve of Atkin
https://en.wikipedia.org/wiki/Sieve_of_Atkin
The sieve of Atkin is a modern algorithm for finding all prime numbers up to a specified integer. Compared with the ancient sieve of Eratosthenes, which marks off multiples of primes, the sieve of Atkin does some preliminary work and then marks off multiples of squares of primes, thus achieving a better theoretical asymptotic complexity. It was created in 2003
https://stackoverflow.com/questions/10580159/sieve-of-atkin-explanation-and-java-example
I used this example
*/
		/**
		 * Check primality with method Sieve of Atkin. Return prime numbers less or equal to given N number
		 *
		 * @param $limit
		 * integer number
		 *
		 * @return
		 *   array
		 */
		private function primeAtkinSieve() {
		// initialize results array			
			$sieve = array_fill(0, $this->limitNumber + 1, false);
		// the sieve works only for integers > 3, so set these trivially to their proper values
		    $sieve[0] = false;
		    $sieve[1] = false;
		    $sieve[2] = true;
		    $sieve[3] = true;			
			$limit_sqrt = sqrt($this->limitNumber);

		/* loop through all possible integer values for x and y up to the square root of the max prime for the sieve we don't need any larger values for x or y since the max value for x or y will be the square root of n in the quadratics the theorem showed that the quadratics will produce all primes that also satisfy their wheel factorizations, so we can produce the value of n from the quadratic first and then filter n through the wheel quadratic there may be more efficient ways to do this, but this is the design in the Wikipedia article loop through all integers for x and y for calculating the quadratics
		*/
			for ($i = 1; $i <= $limit_sqrt; $i++) {
				for ($j = 1 ; $j <= $limit_sqrt; $j++) {
				// first quadratic using m = 12 and r in R1 = {r : 1, 5}	
					$n = 4*$i*$i + $j*$j ; //3.1.
					if ($n <= $this->limitNumber && ($n % 12 == 1 || $n % 12 == 5)) {
						$sieve[$n] = ! $sieve[$n];
					}
				// second quadratic using m = 12 and r in R2 = {r : 7}
					$n = 3*$i*$i + $j*$j; //3.2.
					if ($n <= $this->limitNumber && $n % 12 == 7) {
						$sieve[$n] = ! $sieve[$n];
					}					
            	// third quadratic using m = 12 and r in R3 = {r : 11}
					$n = 3*$i*$i - $j*$j; //3.3.					
					if ($i > $j && $n <= $this->limitNumber && $n % 12 == 11) {
						$sieve[$n] = ! $sieve[$n];
					}
	            /*note that R1 union R2 union R3 is the set R 
	            R = {r : 1, 5, 7, 11}
	            which is all values 0 < r < 12 where r is a relative prime of 12  Thus all primes become candidates
	            */					
				}
			}
		// remove all perfect squares since the quadratic wheel factorization filter removes only some of them
			for ($n = 5 ; $n <= $limit_sqrt ; $n++) {
				if ($sieve[$n]) {
					$s = $n*$n;
					
					for ($k = $s; $k <= $this->limitNumber; $k += $s) {
						$sieve[$k] = false;
					}
				}
			}
		// put the results in the primeNumbers array
			$c=0;
			for ( $i = 0 ; $i < $this->limitNumber ; $i++) {
				if ($sieve[$i]) {
					$c++;
					$this->primeNumbersArr[$c] = $i;
				}
			}
		//error result
			if($c <= 0)
				$this->result = false;
		}
		
		/**
		 * Get prime numbers using Sieve of Eratosthenes
		 *
		 * @return
		 *   array
		 */
		public function getEratosthenesSievePrimes() {
			self::primeEratosthenesSieve(); 
			if(count($this->primeNumbersArr)<=0)
				$this->result = false;
			else{
				$this->result = true;
				return $this->primeNumbersArr;
			}
		}

//3.Sieve of Eratosthenes
//http://www.informatika.bg/lectures/primes?print
//https://en.wikipedia.org/wiki/Sieve_of_Eratosthenes
		/**
		 * Check primality with method Eratosthenes Sieve. Return prime numbers less or equal to given N number
		 * use param $this->limitNumber
		 *
		 * @param $this->limitNumber
		 * integer number
		 *
		 * @return
		 *   array
		 */
		private function primeEratosthenesSieve() {
			$limit_sqrt = intval(sqrt($this->limitNumber));
			$sieve = array_fill(1, $this->limitNumber, true); 
		//mark the sieve with no primes
			$sieve[1] = false; //1 is not prime by definition
			for ($i = 2; $i <= $limit_sqrt; $i++){
				if ($sieve[$i]) {
					for ($j = $i * $i; $j <= $this->limitNumber; $j += $i){
						$sieve[$j] = false;
					}
				}
			}
		//create array with primes
			$c = 0;
			foreach ($sieve as $i => $is_prime){
				if ($is_prime) {
					$c++;
					$this->primeNumbersArr[$c] = $i;
				}
			}
		//error result
			if($c<=0)
				$this->result = false;
		}

		/**
		 * Return first N primes, using Segment Eratosthenes Sieve
		 *
		 * @param $countPrime
		 * integer number
		 *
		 * @param $this->limitNumber
		 * integer number
		 *
		 * @return
		 *   array
		 */
		public function countSegmentEratosthenesSieve() { //TODO delete prints
		//first primes array with Eratosthenes Sieve method
			$cnt=0;
			$this->limitNumber = $this->countPrime*2;//increase limit by 2
			self::getEratosthenesSievePrimes();  
			$this->primeNumbersSegmentArr = $this->primeNumbersArr;
			$cnt = count($this->primeNumbersSegmentArr);
			//echo ' start='.$cnt;

		//next primes array with Segment Eratosthenes Sieve method; add primes to countPrime
			$i=2; $c=0;
			while($cnt < $this->countPrime){
			  	$c++; $i+=2;
			  	$this->limitNumber = $this->countPrime*$i; //increase limit by 2
				self::segmentEratosthenesSieve();  
				$cnt = count($this->primeNumbersSegmentArr);
			 }
			 //echo ' final='.$cnt;
	
			if($cnt<=0){
				$this->result = false;
			} else {
				$this->result = true;
				return $this->primeNumbersSegmentArr;
			}
		}

//3.1.Segmented Sieve of Eratosthenes
		/**
		 * Add more elements to the given array of prime numbers, using first array generated by primeEratosthenesSieve($limit) 
		 *
		 * @param $this->limitNumber
		 * integer number
		 *
		 * @param $this->primeNumbersSegmentArr
		 * integer number
		 *
		 * @param $this->countPrime
		 * integer number
		 *
		 * @return
		 *   array
		 */
		private function segmentEratosthenesSieve(){  //TODO delete comments
		//check params
			$cntPrime=count($this->primeNumbersSegmentArr);
			if( $cntPrime<=0 ){
				$this->result = false; 
		        return;
			}

			$low = floor(sqrt($this->limitNumber));
		//Create sieve
			$sieve = array_fill(1, $this->limitNumber, true); //TODO mark have to be without already generated - count(primeNumbers) ?
		// Use the found primes by primeEratosthenesSieve() to find primes in current range
		    for ($i = 1; $i <= $cntPrime; $i++){
		// Find the minimum number that is a multiple of primeNumbers[i] (divisible by primeNumbers[i])
		// For example, if low is 31 and primeNumbers[i] is 3, we start with 33. //TODO remove comment
		        $loLim = floor($low/$this->primeNumbersSegmentArr[$i]) * $this->primeNumbersSegmentArr[$i];
		        if ($loLim < $low)
		            $loLim += $this->primeNumbersSegmentArr[$i];
		//TODO change comment, check for space, maybe separate big prime array into ranges ?
		/* Mark multiples of primeNumbers[i]
		   We are marking j - low for j, i.e. each number in range [low, high] is mapped to [0, high-low] so if range is [50, 100] marking 50 corresponds to marking 0, marking 51 corresponds to 1 and so on. In this way we need to allocate space only for range */
		        for ($j=$loLim; $j<$this->limitNumber; $j+=$this->primeNumbersSegmentArr[$i]){ //?<=
		            $sieve[$j-$low] = false;
		     	}
		    }
		//Generate final array with PrimeNumbers
			end($this->primeNumbersSegmentArr);
			$lastKeyPrime = key($this->primeNumbersSegmentArr);
			$c=0; 
			for ($i = $low; $i < $this->limitNumber; $i++){//<=?
			    if ($sieve[$i - $low] == true){
					$c++;
				//	echo $i.' ';
					$this->primeNumbersSegmentArr[$c+$lastKeyPrime]=$i; 
				//	echo '*$c+$lastKeyPrime*'.$c+$lastKeyPrime.'**'.$this->primeNumbersSegmentArr[$c+$lastKeyPrime].' ';
				//	$this->primeNumbersSegmentArr[$c+$lastKeyPrime]=$i;
					if($this->countPrime == $c+$lastKeyPrime) break; //reached given count
				}
			 }
		    //echo 'pimes add='.$c.'**';
  		//error result
			if($c <= 0)
				$this->result = false;
		}

	//TODO
	/*
	Implement other algorytms
	 
	1.Miller–Rabin primality test
https://en.wikipedia.org/wiki/Miller%E2%80%93Rabin_primality_test	
It is a primality test: an algorithm which determines whether a given number is prime

	2.Fermat primality test
https://en.wikipedia.org/wiki/Fermat_primality_test	
It is a probabilistic test to determine whether a number is a probable prime.
 
 	3.GMP Library - instead of Miller–Rabin
http://php.net/manual/en/function.gmp-prob-prime.php
gmp_prob_prime - uses Miller-Rabin's probabilistic test to check if a number is a prime.
	
	*/	
		
		/**
		 * Count digits in number. Used for draw table numbers with different digits. 
		 *
		 * @param $number
		 *	any integer number
		 *
		 * @return
		 *   integer
		 */
		private function count_digit($number) {
			if (!is_int($number)) return false;
			return strlen((string) $number);
		}	
		
		/**
		 * Draw table with multiplied prime numbers. First row and column are given array of prime numbers, cells are the corresponding multiplication 
		 *
		 * @param $primeNumbers
		 *	array with primes
		 *
		 * @return
		 *   table in console view
		 */
		public function drawTablePrimesMultiply($primeNumbers) { 
			$cnt = count($primeNumbers);
			if($cnt<=0){
				$this->result = false;
				return;
			} 
			$maxNumberDigits = $this->count_digit(max($primeNumbers)); //used to adjust table symbols
			$newRowSymbol="\n\r"; 
		//head
		//row1
			for($tr=0; $tr<=$cnt; $tr++)
				echo '+'.str_pad('', $maxNumberDigits+3,'-' ); // fill with '+-------';
			echo '+';
			echo $newRowSymbol;
		//row2
			for($tr=0; $tr<=$cnt; $tr++){
				if($tr==0)
					echo '| '. str_pad('', $maxNumberDigits+2);
				else
					echo '| '.str_pad($primeNumbers[$tr], $maxNumberDigits+2); 
			}
			echo '|';
			echo $newRowSymbol;
		//row3
			for($tr=0; $tr<=$cnt; $tr++)
				echo '+'.str_pad('', $maxNumberDigits+3,'-' ); // fill with '+-------';
			echo '+';
			echo $newRowSymbol;
		//rows	
			foreach ($primeNumbers as $row=>$rowValue){
				foreach ($primeNumbers as $col=>$colValue){
					if($col==1) //first column - add column head with prime number
						echo  '| '. str_pad($primeNumbers[$row], $maxNumberDigits+2). '| '.str_pad($rowValue*$colValue, $maxNumberDigits+2);
					else if ($col==$cnt) //final column - add |
						echo '| '.str_pad($rowValue*$colValue, $maxNumberDigits+2).'|';
					else  //all other columns	
						echo '| '.str_pad($rowValue*$colValue, $maxNumberDigits+2);
				}
			echo $newRowSymbol;
			}	
		//final table row
			for($tr=0; $tr<=$cnt; $tr++)
				echo '+'.str_pad('', $maxNumberDigits+3,'-' ); // fill with '+-------';
			echo '+';
			echo $newRowSymbol;
			
			$this->result = true;
		}		
		
	}//class end
	
	