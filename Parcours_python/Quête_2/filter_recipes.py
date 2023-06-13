def filter_recipes(recipes: list[dict], max_persons: int):
    return [recipe for recipe in recipes if recipe['persons'] < max_persons]

