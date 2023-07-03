from aiogram.contrib.fsm_storage.memory import MemoryStorage
from pathlib import Path

storage = MemoryStorage()

I18N_DOMAIN = 'telegram_trx_bot'
BASE_DIR = Path(__file__).resolve().parent
LOCALES_DIR = BASE_DIR/'locales'
ENV_PATH = BASE_DIR.joinpath(".env")

DEFAULT_LOCALE = 'en'
UK_LOCALE = 'uk'
