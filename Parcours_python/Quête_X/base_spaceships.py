from requirements import Requirements


class Spaceship:
    is_alive = True
    requirements: Requirements

    def __init__(self, attack=0, defense=0):
        self.attack = attack
        self.defense = defense

    def take_damages(self, damage):
        """Take damages and update the defense attribute. DBHJFKGJNJDFIGJNJFGJHBNJDIGBJDFJG BNDJIFBNJUDF"""
        if damage < 0:
            raise ValueError("Damage cannot be negative")
        self.defense -= damage
        if self.defense <= 0:
            self.is_alive = False
            self.defense = 0
        return self

    def fire_on(self, other):
        """Fire on another spaceship and update its defense"""
        return other.take_damages(self.attack)


class Battleship(Spaceship):
    """A battleship is a spaceship with a lot of defense and attack"""


class Fighter(Spaceship):
    """A fighter is a spaceship with a lot of attack but not much defense"""
