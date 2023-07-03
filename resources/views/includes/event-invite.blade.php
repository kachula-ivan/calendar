<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    var today = new Date();
    var start_today = today.toISOString().slice(0, 10);

    var end_date = new Date(today);
    end_date.setHours(today.getHours() + 23);
    end_date.setDate(end_date.getDate() - 1);
    var end_today = end_date.toISOString().slice(0, 10);

    document.getElementById('event-title').value = '';
    document.getElementById('start-date-edit').value = start_today;
    document.getElementById('end-date-edit').value = end_today;
    document.getElementById('start-time-edit').value = '00:00';
    document.getElementById('end-time-edit').value = '00:00';

    $('#submit-button').click(function () {
        var title = $('#event-title').val();
        var user_id = 1;
        var friend_id = {{ $profile_user->id }};
        var color = document.querySelector('input[name="color-edit"]:checked').value;
        var group = document.querySelector('input[name="group-edit"]:checked').value;
        var start_date = document.querySelector('#start-date-edit').value;
        var end_date = document.querySelector('#end-date-edit').value;
        var start_time = document.querySelector('#start-time-edit').value;
        var end_time = document.querySelector('#end-time-edit').value;
        var start_datetime = start_date + ' ' + start_time;
        var end_datetime = end_date + ' ' + end_time;

        if (new Date(end_datetime) < new Date(start_datetime)) {
            $('#titleError').html('Кінцева дата не може бути раніше за початкову!');
            return;
        }
        $.ajax({
            url: "{{ route('invite.store') }}",
            type: "POST",
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                title,
                user_id,
                friend_id,
                start_date,
                start_time,
                end_date,
                end_time,
                color,
                group,
                success: function () {
                    throw_message("Надіслано запрошення на подію!");
                    $('#form').modal('hide');
                },
                error: function (error) {
                    console.log(error);
                }
            },
        });
    });
    $('#cancel-button').click(function () {
        $('#form').modal('hide');
    });
</script>
