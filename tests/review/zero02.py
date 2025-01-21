"""
Loops:
for letra in "Palavra": print letra
while contador < 4: print (contador) contador += 1
while (True) ... if (condition) break or continue
else: executa algo após o termino de um loop sem erros
"""

matriz = []
linhas = 3
colunas = 3

valor = 1
for i in range(linhas):
    linha = []
    for j in range(colunas):
        linha.append(valor)
        valor += 10
    matriz.append(linha)

for linha in matriz:
    print(linha)
else:
    print('fim')
