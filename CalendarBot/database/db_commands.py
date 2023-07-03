# from database.db_api import db_pool


try:

    async def check_user_existence(pool, telegram_id):
        async with pool.acquire() as conn:
            async with conn.cursor() as cursor:
                query = "SELECT COUNT(*) FROM users WHERE telegram_id = %s"
                await cursor.execute(query, (telegram_id,))
                count = await cursor.fetchone()
        return count[0] > 0


    async def select_email(pool, message_text):
        async with pool.acquire() as conn:
            async with conn.cursor() as cursor:
                query = "SELECT email FROM users WHERE email = %s"
                await cursor.execute(query, (message_text,))
                result = await cursor.fetchone()
        return result[0] if result else None


    async def reg_user(pool, email, username, user_id):
        async with pool.acquire() as conn:
            async with conn.cursor() as cursor:
                query = "UPDATE users SET telegram = %s, telegram_id = %s WHERE email = %s"
                params = (username, user_id, email)
                await cursor.execute(query, params)



    async def get_users(pool):
        async with pool.acquire() as conn:
            async with conn.cursor() as cursor:
                query = "SELECT telegram_id FROM users"
                await cursor.execute(query)
                users = cursor.fetchall()
        return users


    async def get_title_start(pool, telegram_id):
        async with pool.acquire() as conn:
            async with conn.cursor() as cursor:
                query = "SELECT title, start_date, end_date, id FROM messages_telegrams WHERE telegram_id = %s AND start_date <= NOW() AND start_message = 0"
                await cursor.execute(query, (telegram_id,))
                messages = cursor.fetchall()
        return messages

    async def get_title_end(pool, telegram_id):
        async with pool.acquire() as conn:
            async with conn.cursor() as cursor:
                query = "SELECT title, start_date, end_date, id FROM messages_telegrams WHERE telegram_id = %s AND end_date <= NOW() AND end_message = 0"
                await cursor.execute(query, (telegram_id,))
                messages = cursor.fetchall()
        return messages


    async def send_message_start(pool, user_id, message_id):
        async with pool.acquire() as conn:
            async with conn.cursor() as cursor:
                query = "UPDATE messages_telegrams SET start_message = 1 WHERE id = %s AND telegram_id = %s"
                params = (message_id, user_id)
                await cursor.execute(query, params)
                await conn.commit()

    async def send_message_end(pool, user_id, message_id):
        async with pool.acquire() as conn:
            async with conn.cursor() as cursor:
                query = "UPDATE messages_telegrams SET end_message = 1 WHERE id = %s AND telegram_id = %s"
                params = (message_id, user_id)
                await cursor.execute(query, params)
                await conn.commit()


except Exception as _ex:
    print("[INFO] Error while working with MySQL", _ex)

