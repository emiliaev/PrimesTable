Task---------------------------------------------------------------------------------------------------
Write a program that prints out a multiplication table of the first 10 prime
numbers.
The program must run from the command line and print one table to
STDOUT.
The first row and column of the table should have the 10 primes, with
each cell containing the product of the primes for the corresponding row and
column.
Notes
• Consider complexity. How fast does your code run? How does it scale?
• Consider cases where we want N primes.
• Do not use the Prime class from stdlib (write your own code).
• Write tests. Try to demonstrate TDD/BDD.
When you’re done
Put your code on GitHub or email us a zip/tarball.

Decision---------------------------------------------------------------------------------------------------
This is my result table with first 10 prime numbers, multiplied in cells. First row and column are given array of prime numbers, cells are the corresponding multiplication
+-----+-----+-----+-----+-----+-----+-----+-----+-----+-----+-----+
|     | 2   | 3   | 5   | 7   | 11  | 13  | 17  | 19  | 23  | 29  |
+-----+-----+-----+-----+-----+-----+-----+-----+-----+-----+-----+
| 2   | 4   | 6   | 10  | 14  | 22  | 26  | 34  | 38  | 46  | 58  |
| 3   | 6   | 9   | 15  | 21  | 33  | 39  | 51  | 57  | 69  | 87  |
| 5   | 10  | 15  | 25  | 35  | 55  | 65  | 85  | 95  | 115 | 145 |
| 7   | 14  | 21  | 35  | 49  | 77  | 91  | 119 | 133 | 161 | 203 |
| 11  | 22  | 33  | 55  | 77  | 121 | 143 | 187 | 209 | 253 | 319 |
| 13  | 26  | 39  | 65  | 91  | 143 | 169 | 221 | 247 | 299 | 377 |
| 17  | 34  | 51  | 85  | 119 | 187 | 221 | 289 | 323 | 391 | 493 |
| 19  | 38  | 57  | 95  | 133 | 209 | 247 | 323 | 361 | 437 | 551 |
| 23  | 46  | 69  | 115 | 161 | 253 | 299 | 391 | 437 | 529 | 667 |
| 29  | 58  | 87  | 145 | 203 | 319 | 377 | 493 | 551 | 667 | 841 |
+-----+-----+-----+-----+-----+-----+-----+-----+-----+-----+-----+

Usage:
Run the script in the command line with the following command
php "<path to script>draw_table.php"

There is 3 files
PrimeNumber.php - class implementation
draw_table.php - script to execute
draw_table_Test.php - here are all implemented methods with their execution time

Method for generate primes and number of primes are hardcoded. Number is 10, method is 3.1.Segmented Eratosthenes sieve, described below.  For 10 primes only it's ok to use anyone of the methods.

It will be good to add some parameters to the script and more functionality, but I left this for future development:
1.STDIN Parameter - Define method for primes generation
2.STDIN Parameter - Define number of primes 
3.Implement prime generation with given range
4.Implement more primes generation methods and compare execution time and memory.

Next is description for primes generation methods. I implemented first three methods.

1.Simple primality - implemented to generate N prime numbers. 
	- Set 1(not prime), 2,3(prime) 
	- Exclude even numbers
	- Use array of known primes
	- trial division and check odd numbers only - complexity O(sqrt(N)). 

2.Atkin - implemented only to generate prime numbers to given N. So it can't used for the given task (generate first 10 prime numbers).
	https://en.wikipedia.org/wiki/Sieve_of_Atkin
	The sieve of Atkin is a modern algorithm for finding all prime numbers up to a specified integer. Compared with the ancient sieve of Eratosthenes, which marks off multiples of primes, the sieve of Atkin does some preliminary work and then marks off multiples of squares of primes, thus achieving a better theoretical asymptotic complexity. It was created in 2003.
	https://stackoverflow.com/questions/10580159/sieve-of-atkin-explanation-and-java-example
	I used this example.

3.Eratosthenes sieve - implemented to generate prime numbers to given N.
	https://en.wikipedia.org/wiki/Sieve_of_Eratosthenes
	It does so by iteratively marking as composite (i.e., not prime) the multiples of each prime, starting with the first prime number, 2.
	Sieve of Eratosthenes is using O(n * (log n) * (log log n)) operations and O(sqrt(n)) space. The sieve of Eratosthenes is one of the most efficient ways to find all primes smaller than n when n is smaller than 10 million

	http://www.informatika.bg/lectures/primes?print
	I used this example.

3.1.Segmented Eratosthenes sieve - implemented to generate N prime numbers. Can used for the given task.
	https://en.wikipedia.org/wiki/Sieve_of_Eratosthenes
As Sorenson notes, the problem with the sieve of Eratosthenes is not the number of operations it performs but rather its memory requirements.[8] For large n, the range of primes may not fit in memory; worse, even for moderate n, its cache use is highly suboptimal. The algorithm walks through the entire array A, exhibiting almost no locality of reference.
A solution to these problems is offered by segmented sieves, where only portions of the range are sieved at a time.

There is some additional methods to generate prime numbers. I left them for future implementation. They are:
4.Miller–Rabin primality test
	https://en.wikipedia.org/wiki/Miller%E2%80%93Rabin_primality_test	
	Rabin-Miller is a standard probabilistic primality test. (you run it K times and the input number is either definitely composite, or it is probably prime with probability of error 4-K. (a few hundred iterations and it's almost certainly telling you the truth)
The Miller-Rabin and analogue tests are only faster than a sieve for numbers over a certain size (somewhere around a few million). Below that, using a trial division (if you just have a few numbers) or a sieve is faster.
	Time Complexity: O(log(n))

5.Fermat primality test
	https://en.wikipedia.org/wiki/Fermat_primality_test	
	It is a probabilistic test to determine whether a number is a probable prime.
	Time Complexity: O(log(n))
 
6.GMP Library - instead of Miller–Rabin
	http://php.net/manual/en/function.gmp-prob-prime.php
	gmp_prob_prime - uses Miller-Rabin's probabilistic test to check if a number is a prime.

Testing---------------------------------------------------------------------------------------------------
• Write tests. Try to demonstrate TDD/BDD.
Unfortunately I never did tests like TDD/BDD. I have to learn, but it will take more time than is reasonable for the interview task. So I decided to left learning TDD/BDD for the future. 
My tests were something like unit testing. I checked how the functions work with some hardcoded parameters.

• Consider complexity. How fast does your code run? How does it scale?
-------For generating first 10 prime numbers, the methods 
1.Simple method 0.0034010410308838 s
2.Atkin method 0.0082600116729736 s
3.Eratosthenes Sieve method 0.010096788406372 s
3.1.Segment Eratosthenes Sieve method 0.0093450546264648 s
produce similar time results.

-------For generating first 1000000 prime numbers execution time for the methods is
Simple method 16.001303911209 s
Atkin method 1.4026880264282 s
Eratosthenes Sieve method 0.93678998947144 s
Segment Eratosthenes Sieve method 0.18401718139648 s
 
-------For generating first 1000000000 prime numbers execution time for methods is
Simple method  -  not executed
Atkin method 14.545518875122 s
Eratosthenes Sieve method 10.626372098923 s
Segment Eratosthenes Sieve method - Fatal error: Out of memory 

-------Conclusion
Segment Eratosthenes Sieve method is more fast, so I used it for 10 primes.

• Consider cases where we want N primes.
All implemented methods can return N primes



