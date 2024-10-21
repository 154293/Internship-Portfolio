operatie = input("Welke operatie wil je uitvoeren? (+, -, *, / of %)\n")
operators = ["+", "-", "*", "/", "%"]
if operatie in operators:                                         #if it's the right operator, it tries the rest of the code
    getal1 = input("Eerste getal?\n")
    try:
        getal1 = float(getal1)                                    #tries to turn first number into float 
    except ValueError:
        print("Kan", getal1, "niet omzetten naar een getal")      #prints error and exits code if it doesn't work
        exit()
    getal2 = input("Tweede getal?\n")
    try:
        getal2 = float(getal2)                                    #tries to turn second number into float (could be done with function)
    except ValueError:
        print("Kan", getal2, "niet omzetten naar een getal")      #prints error and exits code if it doesn't work
        exit()
    if operatie == "+":
        print("Resultaat:", getal1 + getal2)
    elif operatie == "-":
        print("Resultaat:", getal1 - getal2)
    elif operatie == "*":
        print("Resultaat:", getal1 * getal2)
    elif operatie == "/":
        if getal2 != 0:
            print("Resultaat:", getal1 / getal2)
        else:
            print("Kan niet delen door 0")                       #checks if the 2nd number is 0, and exits if it is (only for / and %)
    elif operatie == "%":
        if getal2 != 0:
            print("Resultaat:", getal1 %getal2)
        else:
            print("Kan niet delen door 0")
    else:
        print("Dat is geen operatie!")
else:                                                                              #if it isn't a valid operator, it gives error and exits
    print(operatie, "is geen geldige operatie. Kies een van +, -, *, / of %")
    exit()
