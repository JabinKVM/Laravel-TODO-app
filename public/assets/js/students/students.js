$(document).ready(function () {

    $(document).on('click', '.edit-student', function () {

        let row = $(this).closest('tr');

        if (row.hasClass('editing')) {
            return;
        }

        row.addClass('editing');

        // Store Original Values

        row.data('name', row.find('.student-name').text().trim());

        row.data('email', row.find('.student-email').text().trim());

        row.data('department', row.find('.student-department').text().trim());

        row.data('status', row.find('.student-status').text().trim());

        // Name

        row.find('.student-name').html(`
            <input type="text"
                   class="form-control form-control-sm edit-name"
                   value="${row.data('name')}">
        `);

        // Email

        row.find('.student-email').html(`
            <input type="email"
                   class="form-control form-control-sm edit-email"
                   value="${row.data('email')}">
        `);

        // Department

        row.find('.student-department').html(`
            <input type="text"
                   class="form-control form-control-sm edit-department"
                   value="${row.data('department')}">
        `);

        // Status

        row.find('.student-status').html(`
            <select class="form-select form-select-sm edit-status">

                <option value="Active">Active</option>

                <option value="Inactive">Inactive</option>

            </select>
        `);

        row.find('.edit-status').val(row.data('status'));

        // Buttons

        row.find('.student-actions').html(`

            <button
                class="btn btn-success btn-sm save-student"
                data-id="${row.data('id')}">

                <i class="fas fa-save"></i>

            </button>

            <button
                class="btn btn-secondary btn-sm cancel-student ms-1">

                <i class="fas fa-times"></i>

            </button>

            <button
                class="btn btn-danger btn-sm delete-student ms-1"
                data-id="${row.data('id')}">

                <i class="fas fa-trash"></i>

            </button>

        `);

    });

});
$(document).ready(function () {

    // ======================================
    // Edit Student
    // ======================================

    $(document).on('click', '.edit-student', function () {

        let row = $(this).closest('tr');

        if (row.hasClass('editing')) {
            return;
        }

        row.addClass('editing');

        // Store original values

        row.data('name', row.find('.student-name').text().trim());

        row.data('email', row.find('.student-email').text().trim());

        row.data('department', row.find('.student-department').text().trim());

        row.data('status', row.find('.student-status').text().trim());

        // Name

        row.find('.student-name').html(`
            <input type="text"
                   class="form-control form-control-sm edit-name"
                   value="${row.data('name')}">
        `);

        // Email

        row.find('.student-email').html(`
            <input type="email"
                   class="form-control form-control-sm edit-email"
                   value="${row.data('email')}">
        `);

        // Department

        row.find('.student-department').html(`
            <input type="text"
                   class="form-control form-control-sm edit-department"
                   value="${row.data('department')}">
        `);

        // Status

        row.find('.student-status').html(`
            <select class="form-select form-select-sm edit-status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        `);

        row.find('.edit-status').val(row.data('status'));

        // Action Buttons

        row.find('.student-actions').html(`

            <button
                class="btn btn-success btn-sm save-student"
                data-id="${row.data('id')}"
                title="Save">

                <i class="fas fa-save"></i>

            </button>

            <button
                class="btn btn-secondary btn-sm cancel-student ms-1"
                title="Cancel">

                <i class="fas fa-times"></i>

            </button>

            <button
                class="btn btn-danger btn-sm delete-student ms-1"
                data-id="${row.data('id')}"
                title="Delete">

                <i class="fas fa-trash"></i>

            </button>

        `);

    });

    // ======================================
    // Cancel Edit
    // ======================================

    $(document).on('click', '.cancel-student', function () {

        let row = $(this).closest('tr');

        let id = row.data('id');

        row.find('.student-name').text(row.data('name'));

        row.find('.student-email').text(row.data('email'));

        row.find('.student-department').text(row.data('department'));

        row.find('.student-status').html(
            row.data('status') === 'Active'
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>'
        );

        row.find('.student-actions').html(`

            <a href="/students/${id}"
               class="btn btn-outline-secondary btn-sm"
               title="View Student">

                <i class="fas fa-eye"></i>

            </a>

            <button
                class="btn btn-outline-secondary btn-sm edit-student"
                data-id="${id}"
                title="Edit Student">

                <i class="fas fa-pencil-alt"></i>

            </button>

        `);

        row.removeClass('editing');

    });
    // ======================================
// Save Student
// ======================================

$(document).on('click', '.save-student', function () {

    let row = $(this).closest('tr');

    let id = row.data('id');

    $.ajax({

        url: '/students/' + id + '/inline-update',

        type: 'PUT',

        data: {

            _token: $('meta[name="csrf-token"]').attr('content'),

            name: row.find('.edit-name').val(),

            email: row.find('.edit-email').val(),

            department: row.find('.edit-department').val(),

            status: row.find('.edit-status').val()

        },

        success: function (response) {

            row.find('.student-name').text(response.student.name);

            row.find('.student-email').text(response.student.email);

            row.find('.student-department').text(response.student.department);

            row.find('.student-status').html(

                response.student.status === 'Active'

                ? '<span class="badge bg-success">Active</span>'

                : '<span class="badge bg-danger">Inactive</span>'

            );

            row.find('.student-actions').html(`

                <a href="/students/${response.student.id}"
                   class="btn btn-outline-secondary btn-sm">

                    <i class="fas fa-eye"></i>

                </a>

                <button
                    class="btn btn-outline-secondary btn-sm edit-student"
                    data-id="${response.student.id}">

                    <i class="fas fa-pencil-alt"></i>

                </button>

            `);

            row.removeClass('editing');

            alert(response.message);

        },

        error: function () {

            alert('Unable to update student.');

        }

    });

});

});