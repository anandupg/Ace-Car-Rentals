<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Selection Example</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<div class="d-flex">
    <div class="form-group mr-2">
        <label for="" class="label">Pick-up date</label>
        <input type="text" class="form-control" id="book_pick_date" placeholder="Date">
    </div>
    <div class="form-group ml-2">
        <label for="" class="label">Drop-off date</label>
        <input type="text" class="form-control" id="book_off_date" placeholder="Date">
    </div>
</div>

<script>
    $(document).ready(function () {
        // Initialize datepicker for pick-up date
        $("#book_pick_date").datepicker({
            onSelect: function (date) {
                // Set the minimum date for drop-off date to the selected pick-up date + 1 day
                var selectedDate = new Date(date);
                selectedDate.setDate(selectedDate.getDate() + 1);
                $("#book_off_date").datepicker("option", "minDate", selectedDate);
            }
        });

        // Initialize datepicker for drop-off date
        $("#book_off_date").datepicker();
    });
</script>

<!-- Include jQuery UI for datepicker -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>
</html>
