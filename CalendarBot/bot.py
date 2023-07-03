import asyncio

from aiogram import executor
from config import dp, bot
import handlers
import database
from handlers.client import check_messages


async def on_startup(_):
    print('Bot ONLINE')

if __name__ == "__main__":
    bot = bot
    loop = asyncio.get_event_loop()
    loop.create_task(check_messages())
    executor.start_polling(dp, loop=loop, skip_updates=True, on_startup=on_startup)
