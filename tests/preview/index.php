<?php

class Produto {
	public $id;
	public $marca;
	private $barCode;

	public function __construct(int $id, string $marca = 'made in China')
	{
		$this->id = $id;
		$this->marca = $marca;
	}

	private function setBarCode(string $barCode)
	{
		$this->barCode = $barCode;
	}

	private function getBarCode()
	{
		return $this->barCode;
	}

	public function changeBarCode(int $id, string $barCode)
	{
		if ($this->id === $id){
			$this->setBarCode($barCode);
		} else {
			throw new Exception('Error');
		}
	}
}

$meia = new Produto(42, 'Meia');
$meia->changeBarCode(42, '12345678910');
var_dump($meia);
