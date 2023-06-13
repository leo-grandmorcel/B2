from datetime import datetime as dt

def parse_time(time_str: str)-> dt.time:
    return dt.strptime(time_str, '%d/%m/%Y')

def format_date(date: dt.date)-> str:
    return date.strftime('%A %d %B %Y')