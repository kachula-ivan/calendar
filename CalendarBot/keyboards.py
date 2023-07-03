from aiogram import types

markup_code = types.ReplyKeyboardMarkup(resize_keyboard=True)
return_code = types.KeyboardButton('Ввести іншу пошту')
markup_code.add(return_code)
