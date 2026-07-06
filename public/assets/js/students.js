$(document).ready(function () {
    // =====================================
    // Modal Variables
    // =====================================

    let studentAction = "";

    let currentRow = null;

    const studentModal = new bootstrap.Modal(
        document.getElementById("studentActionModal")
    );
    // ==========================================
    // Edit Student
    // ==========================================

    $(document).on("click", ".edit-student", function () {

        let row = $(this).closest("tr");

        if (row.hasClass("editing")) {
             return;
        }

        row.addClass("editing");

        let id = row.data("id");

         row.data("name", row.find(".student-name").text().trim());

         row.data("email", row.find(".student-email").text().trim());

        row.data("department", row.find(".student-department").text().trim());

        row.data("status", row.find(".student-status").text().trim());

         row.find(".student-name").html(
            `<input class="form-control form-control-sm edit-name"
                 value="${row.data("name")}">`
        );

        row.find(".student-email").html(
            `<input class="form-control form-control-sm edit-email"
                 value="${row.data("email")}">`
        );

        row.find(".student-department").html(
             `<input class="form-control form-control-sm edit-department"
                    value="${row.data("department")}">`
        );

        row.find(".student-status").html(

            `<select class="form-select form-select-sm edit-status">

                <option value="Active">Active</option>

                 <option value="Inactive">Inactive</option>

            </select>`

        );

        row.find(".edit-status").val(row.data("status"));

        row.find(".student-actions").html(`

            <button
                 class="btn btn-success btn-sm save-student"
                 data-id="${id}">

                <i class="fas fa-save"></i>

        </button>

        <button
            class="btn btn-secondary btn-sm cancel-student">

            <i class="fas fa-times"></i>

        </button>

        <button
            class="btn btn-danger btn-sm delete-student"
            data-id="${id}">

            <i class="fas fa-trash"></i>

        </button>

    `);

});
    // =====================================
    // Cancel Student
    // =====================================

    $(document).on("click", ".cancel-student", function () {

        currentRow = $(this).closest("tr");

        studentAction = "cancel";

        $("#studentModalTitle").text("Discard Changes");

        $("#studentModalMessage").html(

         "Are you sure you want to discard the changes?<br><br><strong>All unsaved changes will be lost.</strong>"

        );

        $("#confirmStudentAction")
            .removeClass("btn-primary btn-danger")
            .addClass("btn-warning")
            .text("Discard Changes");

            studentModal.show();

        });

        // =====================================
// Save Student
// =====================================

$(document).on("click", ".save-student", function () {

    currentRow = $(this).closest("tr");

    studentAction = "save";

    $("#studentModalTitle").text("Save Changes");

    $("#studentModalMessage").html(
        "Are you sure you want to save these changes?"
    );

    $("#confirmStudentAction")
        .removeClass("btn-warning btn-danger")
        .addClass("btn-primary")
        .text("Save");

    studentModal.show();

});

// =====================================
// Delete Student
// =====================================

$(document).on("click", ".delete-student", function () {

    currentRow = $(this).closest("tr");

    studentAction = "delete";

    $("#studentModalTitle").text("Delete Student");

    $("#studentModalMessage").html(
        "Are you sure you want to delete this student?<br><br><strong>This action cannot be undone.</strong>"
    );

    $("#confirmStudentAction")
        .removeClass("btn-primary btn-warning")
        .addClass("btn-danger")
        .text("Delete");

    studentModal.show();

});
   // =====================================
// Confirm Student Action
// =====================================

$("#confirmStudentAction").click(function () {

    studentModal.hide();

    switch (studentAction) {

        case "cancel":
            restoreRow(currentRow);
            break;

        case "save":
            saveStudent(currentRow);
            break;

        case "delete":
            deleteStudent(currentRow);
            break;

    }

});

    // ==========================================
    // Restore Row
    // ==========================================

    function restoreRow(row) {

        let id = row.data("id");

        row.find(".student-name").text(row.data("name"));

         row.find(".student-email").text(row.data("email"));

        row.find(".student-department").text(row.data("department"));

        if (row.data("status") === "Active") {

            row.find(".student-status").html(
                '<span class="badge bg-success">Active</span>'
        );

        } else {

            row.find(".student-status").html(
                 '<span class="badge bg-danger">Inactive</span>'
            );

        }

            row.find(".student-actions").html(`

            <a href="/students/${id}"
                 class="btn btn-outline-secondary btn-sm">

                <i class="fas fa-eye"></i>

            </a>

            <button
                class="btn btn-outline-secondary btn-sm edit-student"
                data-id="${id}">

                <i class="fas fa-pencil-alt"></i>

        </button>

      `);

        row.removeClass("editing");

        }
        // =====================================
// Save Student
// =====================================

function saveStudent(row) {

    let id = row.data("id");

    $.ajax({

        url: "/students/" + id + "/inline-update",

        type: "PUT",

        data: {

            _token: $('meta[name="csrf-token"]').attr("content"),

            name: row.find(".edit-name").val(),

            email: row.find(".edit-email").val(),

            department: row.find(".edit-department").val(),

            status: row.find(".edit-status").val()

        },

        success: function (response) {

            row.data("name", response.student.name);

            row.data("email", response.student.email);

            row.data("department", response.student.department);

            row.data("status", response.student.status);

            restoreRow(row);

            showAlert("success", response.message);

        },

        error: function () {

            showAlert("danger", "Unable to update student.");

        }

    });

    
}

// =====================================
// Delete Student
// =====================================

function deleteStudent(row) {

    let id = row.data("id");

    $.ajax({

        url: "/students/" + id + "/ajax-delete",

        type: "DELETE",

        data: {

            _token: $('meta[name="csrf-token"]').attr("content")

        },

        success: function (response) {

            row.fadeOut(300, function () {

                $(this).remove();

            });

            showAlert("success", response.message);

        },

        error: function () {

            showAlert("danger", "Unable to delete student.");

        }

    });

}

// =====================================
// Bootstrap Alert
// =====================================

function showAlert(type, message) {

    $(".student-alert").remove();

    $(".page-title-box").after(`

        <div class="alert alert-${type} alert-dismissible fade show student-alert">

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