from itertools import product
from string import ascii_uppercase, digits

with open("alphanumeric-combination.txt", "a") as CombinationFile:
    for a, b, c, d in product(ascii_uppercase, ascii_uppercase, ascii_uppercase, digits):
        CombinationFile.write(f'\n{a}{b}{c}{d}')
        print(f'{a}{b}{c}{d}')
