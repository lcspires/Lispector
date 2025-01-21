"""
Reserved Words:
True, False, None, and, as, assert, break, class, def, del, except,
return, for, from, global, try, import, in, is, lambda, while, not, or,
finally, continue, nonlocal, with, yield, if, elif, else, pass, raise.
"""

PI = 3.14159 #Constante
peso = 62.6 #Variável

boolean = False # or True
string = 'text' # or anything
integer = 0x1A  # hexadecimal (26)
floating = 1.2e3 # notação científica
lista = ['a', 'e', 'i', 'o', 'u']
tupla = (4, 2) # sequência imutável
dicionario = {'nome':'Lucas', 'idade':29}
conjunto = {2, 4, 6, 8, 10}
null = None # ausência de valor

print(type(string), type(boolean), type(integer), type(floating), type(lista))
print(type(tupla), type(dicionario), type(conjunto), type(null))

x = 10 # integer
x = float(x) # 10.0
x = str(x) # "10.0"