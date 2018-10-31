<?php

function setActive($path)
{
	return Request::is($path . '*') ? 'active':  '';
}
function WebsetActive($path)
{
	return Request::is($path . '*') ? 'home':  '';
}

?>