<?php

class Produto {
	public $marca;
	private $barCode;

	public function __construct(string $marca = 'made in China')
	{
		$this->marca = $marca;	
	}

	public function setBarCode(string $barCode)
	{
		$this->barCode = $barCode;
	}

	public function getBarCode()
	{
		return $this->barCode;
	}
}

$meia = new Produto('Meia');
$meia->setBarCode('12345678910');
echo $meia->getBarCode();
