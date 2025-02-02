$(document).ready(function() {

    if (!employeeId) {
        console.error("Employee ID is missing.");
        return;
    }

    if (!schedules || schedules.length === 0) {
        console.warn("No schedule data available.");
        return;
    }

    $('.name').append(' - Schedule');

    const tableBody = $('#schedule tbody');
    tableBody.empty();

    const currentDay = new Intl.DateTimeFormat('en-US', { weekday: 'short' }).format(new Date()).toUpperCase();

    const dayMapping = {
        MTH: ['MON', 'THU'],
        TF: ['TUE', 'FRI']
    };

    const isMatchingDay = (scheduleDays, targetDay) => {
        return scheduleDays.includes(targetDay) ||
            Object.keys(dayMapping).some(key =>
                scheduleDays.includes(key) && dayMapping[key].includes(targetDay)
            );
    };

    const todaysSchedules = schedules.filter(item => isMatchingDay(item.days, currentDay));

    if (todaysSchedules.length > 0) {
        todaysSchedules.forEach(item => {
            const row = $('<tr>');
            row.append(`<td>${item.days}</td>`);
            row.append(`<td>${item.room}</td>`);
            row.append(`<td>${item.section}</td>`);
            row.append(`<td>${item.time_start}</td>`);
            row.append(`<td>${item.time_end}</td>`);
            row.append(`<td>${item.code}</td>`);
            row.append(`<td>${item.description}</td>`);

            const currentDate = new Date();
            const currentDateString = currentDate.toISOString().split('T')[0];

            const isTimedIn = attendance && attendance.some(att => att.schedule_id === item.id);
            const actionColumn = $('<td>');

            if (isTimedIn) {
                actionColumn.append(`<span class="text-success">Already Timed In</span>`);
            } else {
                actionColumn.append(`<button type="button" class="btn btn-primary" id="timeIn"
                    data-bs-toggle="modal"
                    data-bs-target="#cameraModal"
                    data-employee-id="${employeeId}"
                    data-schedule-id="${item.id}"
                    data-room="${item.room}"
                    data-days="${item.days}"
                    data-section="${item.section}"
                    data-schedule="${item.days}, ${item.time_start} - ${item.time_end}"
                    data-subject-code="${item.code}"
                    data-subject-description="${item.description}"
                >Time In</button>`);
            }

            row.append(actionColumn);
            tableBody.append(row);
        });
    } else {
        const noDataRow = $('<tr>');
        noDataRow.append(`<td colspan="8" class="text-center">No schedule available for ${currentDay}.</td>`);
        tableBody.append(noDataRow);
    }

    $('#justificationModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var instructorId = button.data('employee-id');
        var scheduleId = button.data('schedule-id');

        $('input[name="instructor_id"]').val(instructorId);
        $('input[name="schedule_id"]').val(scheduleId);

        if (instructorId && scheduleId) {
            let routeUrl = `/user/schedule/${employeeId}/justification/${scheduleId}`;
            $('#justificationForm').attr('action', routeUrl);
        } else {
            console.error("Missing employeeId or scheduleId");
        }
    });

    $('#cameraModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var employeeId = button.data('employee-id');
        var scheduleId = button.data('schedule-id');
        var room = button.data('room');
        var days = button.data('days');
        var section = button.data('section');
        var schedule = button.data('schedule');
        var subjectCode = button.data('subject-code');
        var subjectDescription = button.data('subject-description');

        $('input[name="instructor_id"]').val(employeeId);
        $('input[name="schedule_id"]').val(scheduleId);
        $('input[name="room"]').val(room);
        $('input[name="days"]').val(days);
        $('input[name="section"]').val(section);
        $('input[name="schedule"]').val(schedule);
        $('input[name="subject_code"]').val(subjectCode);
        $('input[name="description"]').val(subjectDescription);

        if (employeeId && scheduleId) {
            let routeUrl = `/user/schedule/${employeeId}/upload/${scheduleId}`;
            $('#cameraForm').attr('action', routeUrl);
        } else {
            console.error("Missing employeeId or scheduleId");
        }
    });
});
