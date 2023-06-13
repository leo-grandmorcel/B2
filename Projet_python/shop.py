import pygame
import sys
import game
from vars import Allpickaxes, Allbackpacks

pygame.font.init()
my_font = pygame.font.SysFont("Comic Sans MS", 30)
screen = pygame.display.set_mode((800, 600))
bg = pygame.image.load("backgrounds/shop.jpg").convert()
bg.set_alpha(128)
bg = pygame.transform.scale(bg, (800, 600))


def draw_at(text, x, y):
    result = my_font.render(text, False, (0, 0, 0))
    screen.blit(result, (x, y))


class ExitButton:
    def __init__(self, text, pos, font, bg="black", feedback=""):
        self.x, self.y = pos
        self.font = pygame.font.SysFont("Comic Sans MS", font)
        self.surface = self.font.render(text, True, bg)
        self.text = self.font.render(text, 1, pygame.Color("White"))
        self.size = self.text.get_size()
        self.rect = pygame.Rect(self.x, self.y, self.size[0], self.size[1])
        if feedback == "":
            self.feedback = "text"
        else:
            self.feedback = feedback

    def show(self):
        screen.blit(button.surface, (self.x, self.y))

    def click(self, event):
        x, y = pygame.mouse.get_pos()
        if event.type == pygame.MOUSEBUTTONDOWN:
            if pygame.mouse.get_pressed()[0]:
                if self.rect.collidepoint(x, y):
                    game.main()

class Backpack:
    def __init__(self, price, capacity, name, description, image):
        self.image = pygame.image.load(image)
        self.image = pygame.transform.scale(self.image, (100, 100))
        self.rect = self.image.get_rect()
        self.rect.x = 0
        self.rect.y = 0
        self.price = price
        self.name = name
        self.capacity = capacity
        self.description = description


class Pickaxe:
    def __init__(self, price, efficiency, name, description, image):
        self.image = pygame.image.load(image)
        self.image = pygame.transform.scale(self.image, (100, 100))
        self.rect = self.image.get_rect()
        self.rect.x = 0
        self.rect.y = 0
        self.price = price
        self.name = name
        self.efficiency = efficiency
        self.description = description


class Shop:
    def __init__(self, pickaxes, backpacks):
        self.pickaxes = pickaxes
        self.backpacks = backpacks
        self.current_pickaxe = 0
        self.current_backpack = 0

    def buy_pickaxe(self, player):
        if (
            player.balance >= self.pickaxes[self.current_pickaxe].price
            and player.pickaxe != self.pickaxes[self.current_pickaxe]
        ):
            player.balance -= self.pickaxes[self.current_pickaxe].price
            player.pickaxe = self.pickaxes[self.current_pickaxe]
            if self.current_pickaxe != len(self.pickaxes) - 1:
                self.current_pickaxe += 1

        else:
            draw_at("You can't buy this pickaxe", 500, 100)

    def buy_backpack(self, player):
        if (
            player.balance >= self.backpacks[self.current_backpack].price
            and player.backpack != self.backpacks[self.current_backpack]
        ):
            player.balance -= self.backpacks[self.current_backpack].price
            player.backpack = self.backpacks[self.current_backpack]
            player.capacity += self.backpacks[self.current_backpack].capacity
            if self.current_backpack != len(self.backpacks) - 1:
                self.current_backpack += 1
        else:
            draw_at("You can't buy this backpack", 500, 0)

    def draw(self, screen, player):
        draw_at("balance :" + str(player.balance) + " $", 0, 0)
        draw_at(str(self.pickaxes[self.current_pickaxe].price) + " $", 250, 350)
        draw_at(str(self.backpacks[self.current_backpack].price) + " $", 600, 350)
        draw_at(str(self.pickaxes[self.current_pickaxe].name), 150, 150)
        draw_at(str(self.backpacks[self.current_backpack].name), 500, 150)
        draw_at(str(self.pickaxes[self.current_pickaxe].description), 150, 300)
        draw_at(str(self.backpacks[self.current_backpack].description), 500, 300)
        screen.blit(self.pickaxes[self.current_pickaxe].image, (200, 200))
        screen.blit(self.backpacks[self.current_backpack].image, (550, 200))
        pygame.display.flip()


class BuyButton:
    def __init__(self, text, pos, font, bg="black", feedback=""):
        self.x, self.y = pos
        self.font = pygame.font.SysFont("Comic Sans MS", font)
        self.surface = self.font.render(text, True, bg)
        self.text = self.font.render(text, 1, pygame.Color("White"))
        self.size = self.text.get_size()
        self.rect = pygame.Rect(self.x, self.y, self.size[0], self.size[1])
        if feedback == "":
            self.feedback = "text"
        else:
            self.feedback = feedback

    def show(self):
        screen.blit(self.surface, (self.x, self.y))

    def click(self, event):
        x, y = pygame.mouse.get_pos()
        if event.type == pygame.MOUSEBUTTONDOWN:
            if pygame.mouse.get_pressed()[0]:
                if self.rect.collidepoint(x, y):
                    if event.pos[0] < 800 / 2:
                        shop.buy_pickaxe(game.player)
                    else:
                        shop.buy_backpack(game.player)


button = ExitButton("EXIT", (700, 000), font=30, bg="black")
buyP = BuyButton("BUY :", (500, 350), font=30)
buyB = BuyButton("BUY :", (150, 350), font=30)
pygame.init()
clock = pygame.time.Clock()
shop = Shop([], [])
for pick in Allpickaxes:
    shop.pickaxes.append(
        Pickaxe(
            pick["price"],
            pick["mining_speed"],
            pick["name"],
            pick["description"],
            pick["image"],
        )
    )
for back in Allbackpacks:
    shop.backpacks.append(
        Backpack(
            back["price"],
            back["capacity"],
            back["name"],
            back["description"],
            back["image"],
        )
    )


def main():
    while True:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                pygame.quit()
                sys.exit()
            elif event.type == pygame.MOUSEBUTTONDOWN:
                pass
            button.click(event)
            buyP.click(event)
            buyB.click(event)
        screen.fill("white")
        screen.blit(bg, (0, 0))
        shop.draw(screen, game.player)
        button.show()
        buyP.show()
        buyB.show()
        pygame.display.flip()
        clock.tick(60)


if __name__ == "__main__":
    main()
