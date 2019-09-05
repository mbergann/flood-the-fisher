<?php

$url = "https://email.login.08238726392047.sicherheit.283746823234.87h33f.pro/login.php";

function generateMail()
{
    $domains = [
        'gmx.de',
        'web.de',
        'freenet.de',
        'outlook.com',
        'email.com',
        'gmail.com',
        'microsoft.com',
        'yahoo.com',
        't-online.de',
        'vodafone.de',
        'aol.com',
        'arcor.de',
    ];

    $domainsMax = sizeof($domains) -1;

    $firstNames = [
        'Arne',
        'Anne',
        'Alfred',
        'Alex',
        'Alexander',
        'Alexandra',
        'Alexa',
        'Amelie',
        'Bertram',
        'Benjamin',
        'Bjoern',
        'Beatrice',
        'Bianca',
        'Clemens',
        'Claudio',
        'Claudia',
        'Carolin',
        'Detlef',
        'Dieter',
        'Dean',
        'Dora',
        'Doreen',
        'Emil',
        'Emely',
        'Emilia',
        'Emma',
        'Eduard',
        'Florian',
        'Felix',
        'Felicitas',
        'Fiona',
        'Gustav',
        'Gerd',
        'Geraldine',
        'Gundula',
        'Hannah',
        'Hannes',
        'Heinz',
        'Ingolf',
        'Ino',
        'Ingo',
        'Inge',
        'Jasmin',
        'Juergen',
        'Jasper',
        'Karl',
        'Klaus',
        'Kornelia',
        'Lara',
        'Laura',
        'Lanzelot',
        'Martin',
        'Markus',
        'Maria',
        'Mia',
        'Melanie',
        'Nicole',
        'Nico',
        'Norbert',
        'Ole',
        'Olivia',
        'Olga',
        'Otto',
        'Peter',
        'Petra',
        'Pete',
        'Piere',
        'Quatschkopp',
        'Querin',
        'Ralf',
        'Renate',
        'Regina',
        'Rolf',
        'Rudolf',
        'Sebastian',
        'Sabine',
        'Simon',
        'Simone',
        'Stefan',
        'Stephan',
        'Stephanie',
        'Tim',
        'Tobias',
        'Tamara',
        'Theodor',
        'Ulrich',
        'Ulli',
        'Ulrike',
        'Undine',
        'Veronika',
        'Valerie',
        'Valentin',
        'Volker',
        'Walter',
        'Werner',
        'Xanthippe',
        'Yasmina',
        'Yasmin',
        'Zora',
    ];

    $firstNamesMax = sizeof($firstNames) -1;

    $lastNames = [
        'Mueller',
        'Moeller',
        'Meier',
        'Meyer',
        'Schulze',
        'Schultze',
        'Lehmann',
        'Mustermann',
        'Schmidt',
        'Schmitt',
        'Schmitz',
        'Schneider',
        'Fischer',
        'Hofmann',
        'Hoffmann',
        'Koch',
        'Bauer',
        'Richter',
        'Klein',
        'Wolf',
        'Wolff',
        'Neumann',
        'Schwarz',
        'Schwartz',
        'Schroeder',
        'Schroeter',
        'Zimmermann',
        'Braun',
        'Zimmermann',
        'Krueger',
        'Kroeger',
        'Hartmann',
        'Werner',
        'Jung',
        'Friedrich',
        'Berger',
        'Ludwig',
        'Schumacher',
        'Schuhmacher',
        'Schuster',
        'Brandt',
        'Schulte',
        'Sauer',
        'Voigt',
        'Pfeifer',
        'Pfeiffer',
    ];

    $lastNamesMax = sizeof($lastNames) -1;

    $glue = [
        '',
        '.',
        '_',
        '-',
    ];

    $glueMax = sizeof($glue) -1;


    $mail = $firstNames[rand(0, $firstNamesMax)] . $glue[rand(0, $glueMax)] . $lastNames[rand(0, $lastNamesMax)];

    //decision if lowercase
    if (rand(0,1) == 1) {
        $mail = strtolower($mail);
    }

    //decision if a year is appended
    if (rand(0,1) == 1) {
        //decision if 2 or 4 digits
        if (rand(0,1) == 1) {
            $year = rand(50,99);
        } else {
            $year = rand(1950,2012);
        }

        $mail .= $year;
    }

    $mail .= '@' . $domains[rand(0, $domainsMax)];
    return $mail;
}

function generatePassword($length)
{
    $token        = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789!#$=?<>,.:;-_";

    $max = strlen($codeAlphabet);

    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max - 1)];
    }

    return $token;
}

//$x = 0;
for ($i = PHP_INT_MIN; $i <= PHP_INT_MAX; $i++) {
    $ch = curl_init();

    $mail = generateMail();
    $pw   = generatePassword(rand(5,50));


    echo 'E-Mail: ' . $mail . PHP_EOL . 'Passwd: ' . $pw . PHP_EOL;
/*    $x++;
    if ($x > 5) {
        die('aus die Maus!');
    }
*/
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "u=$mail&p=$pw");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// https://www.proxy-listen.de/Proxy/Proxyliste.html
    $proxyIP       = '178.47.139.50';
    $proxyPort     = '8080';
    $proxyUsername = '';
    $proxyPassword = '';

    if (!empty($proxyIP) && !empty($proxyPort)) {
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL , 1);
        curl_setopt($ch, CURLOPT_PROXY, $proxyIP);
        curl_setopt($ch, CURLOPT_PROXYPORT, $proxyPort);

        if (!empty($proxyUsername) && !empty($proxyPassword)) {
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, "$proxyUsername:$proxyPassword");
        }
    }


    $server_output = curl_exec($ch);

    $info = curl_getinfo($ch);
    echo '--> return HTTP-Code: ' . $info['http_code'] . PHP_EOL . PHP_EOL;

    curl_close($ch);
}
