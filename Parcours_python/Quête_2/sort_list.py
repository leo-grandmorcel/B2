def sort_recipes(recipes, by):
    if by not in ['title','persons']:
        raise ValueError("Invalid sort key")
    return sorted(recipes, key=lambda x: x[by])