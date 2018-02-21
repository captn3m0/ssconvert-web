<?php

// Single file web-app wrapper over ssconvert

if($_SERVER['HTTP_ACCEPT'] === 'text/csv')
{
	header('Content-Type: text/csv; charset=utf-8');
	// Assume that Content-Type of request is correct
	$input = tempnam('/tmp', 'ssconvert-input-');
	$output = tempnam('/tmp', 'ssconvert-output-');

	// Write file to disc
	copy('php://input', $input);

	// Now we run ssconvert

	$arg1 = escapeshellarg($input);
	$arg2 = escapeshellarg($output);


	// TODO: Use accept header for this
	exec("ssconvert --export-type=Gnumeric_stf:stf_csv $arg1 $arg2");

	readfile($output);

	// Cleanup
	unlink($input);
	unlink($output);
}
else
{
	header('Content-Type: text/plain; charset=utf-8');
	passthru('ssconvert --help');

	echo PHP_EOL . "# Usage via curl:";

	echo PHP_EOL . 'curl --request POST --data-binary "@file.xlsx" --header "Accept: text/csv" http://localhost:1111';
}