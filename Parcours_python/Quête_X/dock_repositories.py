from dock import SpaceDock
from abc import ABC, abstractmethod
import pickle, os


class SpaceDockRepository(ABC):
    @abstractmethod
    def save(self, dock: SpaceDock) -> None:
        pass

    @abstractmethod
    def load(self) -> SpaceDock:
        pass


class SpaceDockFileRepository(SpaceDockRepository):
    def __init__(self, file_name):
        self.file_name = file_name

    def save(self, dock: SpaceDock) -> None:
        file = open(self.file_name, "wb")
        pickle.dump(dock, file)
        file.close()

    def load(self) -> SpaceDock:
        if not os.path.exists(self.file_name):
            return SpaceDock()
        file = open(self.file_name, "rb")
        dock = pickle.load(file)
        file.close()
        return dock


class SpaceDockInMemoryRepository(SpaceDockRepository):
    def save(self, dock: SpaceDock) -> None:
        self.dock = dock

    def load(self) -> SpaceDock:
        return self.dock
