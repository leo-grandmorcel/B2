from fleet import Fleet


class SpaceDock:
    def __init__(self) -> None:
        self.fleets = {"default": Fleet("default", [])}

    def __getitem__(self, fleet_name: str) -> Fleet:
        if fleet_name not in self.fleets:
            self.fleets[fleet_name] = Fleet(fleet_name, [])
        return self.fleets[fleet_name]

    def __setitem__(self, fleet_name: str, ships: list):
        if fleet_name not in self.fleets:
            self.fleets[fleet_name] = Fleet(fleet_name, ships)

    def __delitem__(self, fleet_name: str):
        if fleet_name not in self.fleets:
            raise ValueError("Fleet does not exist")
        del self.fleets[fleet_name]

    def __str__(self) -> str:
        return f"{', '.join([f'{fleet_name}: {len(fleet.ships)} ships' for fleet_name, fleet in self.fleets.items()])}"
