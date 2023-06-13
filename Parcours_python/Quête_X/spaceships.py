from base_spaceships import Battleship, Fighter, Spaceship
from requirements import Requirements


class BattleshipKiller(Spaceship):
    """A Battleship killer is a spaceship with a lot of attack and defense"""

    def fire_on(self, other):
        if isinstance(other, Battleship):
            other.take_damages(self.attack * 2)
        else:
            other.take_damages(self.attack)
        return other


class FighterKiller(Spaceship):
    """A fighter killer is a spaceship with a lot of attack and defense"""

    def fire_on(self, other):
        if isinstance(other, Fighter):
            other.take_damages(self.attack * 2)
        else:
            other.take_damages(self.attack)
        return other


class Interceptor(FighterKiller, Fighter):
    """An interceptor is a spaceship with a lot of attack and defense"""

    requirements = Requirements(1000, 200)

    def __init__(self, attack=180, defense=1000):
        super().__init__(attack, defense)


class Bomber(BattleshipKiller, Fighter):
    """A bomber is a spaceship with a lot of attack and defense"""

    requirements = Requirements(2500, 400)

    def __init__(self, attack=150, defense=2000):
        super().__init__(attack, defense)


class Cruiser(Battleship):
    """A cruiser is a spaceship with a lot of attack and defense"""

    requirements = Requirements(25000, 10000)

    def __init__(self, attack=800, defense=3000):
        super().__init__(attack, defense)


class Frigate(FighterKiller, Battleship):
    """A frigate is a spaceship with a lot of attack and defense"""

    requirements = Requirements(10000, 10000)

    def __init__(self, attack=500, defense=2500):
        super().__init__(attack, defense)


class Destroyer(BattleshipKiller, Battleship):
    """A destroyer is a spaceship with a lot of attack and defense"""

    requirements = Requirements(35000, 20000)

    def __init__(self, attack=650, defense=5000):
        super().__init__(attack, defense)
