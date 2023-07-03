<div id='info__box-fade' class="info__box-fade">
    <p id='info__message-fade' class='info__message-fade'></p>
</div>
<div id='error_box-fade' class="info__box-fade error__box-fade">
    <p id='error_message-fade' class='info__message-fade error__box-fade error__message-fade'></p>
</div>
<script>
    function throw_message(str) {
        $('#info__message-fade').html(str);
        $("#info__box-fade").fadeIn(200).delay(2000).fadeOut(200);
    }
    function throw_message_error(str) {
        $('#error_message-fade').html(str);
        $("#error_box-fade").fadeIn(200).delay(2000).fadeOut(200);
    }
</script>
