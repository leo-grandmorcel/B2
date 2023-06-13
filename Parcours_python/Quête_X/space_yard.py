from dock import SpaceDock
from base_spaceships import Spaceship
from exceptions import ResourceError


class SpaceYard:
    def __init__(self, dock: SpaceDock):
        self.dock = dock

    def build_ship(
        self,
        fleet_name: str,
        ship_class: Spaceship,
        quantity: int,
        available_metal: int,
        available_crystal: int,
    ):
        if ship_class.requirements.metal > available_metal:
            raise ResourceError(
                f"Not enough metal to build {quantity} {ship_class.__name__}"
            )
        if ship_class.requirements.crystal > available_crystal:
            raise ResourceError(
                f"Not enough crystal to build {quantity} {ship_class.__name__}"
            )
        for _ in range(quantity):
            self.dock[fleet_name].ships.append(ship_class())
