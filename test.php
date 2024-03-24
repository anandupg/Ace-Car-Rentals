<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    Search<input type="text" id="search">
    <table>
        <tbody id="resultBody"></tbody>
    </table>
</body>
<script>
    document.getElementById('search').addEventListener('input', function () {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'search.php')
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        var search = document.getElementById('search').value;
        var tableBody = document.getElementById('resultBody');
        xhr.send("search=" + search)
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    tableBody.innerHTML = '';

                    for (var i = 0; i < data.length; i++) {
                        var row = '<tr><td>' + data[i].reg_id + '</td><td>' + data[i].login_id + '</td><td>' + data[i].fname + '</td><td>' + data[i].lname + '</td><td>' + data[i].email + '</td><td>' + data[i].phone + '</td><td>' + data[i].dob + '</td><td>' + data[i].status + '</td>' +
                            '<form action="" method="post">' +
                            '<input type="hidden" name="reg_id" value="' + data[i].reg_id + '">' +
                            
                            '</form>' +
                            '</td><td>' +
                            '<form action="#" method="post">' +
                            '<input type="hidden" name="reg_id" value="' + data[i].reg_id + '">';

                        var statusBtnValue = data[i].ad_status == 1 ? 'Disable' : 'Enable';

                        row += '<input type="submit" value="' + statusBtnValue + '" name="' + (statusBtnValue.toLowerCase()) + '">' +
                            '</form>' +
                            '</td></tr>';
                        tableBody.innerHTML += row;

                    }
                }
            }
        }
    })
</script>

</html>