import datetime as dt

def with_current_date(function):
    def func(*args, **kwargs):
        return function(*args, current_date=dt.date.today(), **kwargs)
    return func