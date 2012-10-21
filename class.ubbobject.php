<?php


class UBBObject {


	protected $synthesized_accessors;
	protected $synthesized_readonly_accessors;


	public function __construct() {


		$this->synthesized_accessors = array();
		$this->synthesized_readonly_accessors = array();

	
	}


	protected function synthesize() {

		$property_names  = func_get_args();
		$this->synthesized_accessors = array_merge($this->synthesized_accessors, $property_names);

	}


	protected function synthesize_readonly() {

		$property_names  = func_get_args();
		$this->synthesized_readonly_accessors = array_merge($this->synthesized_readonly_accessors, $property_names);

	}



	public function __call($name, $arguments) {


		// Get
		if (in_array($name, $this->synthesized_accessors) || in_array($name, $this->synthesized_readonly_accessors)) {
			return $this->_synthesized_get($name);
		}


		// Other than Simple Get
		$first_delimiter = strpos($name, "_");
		$action = substr($name, 0, $first_delimiter);
		$property = substr($name, $first_delimiter+1);


		// Singular/Plural-Problem
		$last_char = substr($property, -1);
		$plural_property = ($last_char == "y") ? substr($property, 0, -1)."ies" : $property."s";
		if (isset($this->$plural_property)) $property = $plural_property;


		// Writable?
		$writable = in_array($property, $this->synthesized_accessors);


		// Set
		if ($action == "set" && $writable) {
			return $this->_synthesized_set($property, $arguments);
		}


		// Array?
		if (is_array($this->$property)) {


			// Get Object At Index. "$obj->get_item(0);"
			if ($action == "get") {
				return $this->_synthesized_array_get($property, $arguments);
			}


			// Just write actions follow
			if ($writable) {


				// Add Objects At Index: "$obj->add_item($newItem);"
				if ($action == "add") {
					return $this->_synthesized_array_add($property, $arguments);
				}


				// Insert Object At Index: "$obj->insert_item(0, $newItem);"
				if ($action == "insert") {
					return $this->_synthesized_array_insert($property, $arguments);
				}


				// Remove Object At Index: "$obj->remove_item(1);"
				if ($action == "remove") {
					return $this->_synthesized_array_remove($property, $arguments);
				}


			}


		}

		// Nothing to do
		throw new InvalidArgumentException();
		return false;

	}


	protected function _synthesized_get($property) {
		return $this->$property;
	}


	protected function _synthesized_set($property, $arguments) {
		$this->$property = $arguments[0];
	}


	protected function _synthesized_array_get($property, $arguments) {
		$array = $this->$property;
		return $array[$arguments[0]];
	}


	protected function _synthesized_array_add($property, $arguments) {
		if ($arguments) $this->$property = array_merge($this->$property, $arguments);
	}


	protected function _synthesized_array_insert($property, $arguments) {
		$index = $arguments[0];
		array_splice($arguments, 0, 1);
		array_splice($this->$property, $index, 0, $arguments);
	}


	protected function _synthesized_array_remove($property, $arguments) {
		array_splice($this->$property, $arguments[0], 1);
	}


}

?>