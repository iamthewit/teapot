Ideas:

Maybe we should have one parent class called Vessel?
Extend it for Teapots and Mugs (they both need the same methods and properties)
The Teapot class can then have status' appropriate to a Teapot such as:
 - brewed - returns true false on whether the state of the tea is brewed or not
 - tea bags - number of tea bags in the pot
    - just to take this further than it needs to go TeaBag could be a class which requires you to provide the brand of TeaBag in order to construct it
Make Teapot abstract and move the static constructors to the instantiating classes

Unsure whether this is actually a good idea.... Need to do some more research and reading

Need to come up with a name for the domain:
Cuppa
Beverage
Drink