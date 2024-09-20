<?php
function send_data_via_api($formData)
{

    $curl_initiliaze    =   curl_init('http://localhost/app/api/insert.php');
    curl_setopt($curl_initiliaze, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_initiliaze, CURLOPT_POST, true);
    curl_setopt($curl_initiliaze, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer 0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
    ]);
    curl_setopt($curl_initiliaze, CURLOPT_POSTFIELDS, json_encode($formData));

    $response = curl_exec($curl_initiliaze);
    curl_close($curl_initiliaze);

    return $response;
}

function get_data_via_api()
{
    $curl_initialize = curl_init('http://localhost/app/api/retrieve.php');
    curl_setopt($curl_initialize, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_initialize, CURLOPT_POST, true);
    curl_setopt($curl_initialize, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($curl_initialize);
    curl_close($curl_initialize);

    $data = json_decode($response);
    if ($data && $data->status) {
        $rows = '';
        $counter    =   1;
        foreach ($data->data as $item) {
            $rows .= "<tr>
                        <th scope='row'>$counter</th>
                        <td>{$item->name}</td>
                        <td>{$item->email}</td>
                        <td>{$item->gender}</td>
                        <td>{$item->subjects}</td>
                        <td>{$item->message}</td>
                      </tr>";
            $counter++;
        }
        return $rows;
    } else {
        return "<tr><td colspan='6'>No data found.</td></tr>";
    }
}
