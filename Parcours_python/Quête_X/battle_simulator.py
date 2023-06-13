from base_spaceships import Battleship, Spaceship
from fleet import Fleet
import random


class Simulator:
    def __init__(self, att_fleet: Fleet, def_fleet: Fleet):
        self.att_fleet = att_fleet
        self.def_fleet = def_fleet

    def fight(self):
        self._simulate_fight(
            self.att_fleet.alive_battleships, self.def_fleet.alive_battleships
        )
        self._simulate_fight(
            self.att_fleet.alive_fighters, self.def_fleet.alive_fighters
        )
        self._simulate_fight(self.att_fleet.alive_ships, self.def_fleet.alive_ships)

    def get_report(self) -> dict:
        return {
            self.att_fleet.name: self.att_fleet.report,
            self.def_fleet.name: self.def_fleet.report,
        }

    def _duel_fight(attacker: Spaceship, defender: Spaceship):
        """Simulate a duel between two ships"""
        attacker.fire_on(defender)
        if defender.is_alive:
            defender.fire_on(attacker)

    def _simulate_fight(self, attackers: list[Spaceship], defenders: list[Spaceship]):
        """Simulate a fight between two fleets"""
        if len(attackers) == 0 or len(defenders) == 0:
            return
        for attacker in attackers:
            if attacker.is_alive:
                defender = random.choice(defenders)
                Simulator._duel_fight(attacker, defender)
