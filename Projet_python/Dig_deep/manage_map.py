import pickle, sqlite3, random
from noise import pnoise2


def generate_map(width, block_size):
    """Compile all world generation into one map."""
    map = []
    conn = sqlite3.connect("database.db")
    conn.row_factory = sqlite3.Row
    cursor = conn.cursor()
    worlds = [dict(row) for row in cursor.execute("SELECT * FROM worlds")]
    for world in worlds:
        cursor.execute(
            f"SELECT name FROM blocks_type WHERE block_type_id = {world['default_block_id']}"
        )
        default_block = dict(cursor.fetchone())["name"]
        cursor.execute(
            f"SELECT * FROM blocks_type WHERE world_id = {world['world_id']}"
        )
        ores = [dict(row) for row in cursor.fetchall()]
        tmp_map = [[default_block for _ in range(width)] for _ in range(world["size"])]
        map.extend(add_ores(tmp_map, default_block, ores))
    map.insert(0, ["Air" for _ in range(width)])
    map.append(["Bedrock" for _ in range(width)])
    conn.close()
    new_map = []
    for y in range(len(map)):
        for x in range(len(map[y])):
            new_map.append([map[y][x], (x * block_size, y * block_size), 0])
    return new_map


def add_ores(map, default_block, ores):
    """Add ore blocks to the given map of blocks."""
    for index, ore in enumerate(ores):
        for y in range(len(map)):
            for x in range(len(map[y])):
                block_type = map[y][x]
                if (
                    block_type != default_block
                    or y < ore["height_min"]
                    or y > ore["height_max"]
                ):
                    continue
                noise_val = pnoise2(
                    x / 3,
                    y / 3,
                    octaves=10,
                    persistence=0.5,
                    base=index,
                )
                if abs(noise_val) < ore["rarity"]:
                    # if abs(noise_val) < 0.3:
                    continue
                vein = [(x, y)]
                vein_size_left = random.randint(1, ore["vein_size"])
                while vein_size_left > 0 and vein:
                    current_x, current_y = vein.pop(random.randint(0, len(vein) - 1))
                    map[current_y][current_x] = ore["name"]
                    vein_size_left -= 1
                    for dx, dy in [(1, 0), (-1, 0), (0, 1), (0, -1)]:
                        new_x, new_y = current_x + dx, current_y + dy
                        if (
                            new_x >= 0
                            and new_x < len(map[0])
                            and new_y >= 0
                            and new_y < len(map)
                            and map[new_y][new_x] == default_block
                        ):
                            vein.append((new_x, new_y))
    return map


def save_map(player, blocks_sprites):
    """Save the map to a file."""
    filename = f"maps/{player.username}.map"
    map = [block.save() for block in blocks_sprites]
    map.append(player.save())
    with open(filename, "wb") as f:
        pickle.dump(map, f)


def load_map(player, block_size, width):
    """Load the map from a file."""
    filename = f"maps/{player.username}.map"
    saved_player = None
    try:
        with open(filename, "rb") as f:
            map = pickle.load(f)
            saved_player = map.pop()
    except FileNotFoundError:
        map = generate_map(width, block_size)

    return map, saved_player
