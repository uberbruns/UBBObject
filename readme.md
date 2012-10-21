
UBBObject
=========

Example Class
-------------

```php
require_once "class.ubbobject.php";

class UBBList extends UBBObject {

	protected $items;
	protected $title;
	protected $creation_date;

	public function __construct($new_title = "") {

		parent::__construct();

		$this->title = $new_title;
		$this->items = array();
		$this->creation_date = time();

 		$this->synthesize("title", "items");
 		$this->synthesize_readonly("creation_date");
	
	}

}
```

Usage
-----

```php
$shopping_list = new UBBList("Mini Market");
print_r($shopping_list->title());
// -> Mini Market


$shopping_list->set_title('Farmers Market');
print_r($shopping_list->title());
// -> Farmers Market


$shopping_list->add_item('Apples');
$shopping_list->add_item('Pines');
$shopping_list->add_item('Strawberries');
print_r($shopping_list->items());

// -> Array
// (
//     [0] => Apples
//     [1] => Pines
//     [2] => Strawberries
// )


$shopping_list->insert_item(1,'Cherries');
print_r($shopping_list->items());

// -> Array
// (
//     [0] => Apples
//     [1] => Cherries
//     [2] => Pines
//     [3] => Strawberries
// )


$shopping_list->remove_item(2,'Cherries');
print_r($shopping_list->items());

// -> Array
// (
//     [0] => Apples
//     [1] => Cherries
//     [2] => Strawberries
// )

print_r($shopping_list->creation_date());

// -> 1350816671
```




The MIT License
---------------

Copyright (c) 2012 Karsten Bruns (karsten{at}bruns{dot}me)

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.