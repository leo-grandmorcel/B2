def remember_the_milk(shopping_list):
    shopping_list = [item.strip().lower() for item in shopping_list]
    if len(shopping_list)==0 or 'milk' in shopping_list:
        return shopping_list
    shopping_list.append('milk')
    return shopping_list


def clean_list(shopping_list):
    return [str(i+1)+"/ "+item.title() for i,item in enumerate(remember_the_milk(shopping_list))]