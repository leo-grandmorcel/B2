days ={ 1:"Monday", 2:"Tuesday", 3:"Wednesday", 4:"Thursday", 5:"Friday", 6:"Saturday", 7:"Sunday"}

def day_from_number(day_number):
    if day_number is None or day_number < 1 or day_number > 7:
        return None
    return days.get(day_number)

def day_to_number(day):
    if day is None or day not in days.values():
        return None
    return list(days.keys())[list(days.values()).index(day)]