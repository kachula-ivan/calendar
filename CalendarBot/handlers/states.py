from aiogram.dispatcher.filters.state import State, StatesGroup

class reg(StatesGroup):
    mail = State()
    code = State()
