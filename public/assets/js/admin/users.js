$(document).ready(function () {

    let userId = null;
    let action = null;

    // -------------------------
    // Open Block Modal
    // -------------------------
    $(document).on('click', '.block-user', function () {

        userId = $(this).data('id');
        action = 'block';

        $('#selectedUserId').val(userId);
        $('#selectedAction').val(action);

        $('#userActionModalLabel').text('Block User');

        $('#userActionMessage').text(
            'Are you sure you want to block this user?'
        );

        $('#confirmUserAction')
            .removeClass('btn-success')
            .addClass('btn-danger')
            .text('Block User');

        $('#userActionModal').modal('show');

    });

    // -------------------------
    // Open Unblock Modal
    // -------------------------
    $(document).on('click', '.unblock-user', function () {

        userId = $(this).data('id');
        action = 'unblock';

        $('#selectedUserId').val(userId);
        $('#selectedAction').val(action);

        $('#userActionModalLabel').text('Unblock User');

        $('#userActionMessage').text(
            'Are you sure you want to unblock this user?'
        );

        $('#confirmUserAction')
            .removeClass('btn-danger')
            .addClass('btn-success')
            .text('Unblock User');

        $('#userActionModal').modal('show');

    });

    // -------------------------
    // Confirm Button
    // -------------------------
    $('#confirmUserAction').click(function () {

        let id = $('#selectedUserId').val();

        let action = $('#selectedAction').val();

        let url = '/admin/users/' + id + '/' + action;

        $.ajax({

            url: url,

            type: 'PATCH',

            headers: {
                'X-CSRF-TOKEN':
                $('meta[name="csrf-token"]').attr('content')
            },

            success: function () {

                let row = $('button[data-id="' + id + '"]').closest('tr');

                if (action === 'block') {

                    row.find('.user-status').text('Blocked');

                    row.find('.block-container').html(`
                        <button
                            class="btn btn-outline-secondary btn-sm unblock-user"
                            data-id="${id}"
                            title="Unblock User">

                            <i class="fas fa-lock"></i>

                        </button>
                    `);

                } else {

                    row.find('.user-status').text('Active');

                    row.find('.block-container').html(`
                        <button
                            class="btn btn-outline-secondary btn-sm block-user"
                            data-id="${id}"
                            title="Block User">

                            <i class="fas fa-ban"></i>

                        </button>
                    `);

                }

                $('#userActionModal').modal('hide');

            },

            error: function (xhr) {

                console.log(xhr);

                alert('Something went wrong.');

            }

        });

    });

});