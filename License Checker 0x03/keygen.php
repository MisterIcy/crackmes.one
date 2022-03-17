<?php
/**
 * Returns a random digit.
 * 
 * @return string
 */
function randomDigit(): string
{
    return (string)random_int(0, 9);
}

/**
 * Validates the key.
 * 
 * @param string $key The key to validate
 * @return int 0 if the key is valid, -1 if the key is less than the validation check, 1 if the key is greater than the check
 */
function validateKey(string $key): int
{
    $validation = 0x32;
    $bucket = 0;
    for ($i = 0; $i < strlen($key); $i++) {
        $bucket += (int)$key[$i];
    }

    if ($bucket < $validation) {
        return -1;
    }

    if ($bucket > $validation) {
        return 1;
    }

    return 0;
}
/**
 * Generates a key.
 * 
 * @return string
 */
function generateKey(): string 
{
    $valid = 0;
    $key = '';
    do {
        $key .= randomDigit();
        $valid = validateKey($key);
        if ($valid < 0) {
            continue;
        }

        if ($valid > 0) {
            $key = '';
        }
    } while ($valid !== 0);

    return $key;
}

echo generateKey() . "\n";
