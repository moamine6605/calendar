<?php include "connection.php";

    $successMsg = '';
    $errorMsg = '';

    $eventsFromDB = []; // Initialize a new array to store the fetched events

    # Handle Add Appointment
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'add'){
        $course = trim($_POST['course_name'] ?? "");
        $instructor = trim($_POST['instructor_name'] ?? "");
        $start = $_POST['start_date'] ?? "";
        $end = $POST["end_date"] ?? "";

        if($course && $instructor && $start && $end){
            $stmt = $conn->prepare(
                "INSERT INTO appointments (course_name, instructor_name, start_date, end_date) VALUES(?, ?, ?, ?, ?)"
            );

            $stmt->bind_param("ssss", $course, $instructor, $start, $end);

            $stmt->close();

            header("Location: " . $_SERVER["PHP_SELF"] . "?success=1");
            exit;
        } else {
            header("Location: " . $_SERVER["PHP_SELF"] . "?error=1");
        }
    }

    # handle Edit Appointemnt
    if($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST['action'] ?? '') === 'edit'){
        $id = $_POST["event_id"] ?? null;
        $course = trim($_POST['course_name'] ?? "");
        $instructor = trim($_POST['instructor_name'] ?? "");
        $start = $_POST['start_date'] ?? "";
        $end = $POST["end_date"] ?? "";


        if($id && $course && $instructor && $start && $end){

            $stmt = $conn->prepare(
                "UPDATE appointments SET course_name = ?, instructor_name = ?, start_date = ?, end_date = ? WHERE id = ?"
            );

            $stmt->bind_param("sssss", $course, $instructor, $start, $end, $id);

            $stmt->execute();

            $stmt->close();

            header("Location: " . $_SERVER["PHP_SELF"] . "?success=2");
            exit;

        } else {
            header("Location: " . $_SERVER["PHP_SELF"] . "?error=2");
            exit;
        }
    }

    # handle Delete Appointemnt
    if($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST['action'] ?? '') === 'delete'){
    $id = $_POST["event_id"] ?? null;


        if($id){

            $stmt = $conn->prepare(
                "DELETE appointments WHERE id = ?"
            );

            $stmt->bind_param("s", $id);

            $stmt->execute();

            $stmt->close();

            header("Location: " . $_SERVER["PHP_SELF"] . "?success=3");
            exit;

        } else {
            header("Location: " . $_SERVER["PHP_SELF"] . "?error=3");
            exit;
        }
    }

    # Success & Error messages
    if(isset($_GET["success"])){
        $successMsg = match($_GET["success"]) {
            '1' => 'Appointemnt added successfully',
            '2' => 'Appointemnt updated successfully',
            '3' => 'Appointemnt deleted successfully',
            default => ""
        };
    }

    if(isset($_GET["error"])){
        $errorMsg = " Error occured. Please check your input";
    }

    $result = $conn->query("SELECT * FROM appointments");
    if($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $start = new DateTime($row["start_date"]);
            $end = new DateTime($row["end_date"]);

            while($start<=$end) {
                $eventsFromDB[] = [
                    'id' => $row["id"],
                    'title' => "{$row["course_name"]} - {$row["instructor_name"]}",
                    'date' => $start->format("Y-m-d"),
                    'start' => $row["start_date"],
                    'end' => $row["end_date"]
                ];

                $start->modify('+1. day');
            }
        }
    }

$conn->close();


?>