<?
# FlatList v1.0 Final: http://www.desiquintans.com/flatlist
# FlatList is free under version 2 or later of the GPL.
# This program is distributed with cursory support, but without
# warranty or guarantee of any sort.

// Edit $URLToDisplay to point to the URL of the text file you'd like FlatList to display.
$URLToDisplay = "http://www.desiquintans.com/demo/flatlist/SampleList.txt";

### Don't edit below this line. ###

include_once ('markdown.php');

include ('template/header.htm');
	echo Format($URLToDisplay);
	UNSET($URLToDisplay);
include ('template/footer.htm');

function Format($filename)
{
	// Remove empty lines.
	$rawtext = preg_replace("/[\R]{2,}/", '\n', file_get_contents($filename));

	// Convert [] (with optional spaces in the middle) to empty checkbox images.
	$rawtext = preg_replace('/- \[\s*?]\s*/', '- <img style="vertical-align:middle" src="img/pending.png" /> ', $rawtext);
	
	// Convert [-] to cancelled checkboxes.
	$rawtext = preg_replace('/- \[-*?]\s*/i', '- <img style="vertical-align:middle" src="img/cancelled.png" /> ', $rawtext);
	
	// Convert [x] or [X] to filled checkbox images.
	$rawtext = preg_replace('/- \[x*?]\s*/i', '- <img style="vertical-align:middle" src="img/done.png" /> ', $rawtext);
	
	//Convert #-marked heading list items to classed spans.
	$rawtext = preg_replace('/- #####(.*)(?=\n)/', '- <span class="heading5">$1</span>', $rawtext);
	$rawtext = preg_replace('/- ####(.*)(?=\n)/', '- <span class="heading4">$1</span>', $rawtext);
	$rawtext = preg_replace('/- ###(.*)(?=\n)/', '- <span class="heading3">$1</span>', $rawtext);
	$rawtext = preg_replace('/- ##(.*)(?=\n)/', '- <span class="heading2">$1</span>', $rawtext);
	$rawtext = preg_replace('/- #(.*)(?=\n)/', '- <span class="heading1">$1</span>', $rawtext);
	
	return Markdown($rawtext);
	
}
?>