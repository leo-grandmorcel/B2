from datetime import datetime,timedelta

def build_menu(recipes: list[dict], start_date: datetime.date) -> list[tuple[datetime.date, str]]:
    menu = []
    for recipe in recipes:
        menu.append((start_date, recipe['title']))
        start_date += timedelta(days=1)
    return menu

def save_menu(meals: list[tuple[datetime.date, str]]):
    menu =[f"{meal[0].strftime('%A %d %B %Y')}: {meal[1]}" for meal in meals]
    with open('menu.txt', 'w') as f:
         f.write('\n'.join(menu))