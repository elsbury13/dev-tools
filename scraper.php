<?php

/* Defining the basic cURL function
* @param string $url passed into for Curl
* @return array of data from curl request
*/
function curl($url)
{
    // Assigning cURL options to an array
    $options = [
        // Setting cURL's option to return the webpage data
        CURLOPT_RETURNTRANSFER => true,
        // Setting cURL to follow 'location' HTTP headers
        CURLOPT_FOLLOWLOCATION => true,
        // Automatically set the referer where following 'location' HTTP headers
        CURLOPT_AUTOREFERER => true,
        // Setting the amount of time (in seconds) before the request times out
        CURLOPT_CONNECTTIMEOUT => 120,
        // Setting the maximum amount of time for cURL to execute queries
        CURLOPT_TIMEOUT => 120,
        // Setting the maximum number of redirections to follow
        CURLOPT_MAXREDIRS => 10,
        // Setting the useragent
        CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8",
        // Setting cURL's URL option with the $url variable passed into the function
        CURLOPT_URL => $url,
    ];

    $ch = curl_init();
    // Setting cURL's options using the previously assigned array data in $options
    curl_setopt_array($ch, $options);
    // Executing the cURL request and assigning the returned data to the $data variable
    $data = curl_exec($ch);
    // Closing cURL
    curl_close($ch);
    // Returning the data from the function
    return $data;
}

/*
* Defining the basic scraping function
* @param array $data passed into from the Curl() function
* @param string $start div for scrape
* @param string $end div for scrape
* @return array of data from curl request
*/
function scrapeBetween($data, $start, $end)
{
    // Stripping all data from before $start
    $data = stristr($data, $start);
    // Stripping $start
    $data = substr($data, strlen($start));
    // Getting the position of the $end of the data to scrape
    $stop = stripos($data, $end);
    // Stripping all data from after and including the $end of the data to scrape
    $data = substr($data, 0, $stop);
    // Returning the scraped data from the function
    return $data;
}

echo scrapeBetween(
    curl('https://github.com/elsbury13'),
    '<div class="js-pinned-repos-reorder-container">',
    '<div class="js-contribution-graph">'
);
