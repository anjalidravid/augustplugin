<?php 
global $wpdb;

$query = "
    SELECT
        c.name AS customer_name,
        s.name AS salesman_name,
        c.city AS customer_city,
        s.city AS salesman_city
    FROM
        {$wpdb->prefix}customer c
    JOIN
        {$wpdb->prefix}salesman s ON c.salesman_id = s.id
    WHERE
        c.city <> s.city;
";

$results = $wpdb->get_results($query);

foreach ($results as $result) {
    echo 'Customer Name: ' . $result->customer_name . '<br>';
    echo 'Salesman Name: ' . $result->salesman_name . '<br>';
    echo 'Customer City: ' . $result->customer_city . '<br>';
    echo 'Salesman City: ' . $result->salesman_city . '<br>';
    echo '<hr>';
}
