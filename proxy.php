<?php
// Get the URL from the query parameter
$url = isset($_GET['url']) ? $_GET['url'] : '';

if (filter_var($url, FILTER_VALIDATE_URL)) {
    // Initialize a cURL session
    $ch = curl_init();

    // Set the URL to fetch
    curl_setopt($ch, CURLOPT_URL, $url);

    // Return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // Set additional headers to simulate a browser request
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Execute the cURL session
    $output = curl_exec($ch);

    // Get the content type of the response
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

    // Close the cURL session
    curl_close($ch);

    // Set the content type of the response
    header("Content-Type: $contentType");

    // Output the response
    echo $output;
} else {
    echo 'Invalid URL';
}
?>
