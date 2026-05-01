<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Calendar to track tasks">
    <link rel="stylesheet" href="style.css" />
    <title>Calendar</title>
</head>

<body>

    <header>
        <h1>Your Calendar</h1>
    </header>

    <div class="clock_container">
        <div id="clock"></div>
    </div>

    <!-- Calendar Section -->
    <div class="calendar">
        <div class="nav-btn-container">
            <button class="nav-btn"></button>
            <h2 id="monthYear"></h2>
            <button class="nav-btn"></button>
        </div>

        <div class="calendar-grid" id="calendar"></div>
    </div>

    <!-- Modal for Add/Edit/Delete Appointment -->
    <div class="modal" id="eventModal">
        <div class="modal-content">
            <div id="eventSelectorWrapper">
                <label for="eventSelector">
                    <strong>Select Event:</strong>
                </label>
                <select id="eventSelector">
                    <option disabled selected>Choose Event...</option>
                </select>
            </div>

            <!-- Main Form -->
            <form id="eventForm" method="post">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="event_id" id="eventId">

                <label for="courseName">Course Title:</label>
                <input type="text" name="course_name" id="courseName" required>

                <label for="instructorName">Instructor Name:</label>
                <input type="text" name="instructor_name" id="instructorName" required>

                <label for="startDate">Start Date:</label>
                <input type="date" name="start_date" id="startDate" required>

                <label for="endDate">End Date:</label>
                <input type="date" name="end_date" id="endDate" required>

                <input type="submit" value="Save">
            </form>

            <!-- Delete Form -->
            <form action="" method="post">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="event_id" id="deleteEventId">
                <input type="submit" class="submit-btn" value="Delete">
            </form>

            <!-- Cancel -->
            <input type="button" class="submit-btn" value="Cancel">
        </div>
    </div>
</body>

</html>