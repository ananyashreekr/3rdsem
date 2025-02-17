<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['lns'])) {
    // Get the USN from the POST request
    $usn = $_POST['lns'];

    // Assuming the PDF filename is the same as the USN with a .pdf extension
    $pdfPath = 'results/' . $usn . '.pdf'; // Updated folder name to 'results'

    // Check if the PDF file exists
    if (file_exists($pdfPath)) {
        $resultMessage = "Result for USN: " . htmlspecialchars($usn) . " is available.";
        $pdfDisplay = $pdfPath; // Set the path for PDF to display
    } else {
        $resultMessage = "No result found for USN: " . htmlspecialchars($usn);
        $pdfDisplay = ""; // No PDF to display
    }
} else {
    // If form was not submitted, redirect to index.php
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>VTU Result 2025</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/css/bootstrap.min.css">
    <style>
        body {
            background: #f0f0f0;
        }
        .header {
            background: #494e54;
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-height: 120px;
        }
        .result-container {
            background: #fff;
            box-shadow: 0px 0px 10px 0px #888888;
            padding: 20px;
            margin-top: 20px;
        }
        .panel-heading {
            background-color: #68d37b99 !important;
            color: #0e1819 !important;
            font-size: 14pt;
            text-align: center;
        }
        .alert {
            text-align: center;
        }
        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="newL7.png" alt="VTU Logo" class="img-responsive">
    </div>
    <div class="container result-container">
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($resultMessage)) { ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <b>Result for USN: <?php echo htmlspecialchars($usn); ?></b>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-info">
                                <strong><?php echo $resultMessage; ?></strong>
                            </div>
                            <?php if ($pdfDisplay != "") { ?>
                                <!-- Display PDF using an iframe -->
                                <iframe src="<?php echo $pdfDisplay; ?>"></iframe>
                            <?php } else { ?>
                                <div class="alert alert-danger">
                                    <strong>No PDF result found.</strong>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger">
                        <strong>Error:</strong> No result found for the given USN.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
