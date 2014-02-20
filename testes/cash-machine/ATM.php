<?php
/**
 * Class ATM
 *
 * @author Rafael F Queiroz <rafaelfqf@gmail.com>
 */
class ATM {
		
	/**
	 * Bills
	 *
	 * @var array
	 */
	private $bills = array(100, 50, 20, 10);

	/**
	 * Method of construct
	 */
	public function __construct() {
	}

	/**
	 * Method of draft
	 *
	 * @param mixed $value
	 * @throws NoteUnavailableException
	 * @throws InvalidArgumentException	 
	 * @return array
	 */
	public function draft($value) {
		$this->_validate($value);
		$response = array();
		while ($value) {
			foreach ($this->bills as $bill) {
				if ($bill > $value)
					continue;
				for ($i=0, $bills = floor($value / $bill); $i < $bills; $i++) {
					$response[] = $bill;
				}
				$value -= $bills * $bill;
			}			
		}

		return $response;
	}

	/**
	 * Method of validate
	 *
	 * @throws NoteUnavailableException
	 * @throws InvalidArgumentException
	 * @return void
	 */
	private function _validate($value) {
		if ($value < 0)
			throw new InvalidArgumentException();
		if ($value % min($this->bills) !== 0)
			throw new NoteUnavailableException();

		return ;
	}

}

/**
 * Class NoteUnavailableException
 *
 * @author Rafael F Queiroz <rafaelfqf@gmail.com>
 */ 
class NoteUnavailableException extends Exception {

}