import pygame, sys, math, shop
from manage_map import load_map, save_map
from vars import blocks_type


class ShopButton : 
    def __init__(self, text,  pos, font, bg="black", feedback=""):
        self.x, self.y = pos
        self.font = pygame.font.SysFont("Arial", font)
        self.surface = self.font.render(text, True, bg)
        self.text = self.font.render(text, 1, pygame.Color("White"))
        self.size = self.text.get_size()
        self.rect = pygame.Rect(self.x, self.y, self.size[0], self.size[1])
        if feedback == "":
            self.feedback = "text"
        else:
            self.feedback = feedback
 
    def display_shop():
        shop.main()
 
    def show(self):
        screen.blit(self.surface, (self.x, self.y))
 
    def click(self, event):
        x, y = pygame.mouse.get_pos()
        if event.type == pygame.MOUSEBUTTONDOWN:
            if pygame.mouse.get_pressed()[0]:
                if self.rect.collidepoint(x, y):
                    shop.main()


class Crosshair(pygame.sprite.Sprite):
    global blocks_sprites, player, block_size

    def __init__(self, groups):
        super().__init__(groups)
        self.image = pygame.Surface((1, 1))
        self.image.fill("red")
        self.rect = self.image.get_rect()
        self.rect.center = pygame.mouse.get_pos()
        self.box = pygame.image.load("ores/select.png").convert_alpha()

    def update(self, offset_y):
        self.image = pygame.Surface((1, 1))
        self.rect = self.image.get_rect()
        self.rect.center = pygame.mouse.get_pos()
        collisions = pygame.sprite.spritecollide(self, blocks_sprites, False)
        if collisions:
            for block in collisions:
                if math.dist(player.rect.center, block.rect.center) < block_size * 2:
                    if not block.mined:
                        self.image = self.box
                        self.rect = block.rect.copy()
                    if pygame.mouse.get_pressed()[0]:
                        block.mine()


class BlockType:
    def __init__(
        self,
        name,
        price,
        sturdiness,
        image,
        world_id,
        vein_size,
        rarity,
        height_min,
        height_max,
    ):
        self.name = name
        self.price = price
        self.sturdiness = sturdiness
        self.world_id = world_id
        self.vein_size = vein_size
        self.rarity = rarity
        self.height_min = height_min
        self.height_max = height_max
        self.image = f"ores/{image}"


class Block(pygame.sprite.Sprite):
    global screen_width, screen_height, blocks_sprites, player

    def __init__(self, pos, blocktype: BlockType, groups):
        super().__init__(groups)
        self.blocktype = blocktype
        self.image = pygame.image.load(blocktype.image).convert_alpha()
        self.rect = self.image.get_rect(topleft=pos)
        self.old_rect = self.rect.copy()
        self.mined = False
        self.mining_progress = 0

    def update(self, offset_y):
        self.old_rect = self.rect.copy()
        self.rect.y -= offset_y
        if self.mining_progress >= self.blocktype.sturdiness:
            self.mined = True
            player.add_to_inventory(self.blocktype)
            self.kill()
        elif self.mining_progress > self.blocktype.sturdiness // 2:
            self.image.set_alpha(128)

    def mine(self, decrement=1):
        self.mining_progress += decrement

    def save(self):
        return [self.blocktype.name, self.rect.topleft, self.mining_progress]


