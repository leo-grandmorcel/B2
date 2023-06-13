
def do_punishment(first_part, second_part, nb_lines):
    return " ".join([first_part.strip() + " " + second_part.strip() + "." for i in range(nb_lines)])