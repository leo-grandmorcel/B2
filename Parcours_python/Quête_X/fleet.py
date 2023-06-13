from base_spaceships import Battleship, Fighter, Spaceship


class Fleet:
    def __init__(self, name, ships: list[Spaceship]):
        self.name = name
        self.ships = ships

    def get_all_alive_ships(self) -> list[Spaceship]:
        """Return a list of all the alive ships in the fleet"""
        return [ship for ship in self.ships if ship.is_alive]

    def get_alive_battleships(self) -> list[Battleship]:
        """Return a list of all the alive battleships in the fleet"""
        return [
            ship
            for ship in self.ships
            if ship.is_alive and isinstance(ship, Battleship)
        ]

    def get_alive_fighters(self) -> list[Fighter]:
        """Return a list of all the alive fighters in the fleet"""
        return [
            ship for ship in self.ships if ship.is_alive and isinstance(ship, Fighter)
        ]

    def get_report(self) -> dict:
        return {
            "alive_battleships": len(self.get_alive_battleships()),
            "alive_fighters": len(self.get_alive_fighters()),
            "dead_battleships": len(
                [
                    ship
                    for ship in self.ships
                    if isinstance(ship, Battleship) and not ship.is_alive
                ]
            ),
            "dead_fighters": len(
                [
                    ship
                    for ship in self.ships
                    if isinstance(ship, Fighter) and not ship.is_alive
                ]
            ),
        }

    alive_fighters = property(get_alive_fighters)
    alive_ships = property(get_all_alive_ships)
    alive_battleships = property(get_alive_battleships)
    report = property(get_report)

    def __add__(self, ship: Spaceship):
        """Add a ship to the fleet"""
        if isinstance(ship, list):
            self.ships.extend(ship)
        else:
            self.ships.append(ship)
        return self
