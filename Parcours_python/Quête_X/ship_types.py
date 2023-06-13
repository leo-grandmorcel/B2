from enum import Enum
from spaceships import Interceptor, Frigate, Bomber, Destroyer, Cruiser


class ShipType(Enum):
    """The type of a ship."""

    INTERCEPTOR = Interceptor
    FRIGATE = Frigate
    BOMBER = Bomber
    DESTROYER = Destroyer
    CRUISER = Cruiser


def get_ship_class_by_name(ship_name: str):
    try:
        return ShipType[ship_name.upper()]
    except KeyError:
        raise ValueError(f"Unknown ship type: {ship_name}")
