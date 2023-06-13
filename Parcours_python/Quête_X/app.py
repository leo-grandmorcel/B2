import os
from fleet import Fleet
from fastapi import FastAPI, Response, status
from ship_types import get_ship_class_by_name
from space_yard import SpaceYard
from exceptions import ResourceError
from dock_repositories import SpaceDockFileRepository, SpaceDockInMemoryRepository


def init_dock_repository():
    env = os.environ.get("DOCK_REPOSITORY").lower()
    match env:
        case "in_memory":
            return SpaceDockInMemoryRepository()
        case "file":
            return SpaceDockFileRepository(file_name="fleets.pickle")
        case _:
            raise ValueError(f"Repository {env} does not exist")


os.environ["DOCK_REPOSITORY"] = "file"
app = FastAPI()


@app.get("/ship/fleet/{fleet_name}", status_code=status.HTTP_200_OK)
async def get_fleet(fleet_name: str):
    dock = init_dock_repository().load()
    return dock[fleet_name].get_report()


@app.post("/ship", status_code=status.HTTP_201_CREATED)
async def add_ship(request: dict, response: Response):
    response.status_code = status.HTTP_201_CREATED
    dock = init_dock_repository()
    spacedock = dock.load()
    try:
        ship = get_ship_class_by_name(request["ship_name"])
    except ValueError:
        response.status_code = status.HTTP_404_NOT_FOUND
        return
    try:
        yard = SpaceYard(spacedock)
        yard.build_ship(
            request["fleet_name"],
            ship.value,
            request["quantity"],
            request["metal_stock"],
            request["crystal_stock"],
        )
    except ResourceError:
        response.status_code = status.HTTP_400_BAD_REQUEST
        return
    if response.status_code == status.HTTP_201_CREATED:
        dock.save(spacedock)
