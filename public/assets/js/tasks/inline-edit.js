
$(function () {
    // ==========================================
// Task Confirmation Modal Variables
// ==========================================

let taskAction = null;
let currentRow = null;
let currentTaskId = null;

const taskModal = new bootstrap.Modal(
    document.getElementById('taskActionModal')
);

    // ===========================
    // Edit Task
    // ===========================

    $(document).on('click', '.edit-task', function () {

        let row = $(this).closest('tr');

        if (row.hasClass('editing')) {
            return;
        }

        row.addClass('editing');

        let id = row.data('id');

        let title = row.find('.task-title').text().trim();
        let priority = row.find('.task-priority').text().trim();
        let status = row.find('.task-status').text().trim();

        row.data({
            title: title,
            priority: priority,
            status: status
        });

        row.find('.task-title').html(`
            <input
                type="text"
                class="form-control form-control-sm edit-title"
                value="${title}">
        `);

        row.find('.task-priority').html(`
            <select class="form-select form-select-sm edit-priority">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        `);

        row.find('.edit-priority').val(priority);

        row.find('.task-status').html(`
            <select class="form-select form-select-sm edit-status">
                <option value="0">Pending</option>
                <option value="1">Completed</option>
            </select>
        `);

        row.find('.edit-status').val(
            status === 'Completed' ? '1' : '0'
        );

        row.find('.task-actions').html(`
            <button
                class="btn btn-success btn-sm save-task"
                data-id="${id}"
                title="Save">

                <i class="fas fa-save"></i>

            </button>

            <button
                class="btn btn-secondary btn-sm cancel-task ms-1"
                title="Cancel">

                <i class="fas fa-times"></i>

            </button>

            <button
                class="btn btn-danger btn-sm delete-task ms-1"
                data-id="${id}"
                title="Delete">

                <i class="fas fa-trash"></i>

            </button>
        `);

    });

    // ===========================
    // Cancel Edit
    // ===========================

    $(document).on('click', '.cancel-task', function () {

        let row = $(this).closest('tr');

        restoreRow(row);

    });

    // ===========================
    // Save Task
    // ===========================
        $(document).on('click', '.save-task', function () {

    currentRow = $(this).closest('tr');

    currentTaskId = currentRow.data('id');

    taskAction = "save";

    $('#taskModalTitle').text("Update Task");

    $('#taskModalMessage').text(
        "Are you sure you want to save the changes?"
    );

    $('#confirmTaskAction')
        .removeClass('btn-danger')
        .addClass('btn-primary')
        .text('Save');

    taskModal.show();

});
    

    // ===========================
    // Delete Task
    // ===========================

    $(document).on('click', '.delete-task', function () {

    currentRow = $(this).closest('tr');

    currentTaskId = currentRow.data('id');

    taskAction = "delete";

    $('#taskModalTitle').text("Delete Task");

    $('#taskModalMessage').text(
        "Are you sure you want to delete this task?"
    );

    $('#confirmTaskAction')
        .removeClass('btn-primary')
        .addClass('btn-danger')
        .text('Delete');

    taskModal.show();

});
    // ===========================
    // Restore Row
    // ===========================

    function restoreRow(row) {

        let id = row.data('id');

        row.find('.task-title').text(row.data('title'));

        row.find('.task-priority').text(row.data('priority'));

        row.find('.task-status').text(row.data('status'));

        row.find('.task-actions').html(editButton(id));

        row.removeClass('editing');

    }

    // ===========================
    // Edit Button
    // ===========================

    function editButton(id) {

        return `
            <button
                class="btn btn-outline-secondary btn-sm edit-task"
                data-id="${id}"
                title="Edit">

                <i class="fas fa-pencil-alt"></i>

            </button>
        `;

    }
        // ==========================================
// Confirm Task Action
// ==========================================

$('#confirmTaskAction').on('click', function () {

    taskModal.hide();

    if (taskAction === "save") {

        saveTask(currentRow);

    }

    if (taskAction === "delete") {

        deleteTask(currentRow);

    }

});


// ==========================================
// Save Task Function
// ==========================================

function saveTask(row) {

    let id = row.data('id');

    $.ajax({

        url: '/tasks/' + id + '/inline-update',

        type: 'PUT',

        data: {

            _token: $('meta[name="csrf-token"]').attr('content'),

            title: row.find('.edit-title').val(),

            priority: row.find('.edit-priority').val(),

            completed: row.find('.edit-status').val()

        },

        success: function (response) {

            row.find('.task-title').text(response.task.title);

            row.find('.task-priority').text(response.task.priority);

            row.find('.task-status').text(

                response.task.completed

                ? 'Completed'

                : 'Pending'

            );

            row.find('.task-actions').html(editButton(response.task.id));

            row.removeClass('editing');

            showTaskAlert('success', response.message);

        },

        error: function () {

            showTaskAlert('danger', 'Unable to update task.');

        }

    });

}


// ==========================================
// Delete Task Function
// ==========================================

function deleteTask(row) {

    let id = row.data('id');

    $.ajax({

        url: '/tasks/' + id + '/ajax-delete',

        type: 'DELETE',

        data: {

            _token: $('meta[name="csrf-token"]').attr('content')

        },

        success: function (response) {

            row.fadeOut(300, function () {

                $(this).remove();

            });

            showTaskAlert('success', response.message);

        },

        error: function () {

            showTaskAlert('danger', 'Unable to delete task.');

        }

    });

}


// ==========================================
// Bootstrap Alert
// ==========================================

function showTaskAlert(type, message) {

    $('.task-alert').remove();

    $('.page-title-box').after(`

        <div class="alert alert-${type} alert-dismissible fade show task-alert">

            ${message}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    `);

}
});