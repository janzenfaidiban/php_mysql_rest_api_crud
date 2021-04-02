<?php 

$api_url = "http://localhost/api/api/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if(!empty($result) && count($result) > 0)
{
    $no = 1;
    foreach($result as $row)
    {
        $output .= "
            <tr>
                <td class='text-center'>".$no."</td>
                <td>".$row->first_name."</td>
                <td>".$row->last_name."</td>
                <td>".$row->email."</td>
                <td class='text-center'>
                    <a href='#' name='edit' class='btn btn-sm btn-dark text-primary bg-dark btn-xs edit' id='".$row->id."'><i class='fas fa-edit'></i></a>
                    <a href='#' name='delete' class='btn btn-sm btn-dark btn-xs text-danger bg-dark delete' id='".$row->id."'><i class='fas fa-times-circle'></i></a>
                </td>
            </tr>
        ";
    $no++;
    }
}
else 
{
  $output .= "
    <tr>
        <td colspan='5' align='center'>No Data Found</td>
    </tr>
  ";  
}

echo $output;

?>