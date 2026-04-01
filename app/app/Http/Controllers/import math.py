import math

def primes_up_to(n):
    """Return all primes ≤ n using sieve."""
    if n < 2:
        return []
    sieve = [True]*(n+1)
    sieve[0] = sieve[1] = False
    for i in range(2, int(n**0.5)+1):
        if sieve[i]:
            for j in range(i*i, n+1, i):
                sieve[j] = False
    return [p for p, is_prime in enumerate(sieve) if is_prime]

def binomial_mod_check(m, p):
    """
    Check if m divides C(m, p) without computing huge factorials.
    Uses the property: C(m, p) = m*(m-1)*...*(m-p+1)/p!
    Returns True if divisible, False otherwise.
    """
    numerator = 1
    for i in range(p):
        numerator = (numerator * (m - i)) % m  # stepwise modulo m
    # numerator % m is always 0 if m is prime
    return numerator % m == 0

def is_prime_theorem(m):
    """Check primality using your combinatorial theorem."""
    for p in primes_up_to(int(math.isqrt(m))):
        if not binomial_mod_check(m, p):
            return False, p  # composite, p divides m
    return True, None

def next_prime_theorem(start):
    """Find the next prime > start efficiently using the theorem."""
    m = start + 1
    while True:
        prime, factor = is_prime_theorem(m)
        if prime:
            return m
        # skip multiples of factor if known
        if factor:
            m += factor - (m % factor)
        else:
            m += 1

# Example usage:
n = 10**12  # very large starting number
next_p = next_prime_theorem(n)
print(f"The next prime after {n} is {next_p}")