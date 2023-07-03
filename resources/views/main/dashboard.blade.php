@extends('layouts.head-calendar')

@section('title', 'Календар')

@section('content')
    <div class="wrapper">
        @include('includes.header')
        <main class="main">
            <!-- Modal -->
            <div class="modal fade" id="reminderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel-reminder">Додати нове нагадування</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="user__input-title" for="title-reminder">Назва
                                    <input type="text"
                                           class="form-control auth__input-field {{ $errors->has('title') ? 'auth__input-field-error' : ''}}"
                                           id="title-reminder" required autofocus>
                                    <span id="titleError-reminder" class="auth__input-error"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="user__input-title" for="start-date-reminder">
                                    Стартова дата
                                    <input type="date" class="form-control auth__input-field auth__input-field-date"
                                           id="start-date-reminder"
                                           placeholder="start-date"
                                           required>
                                    <input type="time" class="form-control auth__input-field" id="start-time-reminder"
                                           placeholder="start-time">
                                </label>
                            </div>
                            <div class="form-group">
                                <p class="user__input-title">Повторювати</p>
                                <div class="radio__repeat">
                                    <div class="radio__repeat-button">
                                        <input type="radio" value="daily" id="day-repeat" name="event-repeat"
                                               onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                        <label for="day-repeat">Щодня</label>
                                    </div>
                                    <div class="radio__repeat-button">
                                        <input type="radio" value="weekly" id="week-repeat" name="event-repeat"
                                               onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                        <label for="week-repeat">Щонеділі</label>
                                    </div>
                                    <div class="radio__repeat-button">
                                        <input type="radio" value="monthly" id="month-repeat" name="event-repeat"
                                               onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                        <label for="month-repeat">Щомісяця</label>
                                    </div>
                                    <div class="radio__repeat-button">
                                        <input type="radio" value="yearly" id="year-repeat" name="event-repeat"
                                               onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                        <label for="year-repeat">Щороку</label>
                                    </div>
                                </div>
                            </div>
                            <div class="repeat-form-group" id="repeat-event" style="display: none;">
                                <div class="form-group">
                                    <div class="checkbox__days" id="checkbox__days" style="display: none">
                                        <p class="user__input-title">Обрати дні</p>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="MO" id="MO" name="event-days">
                                            <label for="MO">Понеділок</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="TU" id="TU" name="event-days">
                                            <label for="TU">Вівторок</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="WE" id="WE" name="event-days">
                                            <label for="WE">Середа</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="TH" id="TH" name="event-days">
                                            <label for="TH">Четвер</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="FR" id="FR" name="event-days">
                                            <label for="FR">П'ятниця</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="SA" id="SA" name="event-days">
                                            <label for="SA">Субота</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="SU" id="SU" name="event-days">
                                            <label for="SU">Неділя</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="user__input-title" for="interval">Інтервал
                                        <input type="number"
                                               class="form-control auth__input-field"
                                               id="interval">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="user__input-title" for="dtstart">
                                        Дата початку повторювання
                                        <input type="date" class="form-control auth__input-field auth__input-field-date"
                                               id="dtstart"
                                               placeholder="start-date">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="user__input-title" for="start-date-reminder">
                                        Дата закінчення повторювання
                                        <input type="date" class="form-control auth__input-field auth__input-field-date"
                                               id="until"
                                               placeholder="start-date">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="user__input-title user__input-color">Колір
                                    @foreach($colors as $color)
                                        <div class="form-check form-check-color">
                                            <input type="radio" name="color-reminder" value="{{ $color->id }}" id="color-reminder_{{ $color->id }}" class="form-check-input" @if($color->id === 6) checked @endif>
                                            <label for="color-reminder_{{ $color->id }}" class="form-check-label radio__color radio__color-{{ $color->title }}"></label>
                                        </div>
                                    @endforeach
                                    @error('color')
                                    <p class="auth__input-error">{{ $message }}</p>
                                    @enderror
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="group" class="user__input-title">Група
                                    @foreach($groups as $group)
                                        <div class="form-check">
                                            <input type="radio" name="group-reminder" value="{{ $group->id }}" id="group-reminder_{{ $group->color }}" class="group__reminder-check" @if($group->id === 1) checked @endif>
                                            <label for="group-reminder_{{ $group->color }}" class="form-check-label">{{ $group->title }}</label>
                                        </div>
                                    @endforeach
                                    @error('group')
                                    <p class="auth__input-error">{{ $message }}</p>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn__close" data-bs-dismiss="modal">Закрити
                            </button>
                            <button type="button" id="saveBtn-reminder" class="btn btn-primary btn__add-reminder">Додати
                                нагадування
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Додати нову подію</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="user__input-title" for="title">Назва
                                    <input type="text"
                                           class="form-control auth__input-field {{ $errors->has('title') ? 'auth__input-field-error' : ''}}"
                                           id="title" required autofocus>
                                </label>
                            </div>
                            <span id="titleError" class="auth__input-error"></span>
                            <div class="form-group">
                                <label class="user__input-title" for="start-date">
                                    Стартова дата
                                    <input type="date" class="form-control auth__input-field auth__input-field-date"
                                           id="start-date"
                                           placeholder="start-date"
                                           required>
                                    <input type="time" class="form-control auth__input-field" id="start-time"
                                           placeholder="start-time">
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="user__input-title" for="end-date">Кінцева дата
                                    <input type="date" class="form-control auth__input-field auth__input-field-date"
                                           id="end-date"
                                           placeholder="end-date">
                                    <input type="time" class="form-control auth__input-field" id="end-time"
                                           placeholder="end-time">
                                </label>
                            </div>
                            <div class="form-group">
                                <p class="user__input-title">Повторювати</p>
                                <div class="radio__repeat">
                                    <div class="radio__repeat-button">
                                        <input type="radio" value="daily" id="day-repeat-event" name="event-repeat-event"
                                               onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                        <label for="day-repeat-event">Щодня</label>
                                    </div>
                                    <div class="radio__repeat-button">
                                        <input type="radio" value="weekly" id="week-repeat-event" name="event-repeat-event"
                                               onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                        <label for="week-repeat-event">Щонеділі</label>
                                    </div>
                                    <div class="radio__repeat-button">
                                        <input type="radio" value="monthly" id="month-repeat-event" name="event-repeat-event"
                                               onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                        <label for="month-repeat-event">Щомісяця</label>
                                    </div>
                                    <div class="radio__repeat-button">
                                        <input type="radio" value="yearly" id="year-repeat-event" name="event-repeat-event"
                                               onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                        <label for="year-repeat-event">Щороку</label>
                                    </div>
                                </div>
                            </div>
                            <div class="repeat-form-group" id="repeat-event-event" style="display: none;">
                                <div class="form-group">
                                    <div class="checkbox__days" id="checkbox__days-event" style="display: none">
                                        <p class="user__input-title">Обрати дні</p>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="MO" id="MO-event" name="event-days-event">
                                            <label for="MO-event">Понеділок</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="TU" id="TU-event" name="event-days-event">
                                            <label for="TU-event">Вівторок</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="WE" id="WE-event" name="event-days-event">
                                            <label for="WE-event">Середа</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="TH" id="TH-event" name="event-days-event">
                                            <label for="TH-event">Четвер</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="FR" id="FR-event" name="event-days-event">
                                            <label for="FR-event">П'ятниця</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="SA" id="SA-event" name="event-days-event">
                                            <label for="SA-event">Субота</label>
                                        </div>
                                        <div class="checkbox__repeat-button">
                                            <input type="checkbox" value="SU" id="SU-event" name="event-days-event">
                                            <label for="SU-event">Неділя</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="user__input-title" for="interval">Інтервал
                                        <input type="number"
                                               class="form-control auth__input-field"
                                               id="interval-event">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="user__input-title" for="dtstart">
                                        Дата початку повторювання
                                        <input type="date" class="form-control auth__input-field auth__input-field-date"
                                               id="dtstart-event"
                                               placeholder="start-date">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="user__input-title" for="start-date-reminder">
                                        Дата закінчення повторювання
                                        <input type="date" class="form-control auth__input-field auth__input-field-date"
                                               id="until-event"
                                               placeholder="start-date">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="user__input-title user__input-color">Колір
                                    @foreach($colors as $color)
                                        <div class="form-check form-check-color">
                                        <input type="radio" name="color" value="{{ $color->id }}" id="color_{{ $color->id }}" class="form-check-input" @if($color->id === 6) checked @endif>
                                        <label for="color_{{ $color->id }}" class="form-check-label radio__color radio__color-{{ $color->title }}"></label>
                                    </div>
                                    @endforeach
                                    @error('color')
                                    <p class="auth__input-error">{{ $message }}</p>
                                    @enderror
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="group" class="user__input-title">Група
                                    @foreach($groups as $group)
                                        <div class="form-check">
                                            <input type="radio" name="group" value="{{ $group->id }}" id="group_{{ $group->id }}" class="group" @if($group->id === 1) checked @endif>
                                            <label for="group_{{ $group->id }}" class="form-check-label">{{ $group->title }}</label>
                                        </div>
                                    @endforeach
                                    @error('group')
                                    <p class="auth__input-error">{{ $message }}</p>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn__close" data-bs-dismiss="modal">Закрити
                            </button>
                            <button type="button" id="saveBtn" class="btn btn-primary btn__add-event">Додати подію
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add modal -->
            <div class="modal fade edit-form" id="form" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="modal-title">Add Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="myForm" action="{{ route('dashboard') }}">
                            <div class="modal-body">
                                <div class="auth__input-error" role="alert" id="danger-alert" style="display: none;">
                                    Кінцева дата повина бути пізніше від початкової!
                                </div>
                                <div class="form-group">
                                    <label for="event-title" class="user__input-title">Назва
                                        <input type="text" class="form-control user__edit-input auth__input-field"
                                               id="event-title"
                                               placeholder="Enter event name" required>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="start-date" class="user__input-title">Початкова дата
                                        <input type="date"
                                               class="form-control user__edit-input auth__input-field auth__input-field-date"
                                               id="start-date-edit"
                                               placeholder="start-date" required>
                                        <input type="time" class="form-control user__edit-input auth__input-field"
                                               id="start-time-edit"
                                               placeholder="start-time">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="end-date" class="user__input-title">Кінцева дата
                                        <input type="date"
                                               class="form-control user__edit-input auth__input-field auth__input-field-date"
                                               id="end-date-edit"
                                               placeholder="end-date">
                                        <input type="time" class="form-control user__edit-input auth__input-field"
                                               id="end-time-edit"
                                               placeholder="end-time">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <p class="user__input-title">Повторювати</p>
                                    <div class="radio__repeat">
                                        <div class="radio__repeat-button">
                                            <input type="radio" value="daily" id="day-repeat-edit" name="event-repeat-edit"
                                                   onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                            <label for="day-repeat-edit">Щодня</label>
                                        </div>
                                        <div class="radio__repeat-button">
                                            <input type="radio" value="weekly" id="week-repeat-edit" name="event-repeat-edit"
                                                   onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                            <label for="week-repeat-edit">Щонеділі</label>
                                        </div>
                                        <div class="radio__repeat-button">
                                            <input type="radio" value="monthly" id="month-repeat-edit" name="event-repeat-edit"
                                                   onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                            <label for="month-repeat-edit">Щомісяця</label>
                                        </div>
                                        <div class="radio__repeat-button">
                                            <input type="radio" value="yearly" id="year-repeat-edit" name="event-repeat-edit"
                                                   onclick="clickRadio(this, 'repeat-event', 'checkbox__days', 'repeat-event-event', 'checkbox__days-event', 'repeat-event-edit', 'checkbox__days-edit')">
                                            <label for="year-repeat-edit">Щороку</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="repeat-form-group" id="repeat-event-edit" style="display: none;">
                                    <div class="form-group">
                                        <div class="checkbox__days" id="checkbox__days-edit" style="display: none">
                                            <p class="user__input-title">Обрати дні</p>
                                            <div class="checkbox__repeat-button">
                                                <input type="checkbox" value="MO" id="MO-edit" name="event-days-edit">
                                                <label for="MO-edit">Понеділок</label>
                                            </div>
                                            <div class="checkbox__repeat-button">
                                                <input type="checkbox" value="TU" id="TU-edit" name="event-days-edit">
                                                <label for="TU-edit">Вівторок</label>
                                            </div>
                                            <div class="checkbox__repeat-button">
                                                <input type="checkbox" value="WE" id="WE-edit" name="event-days-edit">
                                                <label for="WE-edit">Середа</label>
                                            </div>
                                            <div class="checkbox__repeat-button">
                                                <input type="checkbox" value="TH" id="TH-edit" name="event-days-edit">
                                                <label for="TH-edit">Четвер</label>
                                            </div>
                                            <div class="checkbox__repeat-button">
                                                <input type="checkbox" value="FR" id="FR-edit" name="event-days-edit">
                                                <label for="FR-edit">П'ятниця</label>
                                            </div>
                                            <div class="checkbox__repeat-button">
                                                <input type="checkbox" value="SA" id="SA-edit" name="event-days-edit">
                                                <label for="SA-edit">Субота</label>
                                            </div>
                                            <div class="checkbox__repeat-button">
                                                <input type="checkbox" value="SU" id="SU-edit" name="event-days-edit">
                                                <label for="SU-edit">Неділя</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="user__input-title" for="interval-edit">Інтервал
                                            <input type="number"
                                                   class="form-control auth__input-field"
                                                   id="interval-edit">
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="user__input-title" for="dtstart">
                                            Дата початку повторювання
                                            <input type="date" class="form-control auth__input-field auth__input-field-date"
                                                   id="dtstart-edit"
                                                   placeholder="start-date">
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="user__input-title" for="start-date-reminder">
                                            Дата закінчення повторювання
                                            <input type="date" class="form-control auth__input-field auth__input-field-date"
                                                   id="until-edit"
                                                   placeholder="start-date">
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="color" class="user__input-title user__input-color">Колір
                                        @foreach($colors as $color)
                                            <div class="form-check form-check-color">
                                                <input type="radio" name="color-edit" value="{{ $color->id }}" id="{{ $color->color }}" class="color__edit-check">
                                                <label for="{{ $color->color }}" class="form-check-label radio__color radio__color-{{ $color->title }}"></label>
                                            </div>
                                        @endforeach
                                        @error('color')
                                        <p class="auth__input-error">{{ $message }}</p>
                                        @enderror
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="group" class="user__input-title">Група
                                        @foreach($groups as $group)
                                            <div class="form-check">
                                                <input type="radio" name="group-edit" value="{{ $group->id }}" id="{{ $group->color }}" class="group__edit-check">
                                                <label for="{{ $group->color }}" class="form-check-label">{{ $group->title }}</label>
                                            </div>
                                        @endforeach
                                        @error('group')
                                        <p class="auth__input-error">{{ $message }}</p>
                                        @enderror
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 d-flex justify-content-center">
                                <button type="submit" class="btn" id="cancel-button">Закрити</button>
                                <button type="submit" class="btn btn-success" id="submit-button">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="done-modal" tabindex="-1" role="dialog" aria-labelledby="done-modal-title"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="done-modal-title">Виконано</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-body-auto text-center" id="done-modal-body">
                            Ви дійсно хочете позначити як "Виконано" цю подію?
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn__close rounded-sm" data-dismiss="modal"
                                    id="cancel-button-done">Скасувати
                            </button>
                            <button type="button" class="btn btn__add-reminder w-150" id="done-button">Виконано</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal-title"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-modal-title">Видалення</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-body-auto text-center" id="delete-modal-body">
                            Ви дійсно хочете видалити цю подію?
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn__add-reminder mr-5 w-150" data-dismiss="modal"
                                    id="cancel-button-delete">Скасувати
                            </button>
                            <button type="button" class="btn__close" id="delete-button">Видалити</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container calendar__container">
                <div class="calendar" id="calendar">
                    <div id="demo-header-functionality" class="md-custom-header-filtering"></div>
                </div>
                <div class="calendar-list" id="calendar-list">
                </div>
            </div>
            @include('includes.calendar-ajax')
        </main>
    </div>
    @include('includes.footer')
@endsection
