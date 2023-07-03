<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var events_calendar = @json($events);
    var events_reminders = [];

    for (var i = 0; i < events_calendar.length; i++) {
        var event = {
            id: events_calendar[i].id,
            title: events_calendar[i].title,
            backgroundColor: events_calendar[i].color,
            display: 'block',
            // classNames: events_calendar[i].className === 'fc-daygrid-block-event' ? 'custom-class' : 'black',
            borderColor: events_calendar[i].borderColor,
            group: events_calendar[i].group,
            start: events_calendar[i].start,
            end: events_calendar[i].end,
            rrule: {}
        };
        if (events_calendar[i].done === 1) {
            event.extendedProps = {
                customStyles: {
                    borderTop: '2px solid #81ff9a',
                    borderLeft: '2px solid #81ff9a'
                }
            };
        }
        if (events_calendar[i].freq !== null && events_calendar[i].freq !== undefined) {
            event.rrule.freq = events_calendar[i].freq;
        }

        if (events_calendar[i].interval !== null && events_calendar[i].interval !== undefined) {
            event.rrule.interval = events_calendar[i].interval;
        }

        if (events_calendar[i].byweekday !== null && events_calendar[i].byweekday !== undefined) {
            event.rrule.byweekday = events_calendar[i].byweekday.split(",");
        }

        if (events_calendar[i].duration !== null && events_calendar[i].duration !== undefined) {
            event.duration = events_calendar[i].duration;
        }

        if (events_calendar[i].dtstart !== null && events_calendar[i].dtstart !== undefined) {
            event.rrule.dtstart = events_calendar[i].dtstart;
        }

        if (events_calendar[i].until !== null && events_calendar[i].until !== undefined) {
            event.rrule.until = events_calendar[i].until;
        }

        if (JSON.stringify(event.rrule) === '{}') {
            delete event.rrule;
            delete event.duration;
        }

        events_reminders.push(event);
    }
    var events_reminders_list = [];

    for (var i = 0; i < events_calendar.length; i++) {
        var event = {
            id: events_calendar[i].id,
            title: events_calendar[i].title,
            backgroundColor: events_calendar[i].borderColor,
            color: events_calendar[i].color,
            borderColor: events_calendar[i].color,
            group: events_calendar[i].group,
            start: events_calendar[i].start,
            end: events_calendar[i].end,
            rrule: {}
        };
        if (events_calendar[i].done === 1) {
            event.extendedProps = {
                customStyles: {
                    backgroundColor: '#b6ffafad',
                    borderRadius: '10px',
                    transition: '0.7s',
                }
            };
        }
        if (events_calendar[i].freq !== null && events_calendar[i].freq !== undefined) {
            event.rrule.freq = events_calendar[i].freq;
        }

        if (events_calendar[i].interval !== null && events_calendar[i].interval !== undefined) {
            event.rrule.interval = events_calendar[i].interval;
        }

        if (events_calendar[i].byweekday !== null && events_calendar[i].byweekday !== undefined) {
            event.rrule.byweekday = events_calendar[i].byweekday.split(",");
        }

        if (events_calendar[i].duration !== null && events_calendar[i].duration !== undefined) {
            event.duration = events_calendar[i].duration;
        }

        if (events_calendar[i].dtstart !== null && events_calendar[i].dtstart !== undefined) {
            event.rrule.dtstart = events_calendar[i].dtstart;
        }

        if (events_calendar[i].until !== null && events_calendar[i].until !== undefined) {
            event.rrule.until = events_calendar[i].until;
        }

        if (JSON.stringify(event.rrule) === '{}') {
            delete event.rrule;
            delete event.duration;
        }

        events_reminders_list.push(event);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const myModal = new bootstrap.Modal(document.getElementById('form'));
        const dangerAlert = document.getElementById('danger-alert');
        const close = document.querySelector('.btn-close');
        var calendarEl = document.getElementById('calendar');
        var calendarEl_list = document.getElementById('calendar-list');
        moment.locale('uk');
        function addButtonHeaderResp() {
            if (window.innerWidth < 1024) {
                return '';
            } else {
                return 'add_reminder add_event';
            }
        }
        function addButtonFooterResp() {
            if (window.innerWidth < 1024) {
                return 'add_reminder add_event';
            } else {
                return '';
            }
        }
        var calendar_list = new FullCalendar.Calendar(calendarEl_list, {
            initialView: 'listWeek',
            eventTimeFormat:
                {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
            events: events_reminders_list,
            locale: 'uk',
            firstDay: 1,
            customButtons: {
                add_reminder: {
                    text: 'Додати нагадування',
                    click: function (info) {
                        $('#reminderModal').modal('toggle');
                        var today = new Date();
                        var start_today = today.toISOString().slice(0, 10);

                        document.getElementById('title-reminder').value = '';
                        document.getElementById('start-date-reminder').value = start_today;
                        document.getElementById('start-time-reminder').value = '00:00';

                        $('#saveBtn-reminder').click(function () {
                            var title = $('#title-reminder').val();
                            var user_id = 1;
                            var color = document.querySelector('input[name="color-reminder"]:checked').value;
                            var group = document.querySelector('input[name="group-reminder"]:checked').value;
                            var start_date = document.querySelector('#start-date-reminder').value;
                            var start_time = document.querySelector('#start-time-reminder').value;
                            var freq = null
                            try {
                                freq = document.querySelector('input[name="event-repeat"]:checked').value;
                            } catch {
                            }
                            var interval = document.querySelector('#interval').value;
                            var checkboxes = document.getElementsByName('event-days');
                            var duration = null
                            var byweekday = [];
                            for (var i = 0; i < checkboxes.length; i++) {
                                if (checkboxes[i].checked) {
                                    byweekday.push(checkboxes[i].value);
                                }
                            }
                            byweekday = byweekday.join(",");
                            var dtstart = document.querySelector('#dtstart').value;
                            var until = document.querySelector('#until').value;
                            var end_date = null;
                            var end_time = null;

                            $.ajax({
                                url: "{{ route('calendar.store') }}",
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    title,
                                    user_id,
                                    start_date,
                                    start_time,
                                    end_date,
                                    end_time,
                                    color,
                                    group,
                                    freq,
                                    interval,
                                    byweekday,
                                    duration,
                                    dtstart,
                                    until
                                },
                                success: function (response) {
                                    $('#reminderModal').modal('hide');
                                    calendar.addEvent(response);
                                },
                                error: function (error) {
                                    if (error.responseJSON.errors) {
                                        $('#titleError-reminder').html(error.responseJSON.errors.title);
                                    }
                                },
                            });
                        });
                    }
                },
                add_event: {
                    text: 'Додати подію',
                    click: function (info) {
                        $('#bookingModal').modal('toggle');
                        var today = new Date();
                        var start_today = today.toISOString().slice(0, 10);

                        var end_date = new Date(today);
                        end_date.setHours(today.getHours() + 23);
                        end_date.setDate(end_date.getDate() - 1);
                        var end_today = end_date.toISOString().slice(0, 10);

                        document.getElementById('title').value = '';
                        document.getElementById('start-date').value = start_today;
                        document.getElementById('end-date').value = end_today;
                        document.getElementById('start-time').value = '00:00';
                        document.getElementById('end-time').value = '00:00';

                        $('#saveBtn').click(function () {
                            var title = $('#title').val();
                            var user_id = 1;
                            var color = document.querySelector('input[name="color"]:checked').value;
                            var groupInput = document.querySelector('input[name="group"]:checked');
                            var group = groupInput ? groupInput.value : "1";
                            var start_date = document.querySelector('#start-date').value;
                            var end_date = document.querySelector('#end-date').value;
                            var start_time = document.querySelector('#start-time').value;
                            var end_time = document.querySelector('#end-time').value;
                            var start_datetime = start_date + ' ' + start_time;
                            var end_datetime = end_date + ' ' + end_time;
                            var freq = null
                            try {
                                freq = document.querySelector('input[name="event-repeat-event"]:checked').value;
                            } catch {
                            }
                            var interval = document.querySelector('#interval-event').value;
                            var checkboxes = document.getElementsByName('event-days-event');
                            var byweekday = [];
                            for (var i = 0; i < checkboxes.length; i++) {
                                if (checkboxes[i].checked) {
                                    byweekday.push(checkboxes[i].value);
                                }
                            }
                            byweekday = byweekday.join(",");
                            var dtstart = document.querySelector('#dtstart-event').value;
                            var until = document.querySelector('#until-event').value;
                            var startDateObj = new Date(start_date);
                            var endDateObj = new Date(end_date);
                            var durationMs = endDateObj - startDateObj;
                            var durationHours = durationMs / (1000 * 60 * 60) + 24;
                            var duration = durationHours + ':00';

                            if (new Date(end_datetime) < new Date(start_datetime)) {
                                $('#titleError').html('Кінцева дата не може бути раніше за початкову!');
                                return;
                            }
                            $.ajax({
                                url: "{{ route('calendar.store') }}",
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    title,
                                    user_id,
                                    start_date,
                                    start_time,
                                    end_date,
                                    end_time,
                                    color,
                                    group,
                                    freq,
                                    interval,
                                    byweekday,
                                    duration,
                                    dtstart,
                                    until
                                },
                                success: function (response) {
                                    $('#bookingModal').modal('hide');
                                    calendar.addEvent(response);
                                },
                                error: function (error) {
                                    if (error.responseJSON.errors) {
                                        $('#titleError').html(error.responseJSON.errors.title);
                                    }
                                },
                            });
                        });
                    }
                },
            },
            headerToolbar: {
                left: '',
                center: addButtonHeaderResp(),
                right: '',
            },
            footerToolbar: {
                left: '',
                center: addButtonFooterResp(),
                right: '',
            },
            eventClick: function (info) {
                var id = info.event.id;
                const doneModal = new bootstrap.Modal(document.getElementById('done-modal'));
                const modalBody = document.getElementById('done-modal-body');
                const cancelModal = document.getElementById('cancel-button-done');
                modalBody.innerHTML = `Ви дійсно хочете позначити як "Виконано" - <b>"${info.event.title}"</b>`
                doneModal.show();

                const doneButton = document.getElementById('done-button');
                doneButton.addEventListener('click', function () {
                    var isDone = 1;
                    $.ajax({
                        url: '{{ route("calendar.update_done", [""]) }}' + '/' + id,
                        type: 'PATCH',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            done: isDone,
                        },
                        success: function () {
                            throw_message("Подію успішно виконана!");
                            doneModal.hide();
                            calendar.render();
                            calendar_list.render();
                            calendar.refetchEvents();
                            calendar_list.refetchEvents();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });

                cancelModal.addEventListener('click', function () {
                    doneModal.hide();
                })
            },
            eventDidMount: function (info) {
                var event = info.event;
                if (event.extendedProps && event.extendedProps.customStyles) {
                    var eventEl = info.el;
                    var customStyles = event.extendedProps.customStyles;
                    for (var prop in customStyles) {
                        eventEl.style[prop] = customStyles[prop];
                    }
                }
                info.el.addEventListener('contextmenu', function (e) {
                    e.preventDefault();
                    let existingMenu = document.querySelector('.context-menu');
                    existingMenu && existingMenu.remove();
                    let menu = document.createElement('div');
                    menu.className = 'context-menu';
                    menu.innerHTML = `
                        <ul>
                        <li class="context__item context__item-edit">
                            <i class="fas fa-edit">Редагувати</i>
                                    <svg class="context-img">
                                        <use xlink:href={{asset('img/icons.svg#edit__context')}}></use>
                                    </svg>
                        </li>
                        <li class="context__item context__item-trash">
                            <i class="fas fa-trash-alt">Видалити</i>
                            <svg class="context-img">
                                        <use xlink:href={{asset('img/icons.svg#trash')}}></use>
                                    </svg>
                        </li>
                        </ul>`;

                    var id = info.event.id;


                    document.body.appendChild(menu);
                    menu.style.top = e.pageY + 'px';
                    menu.style.left = e.pageX + 'px';

                    // Edit context menu

                    menu.querySelector('li:first-child').addEventListener('click', function () {
                        menu.remove();

                        const editModal = new bootstrap.Modal(document.getElementById('form'));
                        const modalTitle = document.getElementById('modal-title');
                        const titleInput = document.getElementById('event-title');
                        document.getElementById('start-date-edit').value = moment(info.event.start, 'YYYY-MM-DD').format('YYYY-MM-DD');
                        document.getElementById('end-date-edit').value = moment(info.event.end, 'YYYY-MM-DD').format('YYYY-MM-DD');
                        document.getElementById('start-time-edit').value = moment(info.event.start, 'YYYY-MM-DD').format('HH:mm');
                        document.getElementById('end-time-edit').value = moment(info.event.end, 'YYYY-MM-DD').format('HH:mm');
                        var color_edit_input = info.event.borderColor
                        var color_edit_input_buttons = document.querySelectorAll('.color__edit-check');
                        color_edit_input_buttons.forEach(function(radioButton) {
                            if (radioButton.id === color_edit_input) {
                                radioButton.checked = true;
                            }
                        });
                        // var groupInput = document.querySelector('#group').value;
                        var group_edit_input = info.event.backgroundColor
                        var group_edit_input_buttons = document.querySelectorAll('.group__edit-check');
                        group_edit_input_buttons.forEach(function(radioButton) {
                            if (radioButton.id === group_edit_input) {
                                radioButton.checked = true;
                            }
                        });
                        const submitButton = document.getElementById('submit-button');
                        const cancelButton = document.getElementById('cancel-button');
                        modalTitle.innerHTML = 'Редагування події';
                        titleInput.value = info.event.title;
                        // colorInput.value = info.event.color;
                        // groupInput.value = info.event.group;
                        cancelButton.innerHTML = 'Закрити';
                        submitButton.innerHTML = 'Зберегти зміни';
                        editModal.show();

                        submitButton.classList.remove('btn-success')
                        submitButton.classList.add('btn__add-reminder')
                        cancelButton.classList.add('btn__close')
                        // Edit button
                        submitButton.addEventListener('click', function () {
                            var title = titleInput.value;
                            var color = document.querySelector('input[name="color-edit"]:checked').value;
                            var group = document.querySelector('input[name="group-edit"]:checked').value;
                            var start_date = document.getElementById('start-date-edit').value;
                            var end_date = document.getElementById('end-date-edit').value;
                            var start_time = document.getElementById('start-time-edit').value;
                            var end_time = document.getElementById('end-time-edit').value;
                            $.ajax({
                                url: '{{ route("calendar.update", [""]) }}' + '/' + id,
                                type: 'PATCH',
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    title: title,
                                    start_date: start_date,
                                    end_date: end_date,
                                    start_time: start_time,
                                    end_time: end_time,
                                    color: color,
                                    group: group
                                },
                                success: function (response) {
                                    throw_message("Подію успішно змінено!");
                                    editModal.hide();
                                    calendar.refetchEvents();
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });
                            editModal.hide();
                            form.reset();
                        })
                    })

                    // Delete menu
                    menu.querySelector('li:last-child').addEventListener('click', function () {
                        const deleteModal = new bootstrap.Modal(document.getElementById('delete-modal'));
                        const modalBody = document.getElementById('delete-modal-body');
                        const cancelModal = document.getElementById('cancel-button-delete');
                        modalBody.innerHTML = `Ви дійсно хочете видалити <b>"${info.event.title}"</b>?`
                        deleteModal.show();

                        const deleteButton = document.getElementById('delete-button');
                        deleteButton.addEventListener('click', function () {
                            fetch('{{ route("calendar.destroy", [""]) }}' + '/' + id, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                                .then(response => response.json())
                                .then(response => {
                                    info.event.remove();
                                    throw_message_error("Подію успішно видалено!");
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            deleteModal.hide();
                            menu.remove();
                        });

                        cancelModal.addEventListener('click', function () {
                            deleteModal.hide();
                        })


                    });
                    document.addEventListener('click', function () {
                        menu.remove();
                    });
                });
            },
        });
        function getTodayButtonText() {
            if (window.innerWidth < 576) {
                return moment().format('MM D, YYYY');
            }
            else if (window.innerWidth < 1024){
                return moment().format('MMM D, YYYY');
            } else {
                return moment().format('dddd, MMM D, YYYY');
            }
        }
        function mobileHeaderLeft() {
            if (window.innerWidth < 576) {
                return 'multiMonthYear dayGridMonth dayGridDay'
            } else {
                return 'today'
            }
        }
        function mobileHeaderCenter() {
            if (window.innerWidth < 576) {
                return 'today'
            } else {
                return 'prev title next'
            }
        }
        function mobileHeaderRight() {
            if (window.innerWidth < 576) {
                return 'prev title next'
            } else {
                return 'multiMonthYear dayGridMonth dayGridDay'
            }
        }
            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: mobileHeaderLeft(),
                center: mobileHeaderCenter(),
                right: mobileHeaderRight()
            },
            footerToolbar: {
                left: 'work leisure education all_events',
                center: 'add_reminder',
                right: 'add_event'
            },
            buttonText: {
                today: getTodayButtonText(),
                dayGridMonth: 'Місяць',
                multiMonthYear: 'Рік',
                dayGridDay: 'День',
                list: 'Список'
            },
            firstDay: 1,
            events: events_reminders,
            locale: 'uk',
            customButtons: {
                work: {
                    text: 'Робота',
                    click: function () {
                        var work__button = document.querySelector('.fc-work-button');
                        var leisure__button = document.querySelector('.fc-leisure-button');
                        var education__button = document.querySelector('.fc-education-button');
                        var all_events__button = document.querySelector('.fc-all_events-button');
                        work__button.classList.add('active');
                        leisure__button.classList.remove('active');
                        education__button.classList.remove('active');
                        all_events__button.classList.remove('active');
                        var events = calendar.getEvents();
                        events.forEach(function (event) {
                                calendar.addEvent(event);
                        });
                        events.forEach(function (event) {
                                event.remove();
                        });
                        events_reminders.forEach(function (event) {
                            if (event.borderColor === '#000') {
                                calendar.addEvent(event);
                            }
                        });
                        calendar.refetchEvents();
                    }
                },
                leisure: {
                    text: 'Дозвілля',
                    click: function () {
                        var work__button = document.querySelector('.fc-work-button');
                        var leisure__button = document.querySelector('.fc-leisure-button');
                        var education__button = document.querySelector('.fc-education-button');
                        var all_events__button = document.querySelector('.fc-all_events-button');
                        work__button.classList.remove('active');
                        leisure__button.classList.add('active');
                        education__button.classList.remove('active');
                        all_events__button.classList.remove('active');
                        var events = calendar.getEvents();
                        events.forEach(function (event) {
                            calendar.addEvent(event);
                        });
                        events.forEach(function (event) {
                            event.remove();
                        });
                        events_reminders.forEach(function (event) {
                            if (event.borderColor === '#360e61') {
                                calendar.addEvent(event);
                            }
                        });
                        calendar.refetchEvents();
                    }
                },
                education: {
                    text: 'Навчання',
                    click: function () {
                        var work__button = document.querySelector('.fc-work-button');
                        var leisure__button = document.querySelector('.fc-leisure-button');
                        var education__button = document.querySelector('.fc-education-button');
                        var all_events__button = document.querySelector('.fc-all_events-button');
                        work__button.classList.remove('active');
                        leisure__button.classList.remove('active');
                        education__button.classList.add('active');
                        all_events__button.classList.remove('active');
                        var events = calendar.getEvents();
                        events.forEach(function (event) {
                            calendar.addEvent(event);
                        });
                        events.forEach(function (event) {
                            event.remove();
                        });
                        events_reminders.forEach(function (event) {
                            if (event.borderColor === '#00ffd9') {
                                calendar.addEvent(event);
                            }
                        });
                        calendar.refetchEvents();
                    }
                },
                all_events: {
                    text: 'Всі події',
                    click: function () {
                        var work__button = document.querySelector('.fc-work-button');
                        var leisure__button = document.querySelector('.fc-leisure-button');
                        var education__button = document.querySelector('.fc-education-button');
                        var all_events__button = document.querySelector('.fc-all_events-button');
                        work__button.classList.remove('active');
                        leisure__button.classList.remove('active');
                        education__button.classList.remove('active');
                        all_events__button.classList.add('active');
                        var events = calendar.getEvents();
                        events.forEach(function (event) {
                            calendar.addEvent(event);
                        });
                        events.forEach(function (event) {
                            event.remove();
                        });
                        events_reminders.forEach(function (event) {
                                calendar.addEvent(event);
                        });
                        calendar.refetchEvents();
                    }
                },
                add_reminder: {
                    text: 'Додати нагадування',
                    click: function (info) {
                        $('#reminderModal').modal('toggle');
                        var today = new Date();
                        var start_today = today.toISOString().slice(0, 10);

                        document.getElementById('title-reminder').value = '';
                        document.getElementById('start-date-reminder').value = start_today;
                        document.getElementById('start-time-reminder').value = '00:00';

                        $('#saveBtn-reminder').click(function () {
                            var title = $('#title-reminder').val();
                            var user_id = 1;
                            var color = document.querySelector('input[name="color-reminder"]:checked').value;
                            var group = document.querySelector('input[name="group-reminder"]:checked').value;
                            var start_date = document.querySelector('#start-date-reminder').value;
                            var start_time = document.querySelector('#start-time-reminder').value;
                            var freq = null
                            try {
                                freq = document.querySelector('input[name="event-repeat"]:checked').value;
                            } catch {
                            }
                            var interval = document.querySelector('#interval').value;
                            var checkboxes = document.getElementsByName('event-days');
                            var duration = null
                            var byweekday = [];
                            for (var i = 0; i < checkboxes.length; i++) {
                                if (checkboxes[i].checked) {
                                    byweekday.push(checkboxes[i].value);
                                }
                            }
                            byweekday = byweekday.join(",");
                            var dtstart = document.querySelector('#dtstart').value;
                            var until = document.querySelector('#until').value;
                            var end_date = null;
                            var end_time = null;

                            $.ajax({
                                url: "{{ route('calendar.store') }}",
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    title,
                                    user_id,
                                    start_date,
                                    start_time,
                                    end_date,
                                    end_time,
                                    color,
                                    group,
                                    freq,
                                    interval,
                                    byweekday,
                                    duration,
                                    dtstart,
                                    until
                                },
                                success: function (response) {
                                    $('#reminderModal').modal('hide');
                                    calendar.addEvent(response);
                                },
                                error: function (error) {
                                    if (error.responseJSON.errors) {
                                        $('#titleError-reminder').html(error.responseJSON.errors.title);
                                    }
                                },
                            });
                        });
                    }
                },
                add_event: {
                    text: 'Додати подію',
                    click: function (info) {
                        $('#bookingModal').modal('toggle');
                        var today = new Date();
                        var start_today = today.toISOString().slice(0, 10);

                        var end_date = new Date(today);
                        end_date.setHours(today.getHours() + 23);
                        end_date.setDate(end_date.getDate() - 1);
                        var end_today = end_date.toISOString().slice(0, 10);

                        document.getElementById('title').value = '';
                        document.getElementById('start-date').value = start_today;
                        document.getElementById('end-date').value = end_today;
                        document.getElementById('start-time').value = '00:00';
                        document.getElementById('end-time').value = '00:00';

                        $('#saveBtn').click(function () {
                            var title = $('#title').val();
                            var user_id = 1;
                            var color = document.querySelector('input[name="color"]:checked').value;
                            var groupInput = document.querySelector('input[name="group"]:checked');
                            var group = groupInput ? groupInput.value : "1";
                            var start_date = document.querySelector('#start-date').value;
                            var end_date = document.querySelector('#end-date').value;
                            var start_time = document.querySelector('#start-time').value;
                            var end_time = document.querySelector('#end-time').value;
                            var start_datetime = start_date + ' ' + start_time;
                            var end_datetime = end_date + ' ' + end_time;
                            var freq = null
                            try {
                                freq = document.querySelector('input[name="event-repeat-event"]:checked').value;
                            } catch {
                            }
                            var interval = document.querySelector('#interval-event').value;
                            var checkboxes = document.getElementsByName('event-days-event');
                            var byweekday = [];
                            for (var i = 0; i < checkboxes.length; i++) {
                                if (checkboxes[i].checked) {
                                    byweekday.push(checkboxes[i].value);
                                }
                            }
                            byweekday = byweekday.join(",");
                            var dtstart = document.querySelector('#dtstart-event').value;
                            var until = document.querySelector('#until-event').value;
                            var startDateObj = new Date(start_date);
                            var endDateObj = new Date(end_date);
                            var durationMs = endDateObj - startDateObj;
                            var durationHours = durationMs / (1000 * 60 * 60) + 24;
                            var duration = durationHours + ':00';

                            if (new Date(end_datetime) < new Date(start_datetime)) {
                                $('#titleError').html('Кінцева дата не може бути раніше за початкову!');
                                return;
                            }
                            $.ajax({
                                url: "{{ route('calendar.store') }}",
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    title,
                                    user_id,
                                    start_date,
                                    start_time,
                                    end_date,
                                    end_time,
                                    color,
                                    group,
                                    freq,
                                    interval,
                                    byweekday,
                                    duration,
                                    dtstart,
                                    until
                                },
                                success: function (response) {
                                    $('#bookingModal').modal('hide');
                                    calendar.addEvent(response);
                                },
                                error: function (error) {
                                    if (error.responseJSON.errors) {
                                        $('#titleError').html(error.responseJSON.errors.title);
                                    }
                                },
                            });
                        });
                    }
                },
            },
            eventTimeFormat:
                {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },
            selectable: true,
            dayMaxEventRows: 4,
            selectMirror: true,
            slotDuration: '00:15:00',
            eventDidMount: function (info) {
                var event = info.event;
                if (event.extendedProps && event.extendedProps.customStyles) {
                    var eventEl = info.el;
                    var customStyles = event.extendedProps.customStyles;
                    for (var prop in customStyles) {
                        eventEl.style[prop] = customStyles[prop];
                    }
                }
                info.el.addEventListener('contextmenu', function (e) {
                    e.preventDefault();
                    let existingMenu = document.querySelector('.context-menu');
                    existingMenu && existingMenu.remove();
                    let menu = document.createElement('div');
                    menu.className = 'context-menu';
                    menu.innerHTML = `
                        <ul>
                        <li class="context__item context__item-edit">
                            <i class="fas fa-edit">Редагувати</i>
                                    <svg class="context-img">
                                        <use xlink:href={{asset('img/icons.svg#edit__context')}}></use>
                                    </svg>
                        </li>
                        <li class="context__item context__item-trash">
                            <i class="fas fa-trash-alt">Видалити</i>
                            <svg class="context-img">
                                        <use xlink:href={{asset('img/icons.svg#trash')}}></use>
                                    </svg>
                        </li>
                        </ul>`;

                    var id = info.event.id;

                    document.body.appendChild(menu);
                    menu.style.top = e.pageY + 'px';
                    menu.style.left = e.pageX + 'px';

                    // Edit context menu

                    menu.querySelector('li:first-child').addEventListener('click', function () {
                        menu.remove();

                        const editModal = new bootstrap.Modal(document.getElementById('form'));
                        const modalTitle = document.getElementById('modal-title');
                        const titleInput = document.getElementById('event-title');
                        document.getElementById('start-date-edit').value = moment(info.event.start, 'YYYY-MM-DD').format('YYYY-MM-DD');
                        document.getElementById('end-date-edit').value = moment(info.event.end, 'YYYY-MM-DD').format('YYYY-MM-DD');
                        document.getElementById('start-time-edit').value = moment(info.event.start, 'YYYY-MM-DD').format('HH:mm');
                        document.getElementById('end-time-edit').value = moment(info.event.end, 'YYYY-MM-DD').format('HH:mm');
                        // var groupInput = document.querySelector('#group-edit').value;
                        const submitButton = document.getElementById('submit-button');
                        const cancelButton = document.getElementById('cancel-button');
                        modalTitle.innerHTML = 'Редагування події';
                        titleInput.value = info.event.title;

                        var color_edit_input = info.event.backgroundColor
                        var color_edit_input_buttons = document.querySelectorAll('.color__edit-check');
                        color_edit_input_buttons.forEach(function(radioButton) {
                            if (radioButton.id === color_edit_input) {
                                radioButton.checked = true;
                            }
                        });
                        var group_edit_input = info.event.borderColor
                        var group_edit_input_buttons = document.querySelectorAll('.group__edit-check');
                        group_edit_input_buttons.forEach(function(radioButton) {
                            if (radioButton.id === group_edit_input) {
                                radioButton.checked = true;
                            }
                        });
                        // groupInput.value = info.event.group;
                        cancelButton.innerHTML = 'Закрити';
                        submitButton.innerHTML = 'Зберегти зміни';
                        editModal.show();

                        submitButton.classList.remove('btn-success')
                        submitButton.classList.add('btn__add-reminder')
                        cancelButton.classList.add('btn__close')
                        // Edit button
                        submitButton.addEventListener('click', function () {
                            var title = titleInput.value;
                            var color = document.querySelector('input[name="color-edit"]:checked').value;
                            var group = document.querySelector('input[name="group-edit"]:checked').value;
                            var start_date = document.getElementById('start-date-edit').value;
                            var end_date = document.getElementById('end-date-edit').value;
                            var start_time = document.getElementById('start-time-edit').value;
                            var end_time = document.getElementById('end-time-edit').value;
                            var freq = null
                            try {
                                freq = document.querySelector('input[name="event-repeat-edit"]:checked').value;
                            } catch {
                            }
                            var interval = document.getElementById('interval-edit').value;
                            var checkboxes = document.getElementsByName('event-days-edit');
                            var byweekday = [];
                            for (var i = 0; i < checkboxes.length; i++) {
                                if (checkboxes[i].checked) {
                                    byweekday.push(checkboxes[i].value);
                                }
                            }
                            byweekday = byweekday.join(",");
                            var startDateObj = new Date(start_date);
                            var endDateObj = new Date(end_date);
                            var durationMs = endDateObj - startDateObj;
                            var durationHours = durationMs / (1000 * 60 * 60) + 24;
                            var duration = durationHours + ':00';
                            var dtstart = document.getElementById('dtstart-edit').value;
                            var until = document.getElementById('until-edit').value;
                            $.ajax({
                                url: '{{ route("calendar.update", [""]) }}' + '/' + id,
                                type: 'PATCH',
                                dataType: 'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    title: title,
                                    start_date: start_date,
                                    end_date: end_date,
                                    start_time: start_time,
                                    end_time: end_time,
                                    color: color,
                                    group: group,
                                    freq: freq,
                                    interval: interval,
                                    duration: duration,
                                    byweekday: byweekday,
                                    dtstart: dtstart,
                                    until: until,
                                },
                                success: function (response) {
                                    throw_message("Подію успішно змінено!");
                                    editModal.hide();
                                    calendar.render();
                                    calendar_list.render();
                                    calendar.refetchEvents();
                                    calendar_list.refetchEvents();
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });
                            editModal.hide();
                            form.reset();
                        })
                    })

                    // Delete menu
                    menu.querySelector('li:last-child').addEventListener('click', function () {
                        const deleteModal = new bootstrap.Modal(document.getElementById('delete-modal'));
                        const modalBody = document.getElementById('delete-modal-body');
                        const cancelModal = document.getElementById('cancel-button-delete');
                        modalBody.innerHTML = `Ви дійсно хочете видалити <b>"${info.event.title}"</b>?`
                        deleteModal.show();

                        const deleteButton = document.getElementById('delete-button');
                        deleteButton.addEventListener('click', function () {
                            fetch('{{ route("calendar.destroy", [""]) }}' + '/' + id, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                                .then(response => response.json())
                                .then(response => {
                                    throw_message_error("Подію успішно видалено!");
                                    info.event.remove();
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            deleteModal.hide();
                            menu.remove();
                        });

                        cancelModal.addEventListener('click', function () {
                            deleteModal.hide();
                        })


                    });
                    document.addEventListener('click', function () {
                        menu.remove();
                    });
                });
            },

            select: function (info) {
                $('#bookingModal').modal('toggle');
                var start_select_date = info.startStr;
                var end_select_date = info.endStr;
                var date = new Date(end_select_date);
                date.setSeconds(date.getSeconds() - 1);
                end_select_date = date.toISOString().slice(0, 10);
                document.getElementById('title').value = '';
                document.getElementById('start-time').value = '00:00';
                document.getElementById('end-time').value = '00:00';
                document.getElementById('start-date').value = start_select_date;
                document.getElementById('end-date').value = end_select_date;
                $('#saveBtn').click(function () {
                    var title = $('#title').val();
                    var user_id = 1;
                    var color = document.querySelector('input[name="color"]:checked').value;
                    var groupInput = document.querySelector('input[name="group"]:checked');
                    var group = groupInput ? groupInput.value : "1";
                    var start_date = document.querySelector('#start-date').value;
                    var end_date = document.querySelector('#end-date').value;
                    var start_time = document.querySelector('#start-time').value;
                    var end_time = document.querySelector('#end-time').value;
                    var start_datetime = start_date + ' ' + start_time;
                    var end_datetime = end_date + ' ' + end_time;
                    var freq = null
                    try {
                        freq = document.querySelector('input[name="event-repeat-event"]:checked').value;
                    } catch {
                    }
                    var interval = document.querySelector('#interval').value;
                    var checkboxes = document.getElementsByName('event-days-event');
                    var byweekday = [];
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            byweekday.push(checkboxes[i].value);
                        }
                    }
                    byweekday = byweekday.join(",");
                    var dtstart = document.querySelector('#dtstart').value;
                    var until = document.querySelector('#until').value;
                    var startDateObj = new Date(start_date);
                    var endDateObj = new Date(end_date);
                    var durationMs = endDateObj - startDateObj;
                    var durationHours = durationMs / (1000 * 60 * 60) + 24;
                    var duration = durationHours + ':00';

                    if (new Date(end_datetime) < new Date(start_datetime)) {
                        $('#titleError').html('Кінцева дата не може бути раніше за початкову!');
                        return;
                    }
                    $.ajax({
                        url: "{{ route('calendar.store') }}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            title,
                            user_id,
                            start_date,
                            start_time,
                            end_date,
                            end_time,
                            color,
                            group,
                            freq,
                            interval,
                            byweekday,
                            duration,
                            dtstart,
                            until
                        },
                        success: function (response) {
                            $('#bookingModal').modal('hide');
                            calendar.addEvent(response);
                        },
                        error: function (error) {
                            if (error.responseJSON.errors) {
                                $('#titleError').html(error.responseJSON.errors.title);
                            }
                        },
                    });
                });
            },

            editable: true,

            eventChange: function (event) {
                var id = event.event.id;
                var title = event.event.title;
                var start_date = moment(event.event.start).format('YYYY-MM-DD HH:mm:ss');
                var end_date = moment(event.event.end).format('YYYY-MM-DD HH:mm:ss');

                $.ajax({
                    url: '{{ route("calendar.update_draggable", [""]) }}' + '/' + id,
                    type: 'PATCH',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {title: title, start_date: start_date, end_date: end_date},
                    success: function (response) {
                        calendar.render();
                        calendar_list.render();
                        calendar.refetchEvents();
                        calendar_list.refetchEvents();
                        throw_message("Подію перенесено успішно!");
                        return false;
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },

            eventClick: function (info) {
                var id = info.event.id;
                const doneModal = new bootstrap.Modal(document.getElementById('done-modal'));
                const modalBody = document.getElementById('done-modal-body');
                const cancelModal = document.getElementById('cancel-button-done');
                modalBody.innerHTML = `Ви дійсно хочете позначити як "Виконано" - <b>"${info.event.title}"</b>`
                doneModal.show();

                const doneButton = document.getElementById('done-button');
                doneButton.addEventListener('click', function () {
                    var isDone = 1; // Или другое значение, которое указывает на состояние "выполнено" или "не выполнено"
                    $.ajax({
                        url: '{{ route("calendar.update_done", [""]) }}' + '/' + id,
                        type: 'PATCH',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            done: isDone,
                        },
                        success: function () {
                            throw_message("Подію успішно виконана!");
                            doneModal.hide();
                            calendar.render();
                            calendar_list.render();
                            calendar.refetchEvents();
                            calendar_list.refetchEvents();
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                });

                cancelModal.addEventListener('click', function () {
                    doneModal.hide();
                })
            },
        });

        const form = document.querySelector('form');

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const title = document.querySelector('#event-title').value;
            const startDate = document.querySelector('#start-date').value;
            const user_id = 1;
            const endDate = document.querySelector('#end-date').value;
            const color = document.querySelector('#event-color').value;
            const endDateFormatted = moment(endDate, 'YYYY-MM-DD').add(1, 'day').format('YYYY-MM-DD');


            if (endDateFormatted <= startDate) {
                dangerAlert.style.display = 'block';
                return;
            }

            $.ajax({
                url: "{{ route('calendar.store') }}",
                type: "POST",
                dataType: 'json',
                data: {title, user_id, startDate, endDate},
                success: function (response) {
                    myModal.hide();
                    calendar.addEvent(response);
                },
                error: function (error) {
                    if (error.responseJSON.errors) {
                        $('#titleError').html(error.responseJSON.errors.title);
                    }
                },
            });
            form.reset();
        });

        myModal._element.addEventListener('hide.bs.modal', function () {
            dangerAlert.style.display = 'none';
            form.reset();
        });

        calendar.render();
        calendar_list.render();
        $("#bookingModal").on("hidden.bs.modal", function () {
            $('#saveBtn').unbind();
        });
    });

    function clickRadio(el, divId, checkbox__days, checkbox__days_event_el, daybyweek_event_el, checkbox__days_edit_el, daybyweek_edit_el) {
        var siblings = document.querySelectorAll("input[type='radio'][name='" + el.name + "']");
        for (var i = 0; i < siblings.length; i++) {
            if (siblings[i] != el)
                siblings[i].oldChecked = false;
        }
        if (el.oldChecked)
            el.checked = false;
        el.oldChecked = el.checked;
        var div = document.getElementById(divId);
        var checkbox__days_div = document.getElementById(checkbox__days);
        var checkbox__days_event = document.getElementById(checkbox__days_event_el);
        var daybyweek_event = document.getElementById(daybyweek_event_el);
        var checkbox__days_edit = document.getElementById(checkbox__days_edit_el);
        var daybyweek_edit = document.getElementById(daybyweek_edit_el);
        var radioOption = document.querySelector('input[name="event-repeat"]:checked');
        var radioOption_event = document.querySelector('input[name="event-repeat-event"]:checked');
        var radioOption_edit = document.querySelector('input[name="event-repeat-edit"]:checked');

        if (radioOption && radioOption.value === 'daily' || radioOption && radioOption.value === 'weekly' || radioOption && radioOption.value === 'monthly' || radioOption && radioOption.value === 'yearly') {
            div.style.display = 'block';
        } else {
            div.style.display = 'none';
        }
        if (radioOption && radioOption.value === 'weekly') {
            checkbox__days_div.style.display = 'block';
        } else {
            checkbox__days_div.style.display = 'none';
        }
        if (radioOption_event && radioOption_event.value === 'daily' || radioOption_event && radioOption_event.value === 'weekly' || radioOption_event && radioOption_event.value === 'monthly' || radioOption_event && radioOption_event.value === 'yearly') {
            checkbox__days_event.style.display = 'block';
        } else {
            checkbox__days_event.style.display = 'none';
        }
        if (radioOption_event && radioOption_event.value === 'weekly') {
            daybyweek_event.style.display = 'block';
        } else {
            daybyweek_event.style.display = 'none';
        }
        if (radioOption_edit && radioOption_edit.value === 'daily' || radioOption_edit && radioOption_edit.value === 'weekly' || radioOption_edit && radioOption_edit.value === 'monthly' || radioOption_edit && radioOption_edit.value === 'yearly') {
            checkbox__days_edit.style.display = 'block';
        } else {
            checkbox__days_edit.style.display = 'none';
        }
        if (radioOption_edit && radioOption_edit.value === 'weekly') {
            daybyweek_edit.style.display = 'block';
        } else {
            daybyweek_edit.style.display = 'none';
        }
    }

</script>

@include('includes.info-message')







