# Nicknames 

A PHP class and data file that provides an API for looking up nicknames.

# Usage
```php
<?php
use Yooper\Nicknames;
$nicknames = new Nicknames();
// the passed in values are automatically normalized to lowercase
$names = $nicknames->query('Joe');
// nicknames also supports fuzzy matching
$nicknames->fuzzy('oe');
```

# Original Credit 

https://github.com/carltonnorthern/nickname-and-diminutive-names-lookup

A CSV file that containing US given names (first name) and their associated nicknames or diminutive names.

This lookup file was initially created by mining this
<a href="http://www.tngenweb.org/franklin/frannick.htm">genealogy page</a>. Because the lookup is based off of a dataset used for genealogy purposes there are some old names that aren't used commonly these days, but there are recent ones as well. Examples are "gregory", "greg", or "geoffrey", "geoff". There was also a significant effort to make it machine readable, i.e. separate it with commas, remove human conventions, like "rickie(y)" would need to be made into two different names "rickie", and "ricky".

There PHP class for your convenience.

This is a relatively large list with about 1600 names. Any help from people to clean this list up and add to it is greatly appreciated. Think of it as a wiki. Just request to join the project and you'll be added.

This project was created by <a href="http://www.odu.edu/">Old Dominion University</a> - <a href="http://ws-dl.blogspot.com/">Web Science and Digital Libraries Research Group</a>. More information about the creation of this lookup can be found <a href="http://www.carlton-northern.com/2010/08/lookup-for-nicknames-and-diminutive.html">here</a>.


