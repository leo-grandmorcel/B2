import argparse, datetime
import filter_recipes as fr
import menu as m
import read_recipes as rr
import sort_list as sl
import datetime_utils as dtu
parser = argparse.ArgumentParser(
                    prog='CLI Program',
                    description='a CLI program')
parser.add_argument('-s','--start',required=True)
parser.add_argument('-p','--max-persons',type=int,default=4,required=False)
args = parser.parse_args()
m.save_menu(m.build_menu(fr.filter_recipes(sl.sort_recipes(rr.get_recipes('recipes_data.json'), 'title'),args.max_persons),dtu.parse_time(args.start)))
