<?
class NoteUnavailableException extends Exception
{}


function getMoney($value)
{	
	if ($value !== NULL && (! is_int($value) || $value < 0))
	{
		throw new InvalidArgumentException();
	}
	
	$noteTypes = array(100, 50, 20, 10);
	arsort($noteTypes);
	
	$notes = array();
	
	foreach ($noteTypes as $noteType)
	{	
		while ($value >= $noteType)
		{
			if ($value >= $noteType) {
				$notes[] = $noteType;
				$value -= $noteType;
			} // else continue
		}
	}

	if ($value > 0)
	{
		throw new NoteUnavailableException();
	}
	
	return $notes;
}

function assertEqual($expected, $value)
{
	if ($expected !== $value)
	{
		throw new Exception("Expected " . print_r($expected, true) . " - received " . print_r($value, true));
	}
}

assertEqual([20, 10], getMoney(30));
assertEqual([50, 20, 10], getMoney(80));
assertEqual([100, 100, 20, 20], getMoney(240));
assertEqual(array(), getMoney(NULL));

try 
{
	getMoney(125);
} 
catch (NoteUnavailableException $e) 
{}
	
try 
{
	getMoney(-250);
} 
catch (InvalidArgumentException $e) 
{}
	
try 
{
	getMoney("toto");
} 
catch (InvalidArgumentException $e) 
{}




