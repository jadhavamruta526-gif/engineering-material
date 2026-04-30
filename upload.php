<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// Define all years and subjects
$allSubjects = [
    "FE" => ["Engineering Mathematics I", "Physics", "Chemistry", "Basic Electrical Engineering", "Engineering Mechanics", "Workshop",
             "Engineering Mathematics II","Basic Electronics Engineering","Problem Solving & Programming in Python","Engineering Graphics","Communication Skills"],
    "SE" => ["Discrete Mathematics","Data Structures & Algorithms","Computer Organization","Digital Electronics","OOP using Java",
             "Theory of Computation","Computer Networks","Database Management Systems","Operating Systems","Software Engineering"],
    "TE" => ["Machine Learning","Internet of Things","Web Technology","System Programming","Cyber Security",
             "Cloud Computing","Artificial Intelligence","Information & Network Security","Human Computer Interaction","Elective: Data Science"],
    "BE" => ["Data Analytics","Blockchain Technology","Deep Learning","Project Stage I","Elective: DevOps",
             "Distributed Systems","Mobile Application Development","Cloud Native Applications","Project Stage II","Elective: NLP"]
];

$message = "";
if(isset($_POST['submit'])){
    $year = $_POST['year'];
    $subject = $_POST['subject'];

    // Create year folder if it doesn't exist
    $targetDir = "uploads/$year/";
    if(!is_dir($targetDir)){
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["file"]["name"]);
    $targetFile = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Allow only PDF
    if($fileType != "pdf"){
        $message = "Only PDF files are allowed!";
    } else {
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)){
            $message = "File uploaded successfully!";
        } else {
            $message = "Error uploading file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Notes</title>
</head>
<body>
<h2>Upload Notes PDF</h2>

<?php if($message) echo "<p>$message</p>"; ?>

<form method="post" enctype="multipart/form-data">
    <label>Select Year:</label>
    <select name="year" required>
        <option value="">--Select Year--</option>
        <?php foreach($allSubjects as $yearName => $subj) echo "<option value='$yearName'>$yearName</option>"; ?>
    </select>
    <br><br>

    <label>Select Subject:</label>
    <select name="subject" required>
        <option value="">--Select Subject--</option>
        <?php foreach($allSubjects as $yearName => $subjArr){
            foreach($subjArr as $subj){
                echo "<option value='".str_replace(" ","_",$subj)."'>$subj</option>";
            }
        } ?>
    </select>
    <br><br>

    <label>Select PDF:</label>
    <input type="file" name="file" accept="application/pdf" required>
    <br><br>

    <input type="submit" name="submit" value="Upload">
</form>

<a href="subjects.php">Back to Subjects</a>
</body>
</html>
