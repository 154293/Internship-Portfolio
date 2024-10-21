def eicalc(portiegrootte):
    eieren = int(portiegrootte / 4)          #calculates portion size for the eggs
    return eieren

def botercalc(portiegrootte):
    boter = (portiegrootte / 4) * 60         #calculates portion size for the butter
    return boter

def suikercalc(portiegrootte):
    suiker = (portiegrootte / 4) * 50        #calculates portion size for the sugar
    return suiker

def bloemcalc(portiegrootte):
    bloem = (portiegrootte / 4) * 55         #calculates portion size for the flower
    return bloem

def combineer(portiegrootte):
    ei = eicalc(portiegrootte)
    boter = botercalc(portiegrootte)         #combines the functions above and outputs the 4 results
    suiker = suikercalc(portiegrootte)
    bloem = bloemcalc(portiegrootte)
    return ei, boter, suiker, bloem

eiTotaal = 0
boterTotaal = 0                         #declarations for the variables later needed for the total amounts required
suikerTotaal = 0
bloemTotaal = 0

def addToTotal(eiTotal, eiOne, boterTotal, boterOne, suikerTotal, suikerOne, bloemTotal, bloemOne):
    eiTotal += eiOne
    boterTotal += boterOne                 #function that increments the totals with the outcome of the singular recipe
    suikerTotal += suikerOne
    bloemTotal += bloemOne
    return eiTotal, boterTotal, suikerTotal, bloemTotal

ei1, boter1, suiker1, bloem1 = combineer(12)
print(f"Voor een portie van 12 heb ik {ei1} eieren, {boter1}g boter, {suiker1}g suiker, {bloem1}g bloem nodig.")
eiTotaal, boterTotaal, suikerTotaal, bloemTotaal = addToTotal(eiTotaal, ei1, boterTotaal, boter1, suikerTotaal, suiker1, bloemTotaal, bloem1)
ei1, boter1, suiker1, bloem1 = combineer(24)
print(f"Voor een portie van 24 heb ik {ei1} eieren, {boter1}g boter, {suiker1}g suiker, {bloem1}g bloem nodig.")
eiTotaal, boterTotaal, suikerTotaal, bloemTotaal = addToTotal(eiTotaal, ei1, boterTotaal, boter1, suikerTotaal, suiker1, bloemTotaal, bloem1)
ei1, boter1, suiker1, bloem1 = combineer(52)
print(f"Voor een portie van 52 heb ik {ei1} eieren, {boter1}g boter, {suiker1}g suiker, {bloem1}g bloem nodig.")
eiTotaal, boterTotaal, suikerTotaal, bloemTotaal = addToTotal(eiTotaal, ei1, boterTotaal, boter1, suikerTotaal, suiker1, bloemTotaal, bloem1)

print(f"In totaal heb ik {eiTotaal} eieren, {boterTotaal}g boter, {suikerTotaal}g suiker, {bloemTotaal}g bloem nodig.")
