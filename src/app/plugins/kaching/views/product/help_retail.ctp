<?php echo $this->element('header', array('plugin'=>'kaching')); ?>

<h2>Product Retail Tab</h2>
<p>This tab is where we assign a product to a store.  You can assign the same product to multiple stores all with different pricing / availability and qty.</p>
<p>
As you can see from the options listed, Kaching supports multiple pricing levels.  Kaching also has the option to have the order meet certain qty levels 
to qualify for discount pricing.  For most stores you will only enter a value for Retail Level 1, but we will give you examples of each scenario.
</p>

<p>
Everytime a product is added to the shopping cart, Kaching compares the enter price with the Retail / Discount levels to see if there is a match.  If
the price does not match one of the product's Retail / Discount levels exactly, then it default to the Retail Level 1 amount.  However, if the product
supports Variable Pricing then the rules change a bit as we will explain below.
</p>

<p>For the Retail examples below all Retail / Discount / Qty Level fields are left as 0, which means ignore, unless otherwise specified.</p>

<p>
<strong>Standard Retail:</strong> What most stores will use.  A retail value is entered in the Retail Level 1 and that will be the single price for the product.  All other
Retail / Discount / Qty Level fields are left as 0, which means ignore.
</p>

<p>
<strong>Standard Discount:</strong> If a value is entered in the Retail Level 1 and Discount Level 1 field, then the product price will be the discount level. Why would we 
do this and not just enter the value in the Retail Level 1.  Sometimes you want to show the customer both values so they can see how much they are saving.
It's also easier to change products back after a sale as ended. (All other Retail / Discount / Qty Level fields are left as 0, which means ignore)
</p>

<p>
<strong>Multiple Pricing Levels:</strong> Products with multiple pricing levels is supported. IE: a flower bouquet that can be purchased for either $25, $50, $75.
In the case Retail Level 1 would be $25, Retail Level 2 would be $50 and Retail Level 3 would be $75.  Typically the user would have a drop down or checkbox to 
select how much they want to spend.  Since the drop down box Retail amount would match one of the Product's Retail Levels everything works fine.
</p>

<p>
<strong>Qty Level Discount:</strong> If you take our flower bouquet example from above except we change Qty level 1 to "1 to 5" and Qty level 2 to "6 to 10" and Qty
level 3 to "11 to 100".  Now, only the qty level is checked for what the retail amount is. 
</p>

<h3>Variable Pricing</h3>
<p>
As we were explaining above, when adding a product to the shopping cart, the product's price must match exactly one of the Retail / Discount levels.  However,
if a product supports variable pricing, Kaching will allow a product price that is equal or between Retail / Discount levels.  IE: If Retail Level 1 is $10 and Retail Level 2 is $20.
The customer selects a price of $15, Kaching will allow this.  However, if they select a price of $5, Kaching will change this value to equal Retail Level 1 or $10.
</p>

<h3>Qty Available</h3>
<p>Kaching supports product qty per store.  If this field is set to -1, then the quantity is unlimited.  Each time a product with a limited qty is purchased, this amount is decreased.</p>
