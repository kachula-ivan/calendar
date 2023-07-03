import asyncio
import smtplib
from email.mime.text import MIMEText

from aiogram import types
from aiogram.dispatcher import FSMContext

import database
from config import dp, bot
import keyboards as kb
import handlers.states as states
import handlers.admin
import pandas as pd
from openpyxl import Workbook
import database.db_commands as db_com


wb = Workbook()
ws = wb.active

ws.append(['ID відправника', 'Дата', 'Відправник', 'Повідомлення'])
#######################################################################################################################################

async def anti_flood(*args, **kwargs):
    m = args[0]
    await m.answer("Не флуди :) Одне повідомлення в секунду")

#######################################################################################################################################


#######################################################################################################################################

async def send_email(message: types.Message):
    try:
        pool = await database.db_api.create_pool()
        sender = "bot.management.trx@gmail.com"
        password = "dztaoaixiiljstqi"
        recipient = await db_com.select_email(pool, message.text)
        server = smtplib.SMTP("smtp.gmail.com", 587)
        server.starttls()
        try:
            with open("gmail.html") as file:
                template = file.read()
        except IOError:
            return "The template file doesn't found!"

        try:
            server.login(sender, password)
            msg = MIMEText(template, "html")
            msg["From"] = sender
            msg["To"] = recipient
            msg["Subject"] = "Telegram TRX BOT registration confirmation"
            server.sendmail(sender, recipient, msg.as_string())
        except Exception as _ex:
            pass
    except:
        pass

#######################################################################################################################################


#######################################################################################################################################

@dp.message_handler(commands=["start"])
@dp.throttled(anti_flood, rate=1)
async def start_handler(message: types.Message):
    date_time = pd.Timestamp.now().strftime('%Y-%m-%d %H-%M-%S')
    date_time_save = pd.Timestamp.now().strftime('%Y-%m-%d')
    ws.append([message.from_user.id, date_time, f"{message.from_user.first_name} {message.from_user.last_name} @{message.from_user.username}", message.text])
    file_name = 'messages_' + date_time_save + '.xlsx'
    wb.save(f'logging/{file_name}')
    pool = await database.db_api.create_pool()

    if message.chat.type == 'private':
        try:
            telegram_id = message.from_user.id
            if await db_com.check_user_existence(pool, telegram_id):
                await message.answer("✅ Ви зареєстровані. Вам будуть приходити сповіщення про ваші події у Телеграм")
            else:
                captcha_num = 633912
                await states.reg.mail.set()
                await message.answer("Введіть пошту на яку зареєстрований аккаунт")
                @dp.message_handler(state=states.reg.mail)
                async def mail(message: types.Message, state: FSMContext):

                    async with state.proxy() as data:
                        data['email'] = message.text
                    await message.answer("✉ Перевірте свою пошту. Введіть код: 👇", reply_markup=kb.markup_code)
                    await send_email(message=message)
                    await states.reg.next()

                @dp.message_handler(state=states.reg.code)
                async def type_captcha(message: types.Message, state: FSMContext):
                    try:
                        async with state.proxy() as data:
                            data['email'] = data['email']
                        if str(
                            message.text) == 'Ввести іншу пошту' or message.text == "Ввести другую почту" or message.text == "Enter another mail":
                            await states.reg.mail.set()
                            await message.answer('📨 Введіть вашу пошту', reply_markup=types.ReplyKeyboardRemove())
                            return
                        else:
                            pass
                        if message.text.isdigit():
                            if int(message.text) == captcha_num:
                                if await db_com.select_email(pool, data['email']):
                                    username = '@' + message.from_user.username
                                    await db_com.reg_user(pool, data['email'], username, message.from_user.id)
                                    await message.answer('ℹ Ви підключили телеграм до аккаунту!')
                                    # await message.answer('ℹ Щоб почати отримувати сповіщення в телеграм натисніть на /start_messages')
                                    await message.answer('✅ Тепер сюди вам будуть приходити сповіщення про ваші події')
                                    await state.finish()
                                else:
                                    await message.answer('ℹ Така пошта не зареєстрована на сайті!', reply_markup=types.ReplyKeyboardRemove())
                                    await states.reg.mail.set()
                                    await message.answer('📨 Введіть вашу пошту')
                            else:
                                await message.answer('ℹ Капча введена не правильно', reply_markup=kb.markup_code)
                                await message.answer('ℹ Підтвердіть що це ваш аккаунт')
                        else:
                            await message.answer('ℹ Капча введена не правильно', reply_markup=kb.markup_code)
                            await message.answer('ℹ Підтвердіть що це ваш аккаунт')
                    except:
                        await message.answer('ℹ Капча введена не правильно', reply_markup=kb.markup_code)
                        await message.answer('ℹ Підтвердіть що це ваш аккаунт')
        except:
            await message.answer('❗ Бот розроблений для кожного особисто, не можна його добавляти в групи. Поспілкуйтесь з ним самі: @trx_games_bot\nЯкщо у вас виникли інші проблеми, звертайтесь до нашого менеджера: @Christooo1')
    else:
        await message.answer('❗ Бот розроблений для кожного особисто, не можна його добавляти в групи. Поспілкуйтесь з ним самі: @trx_games_bot\nЯкщо у вас виникли інші проблеми, звертайтесь до нашого менеджера: @Christooo1')

