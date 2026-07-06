$(function () {

    InlineEditor.init({

        module: "task",

        table: "#tasksTable",

        editButton: ".edit-task",

        modal: "#taskActionModal",

        updateUrl: function (id) {
            return "/tasks/" + id + "/inline-update";
        },

        deleteUrl: function (id) {
            return "/tasks/" + id + "/ajax-delete";
        }

    });

});