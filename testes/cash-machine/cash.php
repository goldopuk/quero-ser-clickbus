<?
class NoteUnavailableException extends Exception
{}

class CashMachine 
{
	protected $availableNotes;
	
	public function __construct($availableNotes = array(100, 50, 20, 10)) 
	{
		arsort($availableNotes);
		$this->availableNotes = $availableNotes;
	}
	
	public function withdraw($value)
	{	
		if ($value !== NULL && (! is_int($value) || $value < 0))
		{
			throw new InvalidArgumentException();
		}

		$notes = array();

		foreach ($this->availableNotes as $note)
		{	
			while ($value >= $note)
			{
				if ($value >= $note) {
					$notes[] = $note;
					$value -= $note;
				} // else continue
			}
		}

		if ($value > 0)
		{
			throw new NoteUnavailableException();
		}

		return $notes;
	}
} 

function assertEqual($expected, $value)
{
	if ($expected !== $value)
	{
		throw new Exception("Expected " . print_r($expected, true) . " - received " . print_r($value, true));
	}
}

$machine = new CashMachine();

assertEqual([20, 10], $machine->withdraw(30));
assertEqual([50, 20, 10], $machine->withdraw(80));
assertEqual([100, 100, 20, 20], $machine->withdraw(240));
assertEqual(array(), $machine->withdraw(NULL));

try 
{
	$machine->withdraw(45);
} 
catch (NoteUnavailableException $e) 
{}
	
try 
{
	$machine->withdraw(-250);
} 
catch (InvalidArgumentException $e)
{}
	
try 
{
	$machine->withdraw('toto');
} 
catch (InvalidArgumentException $e) 
{}




