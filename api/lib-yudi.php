<?php

function convert_single_word_string_to_array($string) {
    $array = explode(' ', $string);
    if (count($array) > 1) {
        echo 'WARNING: (convert_single_word_string_to_array) not single word string';
    }
    return $array;
}

/**
 * Remove elements by keys from $user_arr
 */
function array_ignore($ignore_keys, & $array) {
    if (gettype($ignore_keys) == 'string') {
        $ignore_keys = convert_single_word_string_to_array($ignore_keys);
    }

    foreach ($ignore_keys as $ignore_key) {
        unset($array[$ignore_key]);
    }
}

/**
 * Check if query has record
 */
function db_has_record($result) {
    return mysqli_num_rows($result) > 0;
}


/*
| ----------------------------------------------------------------------------------
| INPUT VALIDATION FUNCTION
| ---------------------------------------------------------------------------------- */

$stackValidationMessage = []; // global variable hati-hati

function markAsValid()      { return true;  }
function markAsInvalid()    { return false; }

function inputValid()       { return true;  }
function inputNotValid()    { return false;  }

function validasiGagal($pesan) {
    global $stackValidationMessage;
    array_push($stackValidationMessage, $pesan);
}

function kirimPesanJikaValidasiGagal() {
    global $stackValidationMessage;

    if (count($stackValidationMessage) == 0) return;

    $output_message = '';
    foreach ($stackValidationMessage as $message) {
        $output_message .= $message . '<br>';
    }

    exit(json_encode([
        'status'    => 'ERROR',
        'message'   => $output_message,
    ]));
}

/**
 * Berguna untuk kasus isian kolom Nama kendaraan, Merk, dlsb
 *
 */
function validate_name_only($input) {
    if (preg_match('/[^a-zA-Z.\s]+/', $input)) {
        return markAsInvalid();
    }
    return markAsValid();
}

function validate_number_only($input) {
    if (preg_match('/[^0-9]+/', $input)) {
        return markAsInvalid();
    }
    return markAsValid();
}

function validate_alphanumeric_only($input) {
    if (preg_match('/[^a-zA-Z0-9.\s]+/', $input)) {
        return markAsInvalid();
    }
    return markAsValid();
}

/**
 * Contoh kasus penggunaan:
 *
 * kolom isian warna hanya boleh diisi dengan nama warna yang valid seperti Merah, Biru dlsb
 *
 * validate_enum('aku', ['merah', 'biru'])
 *
 * fungsi mengembalikkan return maskAsInvalid() karena 'aku' tidak ada di dalam enum
 *
 */
function validate_enum($input, $enum) {
    $ketemu = false;

    foreach ($enum as $enum_el) {
        if ($enum_el == $input) {
            $ketemu = true;
        }
    }

    if (! $ketemu) return markAsInvalid();
    return markAsValid();
}

/**
 * Contoh kasus penggunaan:
 *
 * kolom isian tanggal harus berformat dd-mm-YYYY
 *
 * validate_format('2018-09-11', 'dd-dd-dddd')
 *
 *
 * Format yang didukung:
 *      d = digit
 *      c = karakter alfabet
 *      p = karakter tanda (punctuation)
 */
function validate_format($input, $format) {
    if (strlen($input) !== strlen($format)) return markAsInvalid();

    $input_arr = str_split($input); // convert string to array of char

    // $index digunakan untuk manggil elemen $format
    foreach ($input_arr as $index => $input_char) {
        switch ($format[$index]) {
            case 'd':
                if (preg_match('/[^0-9]/', $input)) return markAsInvalid();
                break;
            case 'c':
                if (preg_match('/[^a-zA-Z]/', $input)) return markAsInvalid();
                break;
            case 'p':
                if (! preg_match('/[-[\]{}()*+?.,\\^$|#\s]/', $input)) return markAsInvalid();
                break;
            default:
                if (! ($format[$index] == $input_char)) return markAsInvalid();
        }
    }

    return markAsValid();
}

function validate_email($input) {
    if (! preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/', $input)) {
        return markAsInvalid();
    }
    return markAsValid();
}