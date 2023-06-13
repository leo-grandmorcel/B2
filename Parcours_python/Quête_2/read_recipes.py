import json

def get_recipes(file_name):
    file = open(file_name, 'r')
    data = json.load(file)          
    file.close()
    return data  
