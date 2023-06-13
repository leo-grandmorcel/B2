import sqlite3 as sql
import os
from vars import worlds, blocks_type


def create_db():
    conn = sql.connect("database.db")
    print("Opened database successfully")

    conn.execute(
        "CREATE TABLE IF NOT EXISTS users (user_id INTEGER NOT NULL,username TEXT NOT NULL UNIQUE,password TEXT NOT NULL,balance INTEGER NOT NULL,inventory_id INTEGER NOT NULL,backpack_id INTEGER NOT NULL,pickaxe_id INTEGER NOT NULL,PRIMARY KEY(user_id AUTOINCREMENT),FOREIGN KEY(backpack_id) REFERENCES backpacks(backpack_id),FOREIGN KEY(pickaxe_id) REFERENCES pickaxes(pickaxe_id),FOREIGN KEY(inventory_id) REFERENCES inventories(inventory_id))"
    )
    conn.execute(
        "CREATE TABLE IF NOT EXISTS blocks_type (block_type_id	INTEGER NOT NULL,name TEXT NOT NULL,price INTEGER NOT NULL,sturdiness INTEGER NOT NULL,image TEXT NOT NULL,world_id INTEGER NOT NULL,vein_size INTEGER NOT NULL,rarity FLOAT NOT NULL,height_min INTEGER NOT NULL,height_max INTEGER NOT NULL,PRIMARY KEY(block_type_id AUTOINCREMENT),FOREIGN KEY(world_id) REFERENCES worlds(world_id))"
    )
    conn.execute(
        "CREATE TABLE IF NOT EXISTS worlds (world_id INTEGER NOT NULL,name TEXT NOT NULL,default_block_id INTEGER NOT NULL,size INTEGER NOT NULL,PRIMARY KEY(world_id AUTOINCREMENT),FOREIGN KEY(default_block_id) REFERENCES blocks_type(block_type_id))"
    )
    conn.execute(
        "CREATE TABLE IF NOT EXISTS backpacks (backpack_id INTEGER NOT NULL,name TEXT NOT NULL,price INTEGER NOT NULL,description	TEXT NOT NULL,capacity INTEGER NOT NULL,PRIMARY KEY(backpack_id AUTOINCREMENT))"
    )
    conn.execute(
        "CREATE TABLE IF NOT EXISTS pickaxes (pickaxe_id INTEGER NOT NULL,price INTEGER NOT NULL,effectiveness FLOAT NOT NULL,image TEXT NOT NULL,PRIMARY KEY(pickaxe_id AUTOINCREMENT))"
    )
    conn.execute(
        "CREATE TABLE IF NOT EXISTS inventories (inventory_id INTEGER NOT NULL,block_id INTEGER NOT NULL,PRIMARY KEY(inventory_id AUTOINCREMENT),FOREIGN KEY(block_id) REFERENCES blocks_type(block_type_id))"
    )
    print("Table created successfully")
    conn.close()


def add_user():
    conn = sql.connect("database.db")
    print("Opened database successfully")
    conn.execute(
        "INSERT INTO users (username,password,balance,inventory_id,backpack_id,pickaxe_id) VALUES ('test','test',0,1,1,1)"
    )
    conn.commit()
    print("Records created successfully")
    conn.close()


def create_worlds(worlds):
    conn = sql.connect("database.db")
    print("Opened database successfully")
    for world in worlds:
        conn.execute(
            f"INSERT INTO worlds (name,default_block_id,size) VALUES ('{world['name']}',{world['default_block_id']},{world['size']})"
        )
    conn.commit()
    conn.close()
    print("Worlds created successfully")


def create_blocks_type(blocks_type):
    conn = sql.connect("database.db")
    print("Opened database successfully")
    for block in blocks_type:
        conn.execute(
            f"INSERT INTO blocks_type (name,price,sturdiness,image,world_id,vein_size,rarity,height_min,height_max) VALUES ('{block['name']}',{block['price']},{block['sturdiness']},'{block['image']}',{block['world_id']},{block['vein_size']},{block['rarity']},{block['height_min']},{block['height_max']})"
        )
    conn.commit()
    conn.close()
    print("Blocks created successfully")


# delete old db
try:
    os.remove("database.db")
except:
    pass
create_db()
create_worlds(worlds)
create_blocks_type(blocks_type)