class Player(pygame.sprite.Sprite):
    global screen_width, screen_height, gravity, blocks_sprites

    def __init__(self, username, pos, size, groups):
        super().__init__(groups)
        self.username = username
        self.image = pygame.Surface(size)
        self.image.fill("red")
        self.rect = self.image.get_rect(topleft=pos)
        self.old_rect = self.rect.copy()
        self.pos = pygame.math.Vector2(self.rect.center)
        self.direction = pygame.math.Vector2()
        self.speed = 5
        self.on_ground = False
        self.fall_count = 0
        self.pickaxe = None
        self.backpack = None
        self.inventory = {}
        self.balance = 0

    def collision(self, direction):
        collision_sprites = pygame.sprite.spritecollide(self, blocks_sprites, False)
        if collision_sprites:
            if direction == "horizontal":
                for sprite in collision_sprites:
                    # collision on the right
                    if (
                        self.rect.right >= sprite.rect.left
                        and self.old_rect.right <= sprite.old_rect.left
                    ):
                        self.rect.right = sprite.rect.left
                        self.pos.x = self.rect.x

                    # collision on the left
                    if (
                        self.rect.left <= sprite.rect.right
                        and self.old_rect.left >= sprite.old_rect.right
                    ):
                        self.rect.left = sprite.rect.right
                        self.pos.x = self.rect.x

            if direction == "vertical":
                for sprite in collision_sprites:
                    # collision on the bottom
                    if (
                        self.rect.bottom >= sprite.rect.top
                        and self.old_rect.bottom <= sprite.old_rect.top
                    ):
                        self.rect.bottom = sprite.rect.top
                        self.pos.y = self.rect.y
                        self.on_ground = True
                        self.fall_count = 0
                        self.direction.y = 0

                    # collision on the top
                    if (
                        self.rect.top <= sprite.rect.bottom
                        and self.old_rect.top >= sprite.old_rect.bottom
                    ):
                        self.rect.top = sprite.rect.bottom
                        self.pos.y = self.rect.y
                        self.direction.y *= -1

    def window_collision(self, direction):
        if direction == "horizontal":
            # collision on the right
            if self.rect.right > screen_width:
                self.rect.right = screen_width
                self.pos.x = self.rect.x

            # collision on the left
            if self.rect.left < 0:
                self.rect.left = 0
                self.pos.x = self.rect.x

    def move(self):
        keys = pygame.key.get_pressed()
        if keys[pygame.K_i]:  # debug inventory
            print(self.inventory)

        if keys[pygame.K_q] or keys[pygame.K_LEFT]:
            self.direction.x = -1 * self.speed
        elif keys[pygame.K_d] or keys[pygame.K_RIGHT]:
            self.direction.x = 1 * self.speed
        else:
            self.direction.x = 0
        if (keys[pygame.K_SPACE] or keys[pygame.K_UP]) and self.on_ground:
            self.direction.y = -gravity * self.speed
            self.on_ground = False

    def add_to_inventory(self, blocktype: BlockType):
        if blocktype.name not in self.inventory:
            self.inventory[blocktype.name] = 0
        self.inventory[blocktype.name] += 1

    def sell_inventory(self):
        for blocktype in self.inventory:
            self.balance += self.inventory[blocktype] * blocktype.price
        self.inventory = {}

    def update(self, offset_y):
        self.old_rect = self.rect.copy()
        self.pos.y -= offset_y
        self.direction.y += min(1, (self.fall_count / 60) * gravity)
        if self.fall_count < 60:
            self.fall_count += 1
        self.move()
        self.pos += self.direction
        self.rect.x = round(self.pos.x)
        self.rect.y = round(self.pos.y)
        self.window_collision("horizontal")
        self.collision("horizontal")
        self.window_collision("vertical")
        self.collision("vertical")

    def save(self):
        return [self.rect.topleft, self.inventory, self.balance, self.pickaxe, self.backpack]


class Pickaxe:
    def __init__(self, name, mining_speed):
        self.name = name
        self.mining_speed = mining_speed


screen_width = 800
screen_height = 600
block_size = 32
player_size = (24, 56)
gravity = 1
scroll_area = 200
offset_y = 0
ground_level = screen_height - 10 * block_size


all_sprites = pygame.sprite.Group()
blocks_sprites = pygame.sprite.Group()


def create_block_classes():
    for blocktype in blocks_type:
        block_class = type(blocktype["name"], (BlockType,), {})
        globals()[blocktype["name"]] = block_class(
            blocktype["name"],
            blocktype["price"],
            blocktype["sturdiness"],
            blocktype["image"],
            blocktype["world_id"],
            blocktype["vein_size"],
            blocktype["rarity"],
            blocktype["height_min"],
            blocktype["height_max"],
        )


def create_map(map):
    """Create the map from a list of blocks."""
    global blocks_sprites, all_sprites
    for block in map:
        if block[0] != "Air":
            Block(
                block[1],
                globals()[block[0]],
                [all_sprites, blocks_sprites],
            )


pygame.init()
pygame.display.set_caption("DigDeep")
clock = pygame.time.Clock()
screen = pygame.display.set_mode((screen_width, screen_height))
player = Player("eole", (screen_width / 2, 0), player_size, all_sprites)
crosshair = Crosshair(all_sprites)
create_block_classes()
map, saved_player = load_map(player, block_size, screen_width // 32)
create_map(map)
if saved_player:
    player.inventory = saved_player[1]
    player.balance = saved_player[2]
    player.pickaxe = saved_player[3]
    player.backpack = saved_player[4]
    player.pos = pygame.Vector2(saved_player[0])
shop_button= ShopButton("Shop", (700, 0), 30, bg="white", feedback="text")
def main():
    while True:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                save_map(player, blocks_sprites)
                pygame.quit()
                sys.exit()
            shop_button.click(event)
        if player.pos.y > screen_height // 2:
            offset_y = round(player.pos.y - screen_height // 2, 0)
        elif player.pos.y < screen_height // 2 - 50:
            offset_y = -5
        else:
            offset_y = 0

        screen.fill("black")
        all_sprites.update(offset_y)
        all_sprites.draw(screen)
        shop_button.show()
        # display output
        pygame.display.update()
        clock.tick(60)

if __name__ == "__main__":
    main()
