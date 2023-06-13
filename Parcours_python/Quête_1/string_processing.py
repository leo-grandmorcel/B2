import string

def tokenize(sentence):
    for p in string.punctuation:
        sentence = sentence.replace(p, " ")
    return sentence.lower().split()
