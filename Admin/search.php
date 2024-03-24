 <?php

include "../connect.php";
$search_keyword = $_POST['search'];
$searchLength = strlen($search_keyword);
$data = array();
$sql = "SELECT * FROM tbl_registration WHERE LEFT(email, $searchLength) = LEFT('$search_keyword', $searchLength)";

if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
}

echo json_encode($data);
?>
