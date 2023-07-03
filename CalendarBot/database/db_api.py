import aiomysql


async def create_pool():
    config = {
        'host': '127.0.0.1',
        'port': 3306,
        'user': 'root',
        'password': '',
        'db': 'test-its',
        'autocommit': True,
    }
    pool = await aiomysql.create_pool(**config)
    return pool

