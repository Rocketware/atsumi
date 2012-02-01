<?php

class widget_SelectElement extends widget_AbstractElement {
	private $options = array();
	private $blankMessage = "Please Select";

	public function __construct($args) {
		$this->options = $args['options'];
		if(array_key_exists('blank', $args))
			$this->blankMessage = $args['blank'];
	}
	function renderElement() {
		$optionHtml = "";
		$elementValue = $this->getValue();

		if(!$this->defaultValue && $this->blankMessage)
			$optionHtml .= sfl("<option value='' >%s</option>", $this->blankMessage);
		elseif($this->defaultValue) {
			// TODO: put this in a func...
			foreach($this->defaultValue as $value => $option) {
				if(strval($elementValue) == strval($value))
					$optionHtml .= sfl("<option value='%s' selected='selected'>%s</option>",
										$value,
										$option
					);
				else
					$optionHtml .= sfl("<option value='%s'>%s</option>",
										$value,
										$option
					);
			}

		}
		foreach($this->options as $value => $option) {
			if(strval($elementValue) == strval($value))
				$optionHtml .= sfl("<option value='%s' selected='selected'>%s</option>",
									$value,
									$option
				);
			else
				$optionHtml .= sfl("<option value='%s'>%s</option>",
									$value,
									$option
				);
		}

		return(	sfl("<select name='%s' %s id='form_%s' class='inputSelect'>%s</select>",
						$this->getName(),
						($this->tabindex) ? sf('tabindex="%s"', $this->tabindex) : '',
						$this->getName(),
						$optionHtml

					)
				);
	}
}

?>