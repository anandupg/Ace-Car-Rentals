<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aadhar Number Validation</title>
</head>
<body>
    <div class="form-group">
        <label for="aadharNumber">Aadhar Number:</label>
        <input type="text" class="form-control" id="aadharNumber" name="aadharNumber" required>
        <small id="message" class="form-text text-muted"></small>
    </div>

    <script type="text/javascript"> 
        /* multiplication table */
        const d = [
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
        ]

        /* permutation table */
        const p = [
            [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]
        ]

        /* validates Aadhar number received as string */
        function validate(aadharNumber) {
            let c = 0
            let invertedArray = aadharNumber.split('').map(Number).reverse()

            invertedArray.forEach((val, i) => {
                c = d[c][p[(i % 8)][val]]
            })

            return (c === 0)
        }

        function verify() {
            var message = document.getElementById("message");
            var aadharNo = document.getElementById("aadharNumber").value;
            if(validate(aadharNo)) {
                message.innerHTML = 'Your Aadhar card number is valid';
            } else {
                message.innerHTML = 'Your Aadhar card number is not valid';
            }
        }

        // Add event listener for live verification
        document.getElementById("aadharNumber").addEventListener("input", verify);
    </script>
</body>
</html>
