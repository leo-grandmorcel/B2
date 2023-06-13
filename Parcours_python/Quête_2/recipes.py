def create_recipe(name,persons,ingredients):
    if len(name)>150:
        raise ValueError("Title is too long")
    if persons==0 or persons>50:
        raise ValueError("Invalid persons number")
    if len(ingredients)==0:
        raise ValueError("This recipe has no ingredients")
    return {
        'title':name,
        'persons':persons,
        'ingredients':ingredients
        }

def create_recipe_v2(title,persons,*ingredients,**tags):
    if len(title)>150:
        raise ValueError("Title is too long")
    if persons==0 or persons>50:
        raise ValueError("Invalid persons number")
    if len(ingredients)==0:
        raise ValueError("This recipe has no ingredients")
    return {
        'title':title,
        'persons':persons,
        'ingredients':ingredients,
        'tags':tags
    }