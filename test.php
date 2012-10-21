<pre>
<?php

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


$shopping_list = new UBBList("Mini Market");
print_r($shopping_list->title());
print_r("\n\n");


$shopping_list->set_title('Farmers Market');
print_r($shopping_list->title());
print_r("\n\n");


$shopping_list->add_item('Strawberries');
$shopping_list->add_items('Apples','Pines');
print_r($shopping_list->items());
print_r("\n\n");


$shopping_list->insert_item(1,'Cherries');
print_r($shopping_list->items());
print_r("\n\n");


$shopping_list->remove_item(2,'Cherries');
print_r($shopping_list->items());
print_r("\n\n");


print_r($shopping_list->get_item(1));
print_r("\n\n");


print_r($shopping_list->creation_date());


?>
</pre>