#######################################################################################################################################



#######################################################################################################################################
@dp.message_handler(commands=["help"])
@dp.throttled(anti_flood, rate=1)
async def help_handler(message: types.Message):
    markup = types.InlineKeyboardMarkup()
    markup.add(types.InlineKeyboardButton("📺 Звернутись із проблемою", url="https://t.me/Christooo1"))
    await message.answer("ℹ Якщо у вас виникли проблеми в боті, спробуйте написати команду: /start \n\n👨‍🔧 Якщо проблема лишилась, напишіть нашому менеджеру, він все владнає:\nhttps://t.me/Christooo1", reply_markup=markup)
#######################################################################################################################################


#######################################################################################################################################

@dp.message_handler(content_types=['text'])
@dp.throttled(anti_flood, rate=1)
async def text_message(message: types.Message):

    date_time = pd.Timestamp.now().strftime('%Y-%m-%d %H-%M-%S')
    date_time_save = pd.Timestamp.now().strftime('%Y-%m-%d')
    ws.append([message.from_user.id, date_time, f"{message.from_user.first_name} {message.from_user.last_name} @{message.from_user.username}", message.text])
    file_name = 'messages_' + date_time_save + '.xlsx'
    wb.save(f'logging/{file_name}')

    if (message.text == "Повідомлення"):
        await message.answer('ℹ Вам надіслані всі повідомлення 👀')
    else:
        await bot.send_message(message.from_user.id, "❌ Невідома команда!\n\nВи відправили повідомлення напряму в чат бота, або структура меню була змінена Адміном.\n\nℹ  Не відправляйте прямих повідомлень боту або обновіть Меню, натисніть /start", parse_mode='html')

#######################################################################################################################################


async def check_messages():
    while True:
        pool = await database.db_api.create_pool()
        users_result = await db_com.get_users(pool)
        users = users_result.result()
        for user in users:
            await asyncio.sleep(0.33)
            user_id = user[0]
            messages_result = await db_com.get_title_start(pool, user_id)
            messages = messages_result.result()
            for title in messages:
                await bot.send_message(user_id, f'ℹ Це дружнє нагадування про те, що подія яку ви запланували РОЗПОЧАЛАСЬ.\n\n🎟 Подія: <b>{title[0]}</b>\n\n⏳ Дата початку: <b>{title[1].strftime("%Y-%m-%d %H:%M")}</b>\n\n⌛ Дата закінчення: <b>{title[2].strftime("%Y-%m-%d %H:%M")}</b>')
                await db_com.send_message_start(pool, user_id, title[3])
            messages_result_end = await db_com.get_title_end(pool, user_id)
            messages_end = messages_result_end.result()
            for title in messages_end:
                await bot.send_message(user_id, f'ℹ Це дружнє нагадування про те, що подія яку ви запланували ЗАКІНЧИЛАСЬ.\n\n🎟 Подія: <b>{title[0]}</b>\n\n⏳ Дата початку: <b>{title[1].strftime("%Y-%m-%d %H:%M")}</b>\n\n⌛ Дата закінчення: <b>{title[2].strftime("%Y-%m-%d %H:%M")}</b>')
                await db_com.send_message_end(pool, user_id, title[3])

        await asyncio.sleep(60)

